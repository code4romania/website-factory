<?php

declare(strict_types=1);

use App\Services\Features;
use App\Services\ISO_639_1;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\Str;

if (! function_exists('locales')) {
    /**
     * Return the available locales.
     *
     * @return Collection
     */
    function locales(): Collection
    {
        return collect(app('languages'));
    }
}

if (! function_exists('text_direction')) {
    /**
     * Return the current text direction.
     *
     * @return string
     */
    function text_direction(): string
    {
        return ISO_639_1::getLanguageDirection(app()->getLocale());
    }
}

if (! function_exists('active_locales')) {
    /**
     * Return the currently enabled locales.
     *
     * @return Collection
     */
    function active_locales(): Collection
    {
        return collect(app('languages'))
            ->reject(fn (array $config) => ! $config['enabled']);
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
    function localized_route($name, array $parameters = [], ?string $locale = null, bool $absolute = true): string
    {
        $parameters['locale'] = $locale ?? app()->getLocale();

        return route($name, $parameters, $absolute);
    }
}

if (! function_exists('localized_input')) {
    function localized_input(mixed $input, ?string $locale = null): mixed
    {
        $input = Arr::wrap($input);

        $locale ??= app()->getLocale();

        if (! array_key_exists($locale, $input) || $input[$locale] === '') {
            $locale = app()->getFallbackLocale();
        }

        return $input[$locale] ?? null;
    }
}

if (! function_exists('settings')) {
    /**
     * @param  array|string|null $key
     * @return mixed
     */
    function settings(array|string|null $key = null): mixed
    {
        if (is_null($key)) {
            return app('settings');
        }

        return data_get(app('settings'), $key);
    }
}

if (! function_exists('localized_settings')) {
    /**
     * @param  null|string $key
     * @return mixed
     */
    function localized_settings(?string $key = null): mixed
    {
        return settings($key . '.' . app()->getLocale())
            ?? settings($key . '.' . app()->getFallbackLocale());
    }
}

if (! function_exists('color_var')) {
    /**
     * @param  null|string $hex
     * @param  string      $name
     * @return string
     */
    function color_var(?string $hex, string $name): string
    {
        $hex = ltrim((string) $hex, '#');

        $rgb = match (Str::length($hex)) {
            3 => str_split($hex, 1),
            6 => str_split($hex, 2),
            default => str_split('000', 1),
        };

        $rgb = collect($rgb)
            ->map(fn (string $c) => hexdec(str_pad($c, 2, $c)))
            ->implode(',');

        return "--color-{$name}:{$rgb};";
    }
}

if (! function_exists('format_bytes')) {
    /**
     * @param  int    $bytes     Number of bytes (eg. 25907)
     * @param  int    $precision [optional] Number of digits after the decimal point (eg. 1)
     * @return string Value converted with unit (eg. 25.3KB)
     */
    function format_bytes(int $bytes, int $precision = 2): string
    {
        $unit = ['B', 'KB', 'MB', 'GB', 'TB'];
        $exp = floor(log($bytes, 1024)) | 0;

        return round($bytes / (pow(1024, $exp)), $precision) . $unit[$exp];
    }
}

if (! function_exists('is_internal_site')) {
    function is_internal_site(): bool
    {
        return Features::isCode4RomaniaSite();
    }
}

if (! function_exists('is_external_site')) {
    function is_external_site(): bool
    {
        return ! is_internal_site();
    }
}

if (! function_exists('favicon_url')) {
    function favicon_url(): string
    {
        return settings('site.favicon')
            ? Storage::url(settings('site.favicon'))
            : Vite::asset('resources/images/favicon.png');
    }
}
