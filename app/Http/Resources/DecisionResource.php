<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;

class DecisionResource extends Resource
{
    public array $routeMap = [
        'admin.decisions.index'  => 'index',
        'admin.decisions.edit'   => 'edit',
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
            'description'  => $this->getTranslations('description'),
            'slug'         => $this->getTranslations('slug'),
            'created_at'   => $this->created_at->toDateTimeString(),
            'published_at' => $this->published_at?->toDateTimeString(),
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
