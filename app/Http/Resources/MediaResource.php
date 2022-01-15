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
        $resource = [
            'id'             => $this->id,
            'directory'      => $this->directory,
            'filename'       => $this->filename,
            'extension'      => $this->extension,
            'mime_type'      => $this->mime_type,
            'aggregate_type' => $this->aggregate_type,
            'size'           => $this->readableSize(),
            'caption'        => $this->getTranslationsWithFallback('caption'),
            'created_at'     => $this->created_at->toDateTimeString(),
            'updated_at'     => $this->updated_at->toDateTimeString(),
        ];

        if ($this->isImage()) {
            $resource['width'] = $this->width;
            $resource['sizes'] = $this->sizes;
            $resource['height'] = $this->height;
        }

        return $resource;
    }
}
