<?php

declare(strict_types=1);

namespace App\Traits;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Traits\Localizable;
use Spatie\Translatable\HasTranslations;

trait Translatable
{
    use Localizable;
    use HasTranslations;

    public function initializeTranslatable(): void
    {
        $this->fillable = array_merge($this->fillable, $this->translatable);
    }

    public function getTranslationsWithFallback(?string $key = null): array
    {
        return locales()
            ->mapWithKeys(fn (array $config, string $locale) => [$locale => null])
            ->merge($this->getTranslations($key))
            ->toArray();
    }

    public function scopeOrderByTranslated(Builder $query, string $column, string $direction = 'asc'): Builder
    {
        return $query->orderBy($column . '->' . app()->getLocale(), $direction);
    }
}
