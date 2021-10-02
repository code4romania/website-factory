<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'admin.layout';

    /**
     * Determine the current asset version.
     *
     * @param  \Illuminate\Http\Request $request
     * @return string|null
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [
            'auth' => fn () => [
                'user' => $request->user(),
            ],
            'flash' => fn () => $this->flash($request),
            'route'  => fn () => $request->route()->getName(),
            'app'    => fn () => [
                'debug'   => config('app.debug'),
                'version' => config('app.version'),
            ],
            'locales' => fn () => [
                'available' => config('translatable.locales', []),
                'current'   => app()->getLocale(),
            ],
        ]);
    }

    protected function flash(Request $request): ?array
    {
        if ($request->session()->has('error')) {
            $type = 'error';
        } elseif ($request->session()->has('success')) {
            $type = 'success';
        }

        if (! isset($type)) {
            return null;
        }

        return [
            'message' => $request->session()->get($type),
            'details' => $request->session()->get('details'),
            'type'    => $type,
        ];
    }
}
