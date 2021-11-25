<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Str;

class TranslatableFormRequestRules
{
    public static function make(string $model, array $input): array
    {
        $fallbackLocale = config('translatable.fallback_locale')
            ?? config('app.fallback_locale');

        $model = app($model);

        $rules = collect();

        foreach ($input as $key => $rule) {
            // Check for nested array keys
            $attribute = Str::of($key)->explode('.')->last();

            if (! $model->isTranslatableAttribute($attribute)) {
                $rules->put($key, $rule);
                continue;
            }

            locales()->each(function (string $locale) use ($fallbackLocale, $rules, $key, $rule) {
                if ($locale !== $fallbackLocale) {
                    $rule = collect($rule)
                        ->map(function (string $rule) {
                            if (Str::of($rule)->startsWith('required')) {
                                return 'nullable';
                            }

                            return $rule;
                        })
                        ->all();
                }

                $rules->put("$key.$locale", $rule);
            });
        }

        return $rules->all();
    }
}
