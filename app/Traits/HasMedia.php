<?php

declare(strict_types=1);

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Plank\Mediable\Mediable;

trait HasMedia
{
    use Mediable;

    public function saveImages(iterable $media): Model
    {
        $this->syncMedia(
            collect($media)->pluck('id')->all(),
            ['image']
        );

        return $this;
    }

    public function getMediaUrl($tags, string $variant): ?string
    {
        $media = $this->firstMedia($tags);

        if (! $media) {
            return null;
        }

        return optional($media->findVariant($variant))->getUrl();
    }
}
