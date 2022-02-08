<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;

class PostCategoryResource extends Resource
{
    public array $routeMap = [
        'admin.post_categories.index' => 'index',
        'admin.post_categories.edit'  => 'edit',
    ];

    protected function index(Request $request): array
    {
        return [
            'id'          => $this->id,
            'title'       => $this->title,
            'slug'        => $this->slug,
            'posts_count' => $this->posts_count,
            'trashed'     => $this->trashed(),
        ];
    }

    protected function edit(Request $request): array
    {
        return [
            'id'           => $this->id,
            'title'        => $this->getTranslations('title'),
            'description'  => $this->getTranslations('description'),
            'slug'         => $this->getTranslations('slug'),
        ];
    }

    protected function default(Request $request): array
    {
        $this->withoutPermissions();

        return [
            'id'    => $this->id,
            'title' => $this->title,
        ];
    }
}
