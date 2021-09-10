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
    public function __construct()
    {
        // $this->authorizeResource(Page::class);
    }

    public function index(): Response
    {
        return Inertia::render('Pages/Index', [
            'pages' => new PageCollection(
                Page::query()
                    ->withTranslation()
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
        ]);
    }

    public function store(PageRequest $request): RedirectResponse
    {
        dd($request->validated());
        $page = Page::create($request->validated());

        return redirect()->route('admin.pages.edit', $page)
            ->with('success', __('page.event.created'));
    }

    public function edit(Page $page): Response
    {
        return Inertia::render('Pages/Edit', [
            'page' => PageResource::make($page),
        ]);
    }

    public function update(PageRequest $request, Page $page): RedirectResponse
    {
        // dd($request->validated());
        $page->fill($request->validated());

        $page->save();

        return redirect()->route('admin.pages.edit', $page)
            ->with('success', __('page.event.updated'));
    }

    public function destroy(Page $page): RedirectResponse
    {
        $page->delete();

        return redirect()->route('admin.pages.index')
            ->with('success', __('page.event.deleted'));
    }
}
