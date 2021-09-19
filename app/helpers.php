<?php

declare(strict_types=1);

use Illuminate\Support\Collection;

if (! function_exists('locales')) {
    function locales(): Collection
    {
        return collect(config('translatable.locales'));
    }
}
