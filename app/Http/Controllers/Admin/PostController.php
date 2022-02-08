<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\PostRequest;
use App\Http\Resources\Collections\PostCollection;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class PostController extends AdminController
{
    public function index(): Response
    {
        return Inertia::render('Posts/Index', [
            'collection' => new PostCollection(
                Post::query()
                    ->withDrafted()
                    ->sort(
                        defaultColumn: 'created_at',
                        defaultDirection: 'desc'
                    )
                    ->filter()
                    ->paginate()
            ),
            'subnav' => $this->subnav(),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Posts/Edit', [
            'categories' => PostCategory::all(['id', 'title']),
            'subnav' => $this->subnav(),
        ])->model(Post::class);
    }

    public function store(PostRequest $request): RedirectResponse
    {
        $attributes = $request->validated();

        $post = Post::create($attributes);

        $post->categories()->sync($attributes['categories']);

        $post->saveBlocks($attributes['blocks'])
            ->saveImages($attributes['media']);

        return redirect()->route('admin.posts.edit', $post)
            ->with('success', __('post.event.created'));
    }

    public function edit(Post $post): Response
    {
        return Inertia::render('Posts/Edit', [
            'resource' => PostResource::make($post),
            'categories' => PostCategory::all(['id', 'title']),
            'subnav' => $this->subnav(),
        ])->model(Post::class);
    }

    public function update(PostRequest $request, Post $post): RedirectResponse
    {
        $attributes = $request->validated();

        $post->update($attributes);

        $post->categories()->sync($attributes['categories']);

        $post->saveBlocks($attributes['blocks'])
            ->saveImages($attributes['media']);

        return redirect()->route('admin.posts.edit', $post)
            ->with('success', __('post.event.updated'));
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
