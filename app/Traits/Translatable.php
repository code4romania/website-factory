<?php

declare(strict_types=1);

namespace App\Traits;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\Support\Traits\Localizable;
use Spatie\Translatable\HasTranslations;

trait Translatable
{
    use Localizable;
    use HasTranslations {
        getTranslations as parentGetTranslations;
    }

    public function initializeTranslatable(): void
    {
        $this->fillable = \array_merge($this->fillable, $this->translatable);
    }

    public function alternateLocaleUrls(): Collection
    {
        $model = $this->getMorphClass();
        $routeName = 'front.' . Str::plural($model) . '.show';

        return collect(config('translatable.locales'))
            // ->reject(fn (string $locale) => app()->getLocale() === $locale)
            ->mapWithKeys(
                fn (string $locale) => $this->withLocale($locale, fn () => [
                    $locale => route($routeName, [
                        'locale' => $locale,
                        $model   => $this,
                    ]),
                ])
            );
    }

    public function getTranslations(string $key = null): array
    {
        return collect(config('translatable.locales'))
            ->mapWithKeys(fn (string $locale) => [$locale => null])
            ->merge($this->parentGetTranslations($key))
            ->toArray();
    }
}
