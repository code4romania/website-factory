<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\Sortable;
use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Intervention\Image\Facades\Image;
use Plank\Mediable\Jobs\CreateImageVariants;
use Plank\Mediable\Media as BaseMedia;

class Media extends BaseMedia
{
    use Sortable;
    use Translatable;

    protected $perPage = 50;

    protected $with = [
        'variants',
    ];

    public array $translatable = [
        'caption',
    ];

    public array $allowedSorts = [
        //
    ];

    public static function booted()
    {
        static::saving(function (self $media) {
            if ($media->aggregate_type === self::TYPE_IMAGE) {
                $image = Image::make($media->contents());

                $media->forceFill([
                    'width'  => $image->width(),
                    'height' => $image->height(),
                ]);
            }
        });

        static::saved(function (self $media) {
            if ($media->aggregate_type === self::TYPE_IMAGE && $media->isOriginal()) {
                CreateImageVariants::dispatchSync($media, config('mediable.variants'));
            }
        });
    }

    public function getSizesAttribute(): Collection
    {
        $variants = $this->getAllVariantsAndSelf();

        if (! $variants->has('thumb')) {
            $variants->put('thumb', $variants->get('original'));
        }

        return $variants->map(fn (self $variant) => [
            'width'  => $variant->width,
            'height' => $variant->height,
            'url'    => $variant->getUrl(),
        ]);
    }

    public function getDimensionsAttribute(): ?string
    {
        if ($this->aggregate_type !== self::TYPE_IMAGE) {
            return null;
        }

        if (! $this->width || ! $this->height) {
            return null;
        }

        return $this->width . ' x ' . $this->height;
    }

    public function scopeWhereImages(Builder $query): Builder
    {
        return $query->whereIn('aggregate_type', [self::TYPE_IMAGE, self::TYPE_IMAGE_VECTOR]);
    }

    public function scopeWhereNotImages(Builder $query): Builder
    {
        return $query->whereNotIn('aggregate_type', [self::TYPE_IMAGE, self::TYPE_IMAGE_VECTOR]);
    }

    public function isImage(): bool
    {
        return \in_array($this->aggregate_type, [self::TYPE_IMAGE, self::TYPE_IMAGE_VECTOR]);
    }
}
