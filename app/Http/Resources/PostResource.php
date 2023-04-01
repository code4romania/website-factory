<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;

class PostResource extends Resource
{
    public array $routeMap = [
        'admin.posts.index' => 'index',
        'admin.posts.edit' => 'edit',
    ];

    protected function index(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'created_at' => $this->created_at->toDateTimeString(),
            'published_at' => $this->published_at?->toDateTimeString(),
            'categories' => $this->categories,
            'trashed' => $this->trashed(),
            'status' => $this->status(),
        ];
    }

    protected function edit(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->getTranslations('title'),
            'description' => $this->getTranslations('description'),
            'slug' => $this->getTranslations('slug'),
            'author' => $this->author,
            'created_at' => $this->created_at->toDateTimeString(),
            'published_at' => $this->published_at?->toDateTimeString(),
            'categories' => $this->categories->pluck('id'),
            'blocks' => BlockResource::collection($this->blocks),
            'media' => MediaResource::collection(
                $this->media()->whereIsOriginal()->get()
            ),
        ];
    }

    protected function default(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
        ];
    }
}
