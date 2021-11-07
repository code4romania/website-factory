<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;

class PageResource extends Resource
{
    public array $routeMap = [
        'admin.pages.index'  => 'index',
        // 'admin.pages.create' => 'create',
        'admin.pages.edit'   => 'edit',
    ];

    protected function index(Request $request): array
    {
        return [
            'id'         => $this->id,
            'title'      => $this->title,
            'slug'       => $this->slug,
            'created_at' => $this->created_at->toDateTimeString(),
            'trashed'    => $this->trashed(),
            'status'     => $this->status(),
        ];
    }

    protected function edit(Request $request): array
    {
        return [
            'id'           => $this->id,
            'title'        => $this->getTranslations('title'),
            'slug'         => $this->getTranslations('slug'),
            'layout'       => $this->layout,
            'created_at'   => $this->created_at->toDateTimeString(),
            'published_at' => optional($this->published_at)->toDateTimeString(),
            'blocks'       => BlockResource::collection($this->blocks),
        ];
    }

    protected function default(Request $request): array
    {
        return [
            'id'    => $this->id,
            'title' => $this->title,
        ];
    }
}
