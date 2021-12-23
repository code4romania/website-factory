<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;

class RelatedResource extends Resource
{
    public array $routeMap = [
        //
    ];

    protected function default(Request $request): array
    {
        $this->withoutPermissions();

        return [
            'id'    => $this->related_id,
            'type'  => $this->related_type,
            'title' => $this->related->name ?? $this->related->title,
        ];
    }
}
