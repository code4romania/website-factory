<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\PostCategoryRequest;
use App\Http\Resources\Collections\PostCategoryCollection;
use App\Http\Resources\PostCategoryResource;
use App\Models\PostCategory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class PostCategoryController extends AdminController
{
    public function index(): Response
    {
        return Inertia::render('Posts/Categories/Index', [
            'collection' => new PostCategoryCollection(
                PostCategory::query()
                    ->withCount([
                        'posts' => function (Builder $query) {
                            $query->withDrafted();
                        },
                    ])
                    ->sort()
                    ->filter()
                    ->paginate()
            ),
            'subnav' => $this->subnav(),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Posts/Categories/Edit', [
            //
        ])->model(PostCategory::class);
    }

    public function store(PostCategoryRequest $request): RedirectResponse
    {
        $attributes = $request->validated();

        $postCategory = PostCategory::create($attributes);

        return redirect()->route('admin.post_categories.edit', $postCategory)
            ->with('success', __('post_category.event.created'));
    }

    public function edit(PostCategory $postCategory): Response
    {
        return Inertia::render('Posts/Categories/Edit', [
            'resource' => PostCategoryResource::make($postCategory),
            'subnav' => $this->subnav(),
        ])->model(PostCategory::class);
    }

    public function update(PostCategoryRequest $request, PostCategory $postCategory): RedirectResponse
    {
        $attributes = $request->validated();

        $postCategory->update($attributes);

        return redirect()->route('admin.post_categories.edit', $postCategory)
            ->with('success', __('post_category.event.updated'));
    }

    public function duplicate(PostCategory $postCategory): RedirectResponse
    {
        $duplicate = $postCategory->duplicate();

        return redirect()->route('admin.post_categories.edit', $duplicate)
            ->with('success', __('post_category.event.duplicated'));
    }

    public function destroy(PostCategory $postCategory): RedirectResponse
    {
        $postCategory->delete();

        return redirect()->route('admin.post_categories.index')
            ->with('success', __('post_category.event.deleted'));
    }

    public function restore(PostCategory $postCategory): RedirectResponse
    {
        $postCategory->restore();

        return redirect()->route('admin.post_categories.edit', $postCategory)
            ->with('success', __('post_category.event.restored'));
    }

    public function forceDelete(PostCategory $postCategory): RedirectResponse
    {
        $postCategory->forceDelete();

        return redirect()->route('admin.post_categories.index')
            ->with('success', __('post_category.event.deleted'));
    }

    protected function subnav(): array
    {
        return [
            [
                'label' => 'post.subnav.posts',
                'route' => 'admin.posts.index',
            ],
            [
                'label' => 'post.subnav.categories',
                'route' => 'admin.post_categories.index',
            ],
        ];
    }
}
