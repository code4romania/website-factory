<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;

class DecisionAuthorResource extends Resource
{
    public array $routeMap = [
        'admin.decision_authors.index' => 'index',
        'admin.decision_authors.edit' => 'edit',
    ];

    protected function index(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'decisions_count' => $this->decisions_count,
            'trashed' => $this->trashed(),
        ];
    }

    protected function edit(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->getTranslations('title'),
            'description' => $this->getTranslations('description'),
            'slug' => $this->getTranslations('slug'),
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
