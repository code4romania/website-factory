<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Spatie\TranslationLoader\LanguageLine as Model;

class LanguageLine extends Model
{
    public static function booted()
    {
        static::addGlobalScope('orderByKey', function (Builder $query) {
            $query->orderBy('key');
        });
    }
}
