<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;

class PageResource extends Resource
{
    public array $routeMap = [
        'admin.pages.index' => 'index',
        'admin.pages.edit' => 'edit',
    ];

    protected function index(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'created_at' => $this->created_at->toDateTimeString(),
            'published_at' => $this->published_at?->toDateTimeString(),
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
            'created_at' => $this->created_at->toDateTimeString(),
            'published_at' => $this->published_at?->toDateTimeString(),
            'parent' => $this->parent_id,
            'blocks' => BlockResource::collection($this->blocks),
            'media' => MediaResource::collection(
                $this->media()->whereIsOriginal()->get()
            ),
        ];
    }

    protected function default(Request $request): array
    {
        $this->withoutPermissions();

        return [
            'id' => $this->id,
            'title' => $this->title,
        ];
    }
}
