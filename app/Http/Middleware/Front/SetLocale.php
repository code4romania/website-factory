<?php

declare(strict_types=1);

namespace App\Http\Middleware\Front;

use Closure;
use Illuminate\Http\Request;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  Request $request
     * @param  Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $locale = $request->segment(1);

        // Set default locale as fallback
        tap(settings('site.default_locale'), function ($locale) {
            if (active_locales()->has($locale)) {
                app()->setFallbackLocale($locale);
            }
        });

        if (! active_locales()->has($locale)) {
            return redirect()->to(
                collect($request->segments())
                    ->prepend(app()->getFallbackLocale())
                    ->implode('/')
            );
        }

        app()->setLocale($locale);

        return $next($request);
    }
}
