<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Str;

class TranslatableFormRequestRules
{
    public static function make(string $model, array $input): array
    {
        $modelHasSlug = SupportsTrait::slug($model);

        $model = app($model);

        $rules = collect();

        foreach ($input as $key => $rule) {
            // Check for nested array keys
            $attribute = Str::of($key)->explode('.')->last();

            if (! $model->isTranslatableAttribute($attribute)) {
                $rules->put($key, $rule);
                continue;
            }

            locales()->each(function (array $config, string $locale) use ($rules, $key, $rule) {
                if (! $locale !== config('app.fallback_locale')) {
                    $rule = collect($rule)
                        ->map(fn (string $rule) => Str::startsWith($rule, 'required') ? 'nullable' : $rule)
                        ->all();
                }

                $rules->put("$key.$locale", $rule);
            });
        }

        return $rules->all();
    }
}
