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
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $locale = $request->segment(1);

        if (! active_locales()->has($locale)) {
            return redirect()->to(
                collect($request->segments())
                    ->prepend(default_locale())
                    ->implode('/')
            );
        }

        app()->setLocale($locale);

        return $next($request);
    }
}
