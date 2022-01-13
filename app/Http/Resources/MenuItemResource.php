<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;

class MenuItemResource extends Resource
{
    protected function default(Request $request): array
    {
        $this->withoutPermissions();

        return [
            'id'           => $this->id,
            'type'         => $this->normalized_type,
            'label'        => $this->getTranslationsWithFallback('label'),
            'url'          => $this->getTranslationsWithFallback('url'),
            'model_type'   => $this->model_type,
            'model'        => $this->model_id,
            'children'     => self::collection($this->children),
        ];
    }
}
