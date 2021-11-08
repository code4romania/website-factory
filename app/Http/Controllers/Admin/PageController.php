<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PageRequest;
use App\Http\Resources\Collections\PageCollection;
use App\Http\Resources\PageResource;
use App\Models\Page;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class PageController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Pages/Index', [
            'collection' => new PageCollection(
                Page::query()
                    ->sort()
                    ->filter()
                    ->paginate()
            ),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Pages/Create', [
            //
        ])->model(Page::class);
    }

    public function store(PageRequest $request): RedirectResponse
    {
        $attributes = $request->validated();

        $page = Page::create($attributes);

        $page->saveBlocks($attributes['blocks']);

        return redirect()->route('admin.pages.edit', $page)
            ->with('success', __('page.event.created'));
    }

    public function edit(Page $page): Response
    {
        return Inertia::render('Pages/Edit', [
            'page' => PageResource::make($page),
        ])->model(Page::class);
    }

    public function update(PageRequest $request, Page $page): RedirectResponse
    {
        $attributes = $request->validated();

        $page->update($attributes);

        $page->saveBlocks($attributes['blocks']);

        $page->attachMedia(
            collect($request->media)
                ->pluck('id')
                ->all(),
            ['image']
        );

        return redirect()->route('admin.pages.edit', $page)
            ->with('success', __('page.event.updated'));
    }

    public function destroy(Page $page): RedirectResponse
    {
        $page->delete();

        return redirect()->route('admin.pages.index')
            ->with('success', __('page.event.deleted'));
    }

    public function restore(Page $page): RedirectResponse
    {
        $page->restore();

        return redirect()->route('admin.pages.index')
            ->with('success', __('page.event.restored'));
    }

    public function forceDelete(Page $page): RedirectResponse
    {
        $page->forceDelete();

        return redirect()->route('admin.pages.index')
            ->with('success', __('page.event.forceDeleted'));
    }
}
