<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
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

    public function getTranslationWithoutFallback(string $locale): ?string
    {
        return data_get($this->text, $locale, null);
    }

    public static function getTranslationsWithoutFallbackForGroup(string $locale, string $group): array
    {
        return static::query()
            ->where('group', $group)
            ->get()
            ->reduce(function ($lines, self $languageLine) use ($group, $locale) {
                $translation = $languageLine->getTranslationWithoutFallback($locale);

                if ($translation !== null && $group === '*') {
                    // Make a flat array when returning json translations
                    $lines[$languageLine->key] = $translation;
                } elseif ($translation !== null && $group !== '*') {
                    // Make a nested array when returning normal translations
                    Arr::set($lines, $languageLine->key, $translation);
                } else {
                    $lines[$languageLine->key] = null;
                }

                return $lines;
            }) ?? [];
    }
}
