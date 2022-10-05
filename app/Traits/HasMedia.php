<?php

declare(strict_types=1);

namespace App\Traits;

use App\Models\Media;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Plank\Mediable\Mediable;

trait HasMedia
{
    use Mediable;

    public function saveMedia(array $media): Model
    {
        $media = Media::findMany(collect($media)->pluck('id'))
            ->groupBy(fn (Media $item) => match ($item->aggregate_type) {
                'image', 'vector' => 'image',
                default => 'document',
            })->each(function (Collection $items, string $group) {
                $this->syncMedia(
                    $items->pluck('id')->all(),
                    $group
                );
            });

        return $this;
    }

    public function getMediaUrl($tags, string $variant): ?string
    {
        $media = $this->firstMedia($tags);

        if (! $media) {
            return null;
        }

        return $media->findVariant($variant)?->getUrl();
    }

    public function getThumbnailUrl(bool $large = false): ?string
    {
        if ($large) {
            return $this->getMediaUrl('image', '600')
                ?? $this->getMediaUrl('image', 'thumb');
        }

        return $this->getMediaUrl('image', 'thumb');
    }
}
