<?php

declare(strict_types=1);

use App\Models\Setting;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

if (! function_exists('locales')) {
    /**
     * Return the currently enabled locales.
     *
     * @return \Illuminate\Support\Collection
     */
    function locales(): Collection
    {
        return collect(config('translatable.locales'));
    }
}

if (! function_exists('localized_route')) {
    /**
     * Generate the URL to a named route for the current locale.
     *
     * @param  mixed  $name
     * @param  array  $parameters
     * @param  string $locale
     * @param  bool   $absolute
     * @return string
     */
    function localized_route($name, $parameters = [], ?string $locale = null, bool $absolute = true): string
    {
        $parameters['locale'] = $locale ?? app()->getLocale();

        return route($name, $parameters, $absolute);
    }
}

if (! function_exists('settings')) {
    /**
     * @param  null|string $key
     * @return mixed
     */
    function settings(?string $key = null): mixed
    {
        $settings = Cache::tags('settings')->rememberForever(
            'settings–' . app()->getLocale(),
            fn () => Setting::query()->pluck('value', 'key')
        );

        if (! is_null($key)) {
            return $settings->get($key);
        }

        return $settings;
    }
}
