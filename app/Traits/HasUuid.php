<?php

declare(strict_types=1);

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait HasUuid
{
    public static function bootHasUuid()
    {
        // Generate UUID if none provided
        static::creating(function (Model $model) {
            if (! $model->uuid) {
                $model->uuid = (string) Str::orderedUuid();
            }
        });

        // Make sure UUIDs can't be changed
        static::updating(function (Model $model) {
            $originalUuid = $model->getOriginal('uuid');

            if (
                ! \is_null($originalUuid) &&
                $originalUuid !== $model->uuid
            ) {
                $model->uuid = $originalUuid;
            }
        });
    }

    public function scopeWhereUuid(Builder $query, string $uuid): Builder
    {
        return $query->where('uuid', $uuid);
    }

    public function getUrlAttribute(): string
    {
        $key = $this->getMorphClass();

        return route('front.' . Str::plural($key) . '.show', [
            'locale' => app()->getLocale(),
            $key     => $this->uuid,
        ]);
    }
}
