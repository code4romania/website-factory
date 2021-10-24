<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;

class MediaResource extends Resource
{
    public array $routeMap = [
        //
    ];

    protected function default(Request $request): array
    {
        return [
            'id'                => $this->id,
            'directory'         => $this->directory,
            'filename'          => $this->filename,
            'extension'         => $this->extension,
            'mime_type'         => $this->mime_type,
            'aggregate_type'    => $this->aggregate_type,
            'size'              => $this->readableSize(),
            'width'             => $this->width,
            'sizes'             => $this->sizes,
            'height'            => $this->height,
            'caption'           => $this->getTranslations('caption'),
            'created_at'        => $this->created_at->toDateTimeString(),
            'updated_at'        => $this->updated_at->toDateTimeString(),
        ];
    }
}
