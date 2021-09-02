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
            'id'    => $this->id,
            'title' => $this->title,
        ];
    }

    protected function edit(Request $request): array
    {
        return [
            'id'    => $this->id,
            'title' => $this->translatable('title'),
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
