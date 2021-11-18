<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Str;

class TranslatableFormRequestRules
{
    public static function make(string $model, array $input): array
    {
        $model = app($model);

        $rules = collect();

        foreach ($input as $key => $rule) {
            // Check for nested array keys
            $attribute = Str::of($key)->explode('.')->last();

            if ($model->isTranslatableAttribute($attribute)) {
                locales()->each(fn ($locale) => $rules->put("$key.$locale", $rule));
            } else {
                $rules->put($key, $rule);
            }
        }

        return $rules->all();
    }
}
