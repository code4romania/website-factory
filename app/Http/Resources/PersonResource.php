<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;

class PersonResource extends Resource
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
            'name'       => $this->name,
            'title'      => $this->title,
            'slug'       => $this->slug,
            'created_at' => $this->created_at->toDateTimeString(),
            'trashed'    => $this->trashed(),
        ];
    }

    protected function edit(Request $request): array
    {
        return [
            'id'           => $this->id,
            'name'         => $this->name,
            'slug'         => $this->slug,
            'title'        => $this->getTranslations('title'),
            'description'  => $this->getTranslations('description'),
            'created_at'   => $this->created_at->toDateTimeString(),
            'blocks'       => BlockResource::collection($this->blocks),
            'media'        => MediaResource::collection(
                $this->media()->whereIsOriginal()->get()
            ),
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
