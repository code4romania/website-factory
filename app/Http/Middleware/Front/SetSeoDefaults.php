<?php

declare(strict_types=1);

namespace App\Http\Middleware\Front;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
        $title = localized_settings('site.title');
        $description = localized_settings('site.description');

        app('seotools')
            ->setTitle($title)
            ->setDescription($description);

        app('seotools.metatags')
            ->setTitleDefault($title);

        return $next($request);
    }
}
