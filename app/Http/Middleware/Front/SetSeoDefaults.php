<?php

declare(strict_types=1);

namespace App\Http\Middleware\Front;

use Closure;
use Illuminate\Http\Request;

class SetSeoDefaults
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
        $title = (string) localized_settings('site.title');
        $description = (string) localized_settings('site.description');

        seo()
            ->withUrl()
            ->title(
                default: $title,
                modifier: fn (string $title) => $title . ' — ' . localized_settings('site.title')
            )
            ->description(default: $description);

        return $next($request);
    }
}
