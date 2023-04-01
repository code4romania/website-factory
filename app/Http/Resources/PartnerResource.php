<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;

class PartnerResource extends Resource
{
    public array $routeMap = [
        'admin.partners.index' => 'index',
        'admin.partners.edit' => 'edit',
    ];

    protected function index(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'url' => $this->url,
            'position' => $this->position,
            'created_at' => $this->created_at->toDateTimeString(),
            'trashed' => $this->trashed(),
        ];
    }

    protected function edit(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'url' => $this->url,
            'position' => $this->position,
            'created_at' => $this->created_at->toDateTimeString(),
            'published_at' => $this->published_at?->toDateTimeString(),
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
            'name' => $this->name,
            'url' => $this->url,
            'position' => $this->position,
        ];
    }
}
