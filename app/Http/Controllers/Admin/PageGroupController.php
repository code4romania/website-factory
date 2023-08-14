<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Concerns\PagesSecondaryNavigation;
use App\Contracts\HasSecondaryNavigation;
use App\Http\Requests\Admin\PageRequest;
use App\Http\Resources\Collections\PageGroupCollection;
use App\Http\Resources\PageGroupResource;
use App\Models\Page;
use App\Models\PageGroup;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class PageGroupController extends AdminController implements HasSecondaryNavigation
{
    use PagesSecondaryNavigation;

    public function index(): Response
    {
        return Inertia::render('Pages/Groups/Index', [
            'collection' => new PageGroupCollection(
                PageGroup::query()
                    ->sort(
                        defaultColumn: 'created_at',
                        defaultDirection: 'desc'
                    )
                    ->filter()
                    ->paginate()
            ),
            'subnav' => $this->getSecondaryNavigation(),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Pages/Groups/Edit', [
            'subnav' => $this->getSecondaryNavigation(),
        ])->model(PageGroup::class);
    }

    public function store(PageRequest $request): RedirectResponse
    {
        $attributes = $request->validated();

        $pageGroup = PageGroup::create($attributes);

        // $pageGroup->items()->rebuildTree();

        return redirect()->route('admin.page_groups.edit', $pageGroup)
            ->with('success', __('page_group.event.created'));
    }

    public function edit(PageGroup $pageGroup): Response
    {
        return Inertia::render('Pages/Groups/Edit', [
            'resource' => PageGroupResource::make($pageGroup),
            'pages' => Page::query()
                ->withDrafted()
                ->get(['id', 'title']),
            'subnav' => $this->getSecondaryNavigation(),
        ])->model(PageGroup::class);
    }

    public function update(PageRequest $request, PageGroup $pageGroup): RedirectResponse
    {
        $attributes = $request->validated();

        $pageGroup->update($attributes);

        return redirect()->route('admin.page_groups.edit', $pageGroup)
            ->with('success', __('page_group.event.updated'));
    }

    public function duplicate(PageGroup $pageGroup): RedirectResponse
    {
        $duplicate = $pageGroup->duplicate();

        return redirect()->route('admin.page_groups.edit', $duplicate)
            ->with('success', __('page_group.event.duplicated'));
    }

    public function destroy(PageGroup $pageGroup): RedirectResponse
    {
        $pageGroup->delete();

        return redirect()->route('admin.page_groups.index')
            ->with('success', __('page_group.event.deleted'));
    }

    public function restore(PageGroup $pageGroup): RedirectResponse
    {
        $pageGroup->restore();

        return redirect()->route('admin.page_groups.edit', $pageGroup)
            ->with('success', __('page_group.event.restored'));
    }

    public function forceDelete(PageGroup $pageGroup): RedirectResponse
    {
        $pageGroup->forceDelete();

        return redirect()->route('admin.page_groups.index')
            ->with('success', __('page_group.event.deleted'));
    }
}
