<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;

class PersonResource extends Resource
{
    public array $routeMap = [
        'admin.people.index'  => 'index',
        'admin.people.edit'   => 'edit',
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
            'social'       => $this->getSocialProfiles(),
            'platforms'    => config('website-factory.social_platforms', []),
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
        $this->withoutPermissions();

        return [
            'id'    => $this->id,
            'type'  => $this->getMorphClass(),
            'title' => $this->name,
        ];
    }
}
