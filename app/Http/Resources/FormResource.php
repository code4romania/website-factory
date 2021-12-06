<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;

class FormResource extends Resource
{
    public array $routeMap = [
        'admin.forms.index'  => 'index',
        // 'admin.forms.show'   => 'show',
        'admin.forms.edit'   => 'edit',
    ];

    protected function index(Request $request): array
    {
        return [
            'id'         => $this->id,
            'title'      => $this->title,
            'created_at' => $this->created_at->toDateTimeString(),
            'trashed'    => $this->trashed(),
        ];
    }

    protected function edit(Request $request): array
    {
        return [
            'id'           => $this->id,
            'title'        => $this->getTranslations('title'),
            'created_at'   => $this->created_at->toDateTimeString(),
            'published_at' => $this->published_at?->toDateTimeString(),
            'blocks'       => BlockResource::collection($this->blocks),
        ];
    }

    protected function default(Request $request): array
    {
        return [
            'id'     => $this->id,
            'title'  => $this->title,
        ];
    }
}
