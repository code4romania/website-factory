<?php

declare(strict_types=1);

namespace App\Http\Middleware\Front;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;

class SetSeoDefaults
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request                                    $request
     * @param  \Closure                                                    $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next): Response|RedirectResponse
    {
        tap(settings('site_title'), function ($value) {
            $value = Arr::wrap($value);

            $value = Arr::get($value, app()->getLocale())
                ?? Arr::get($value, config('app.fallback_locale'));

            if (! $value) {
                return;
            }

            app('seotools')->setTitle($value);
            app('seotools.metatags')->setTitleDefault($value);
        });

        tap(settings('site_description'), function ($value) {
            $value = Arr::get($value, app()->getLocale())
                ?? Arr::get($value, config('app.fallback_locale'));

            if (! $value) {
                return;
            }

            app('seotools')->setDescription($value);
        });

        return $next($request);
    }
}
