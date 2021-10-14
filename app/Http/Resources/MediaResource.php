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
            'disk'              => $this->disk,
            'directory'         => $this->directory,
            'filename'          => $this->filename,
            'extension'         => $this->extension,
            'mime_type'         => $this->mime_type,
            'aggregate_type'    => $this->aggregate_type,
            'size'              => $this->readableSize(),
            'created_at'        => $this->created_at->toDateTimeString(),
            'updated_at'        => $this->updated_at->toDateTimeString(),
            'urls'              => $this->getAllVariantsAndSelf()->map->getUrl(),
        ];
    }
}
