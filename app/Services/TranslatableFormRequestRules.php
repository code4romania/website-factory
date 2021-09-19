<?php

declare(strict_types=1);

namespace App\Services;

class TranslatableFormRequestRules
{
    public static function make(string $model, array $input): array
    {
        $model = app($model);

        $rules = collect();

        foreach ($input as $key => $rule) {
            if ($model->isTranslatableAttribute($key)) {
                locales()->each(fn ($locale) => $rules->put("$key.$locale", $rule));
            } else {
                $rules->put($key, $rule);
            }
        }

        return $rules->all();
    }
}
