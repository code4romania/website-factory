<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;

class PageGroupResource extends Resource
{
    public array $routeMap = [
        'admin.page_groups.index' => 'index',
        'admin.page_groups.edit' => 'edit',
    ];

    protected function index(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'pages_count' => $this->pages_count,
        ];
    }

    protected function edit(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->getTranslations('title'),
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
