<?php

declare(strict_types=1);

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Plank\Mediable\Mediable;

trait HasMedia
{
    use Mediable;

    public static function bootHasMedia(): void
    {
        static::saved(function (Model $model) {
            // debug($model->attributes);
            //
        });

        static::deleting(function (Model $model) {
            // debug('deleting');
            // $model->media()->detachz;

            // debug($model)
        });

        static::deleted(function ($model) {
            // dd($model);
            $model->handleMediableDeletion();
        });
    }

    public function initializeHasMedia(): void
    {
        $this->with[] = 'media';
    }
}
