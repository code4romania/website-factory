<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;

class BlockResource extends Resource
{
    public array $routeMap = [
        //
    ];

    protected function default(Request $request): array
    {
        $this->withoutPermissions();

        return [
            'id' => $this->id,
            'type' => $this->type,
            'content' => $this->content,
            'children' => self::collection($this->children),
            'media' => MediaResource::collection(
                $this->media()->whereIsOriginal()->get()
            ),
            'related' => RelatedResource::collection(
                $this->related_items,
            ),
        ];
    }
}
