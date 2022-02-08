<?php

declare(strict_types=1);

namespace App\Http\Middleware\Front;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SetLocale
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
        $locale = $request->segment(1);

        if (! locales()->has($locale)) {
            return redirect()->to(
                collect($request->segments())
                    ->prepend(config('app.locale'))
                    ->implode('/')
            );
        }

        app()->setLocale($locale);

        return $next($request);
    }
}
