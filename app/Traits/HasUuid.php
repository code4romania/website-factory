<?php

declare(strict_types=1);

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait HasUuid
{
    /**
     * Get the value indicating whether the IDs are incrementing.
     *
     * @return bool
     */
    public function getIncrementing(): bool
    {
        return false;
    }

    /**
     * Get the auto-incrementing key type.
     *
     * @return string
     */
    public function getKeyType(): string
    {
        return 'string';
    }

    public static function bootHasUuid()
    {
        // Generate UUID if none provided
        static::creating(function (Model $model) {
            if (! $model->getKey()) {
                $model->{$model->getKeyName()} = (string) Str::orderedUuid()->toString();
            }
        });

        // Make sure UUIDs can't be changed
        static::saving(function (Model $model) {
            $original_id = $model->getOriginal('id');

            if (! is_null($original_id) && $original_id !== $model->getKey()) {
                $model->id = $original_id;
            }
        });
    }
}
