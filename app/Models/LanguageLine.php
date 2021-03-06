<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Spatie\TranslationLoader\LanguageLine as Model;

class LanguageLine extends Model
{
    /**
     * /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    public static function booted()
    {
        static::addGlobalScope('orderByKey', function (Builder $query) {
            $query->orderBy('key');
        });
    }
}
