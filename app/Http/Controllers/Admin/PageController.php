<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\PageRequest;
use App\Http\Resources\Collections\PageCollection;
use App\Http\Resources\PageResource;
use App\Models\Page;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class PageController extends AdminController
{
    public function index(): Response
    {
        return Inertia::render('Pages/Index', [
            'collection' => new PageCollection(
                Page::query()
                    ->withDrafted()
                    ->sort(
                        defaultColumn: 'created_at',
                        defaultDirection: 'desc'
                    )
                    ->filter()
                    ->paginate()
            ),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Pages/Edit', [
            //
        ])->model(Page::class);
    }

    public function store(PageRequest $request): RedirectResponse
    {
        $attributes = $request->validated();

        $page = Page::create($attributes);

        $page->saveBlocks($attributes['blocks'])
            ->saveImages($attributes['media']);

        return redirect()->route('admin.pages.edit', $page)
            ->with('success', __('page.event.created'));
    }

    public function edit(Page $page): Response
    {
        return Inertia::render('Pages/Edit', [
            'resource' => PageResource::make($page),
        ])->model(Page::class);
    }

    public function update(PageRequest $request, Page $page): RedirectResponse
    {
        $attributes = $request->validated();

        $page->update($attributes);

        $page->saveBlocks($attributes['blocks'])
            ->saveImages($attributes['media']);

        return redirect()->route('admin.pages.edit', $page)
            ->with('success', __('page.event.updated'));
    }
}
