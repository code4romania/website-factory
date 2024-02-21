<?php

declare(strict_types=1);

namespace App\Http\Middleware\Admin;

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
        $locale = auth()->check()
            ? auth()->user()->preferredLocale()
            : app()->getFallbackLocale();

        if (locales()->has($locale)) {
            app()->setLocale($locale);
        }

        return $next($request);
    }
}
