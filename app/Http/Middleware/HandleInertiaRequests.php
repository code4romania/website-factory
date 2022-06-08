<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Models\Language;
use App\Models\MenuItem;
use App\Models\Setting;
use App\Models\User;
use App\Services\Features;
use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'admin';

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
            'route' => fn () => $request->route()->getName(),
            'app'   => fn () => [
                'debug'   => config('app.debug'),
                'edition' => config('website-factory.edition'),
                'version' => config('app.version'),
            ],
            'locales' => fn () => [
                'available' => locales()->keys(),
                'active'    => active_locales()->keys(),
                'current'   => app()->getLocale(),
            ],
            'navigation' => fn () => $this->navigation($request),
            'mediaLibrary' => fn () => $this->mediaLibraryConfig(),
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

    /**
     * Define the application's admin navigation.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    protected function navigation(Request $request): array
    {
        if (! auth()->check()) {
            return [];
        }

        $menus = [
            'primary' => [
                [
                    'route' => 'admin.dashboard',
                    'label' => __('app.dashboard'),
                ],
                [
                    'route' => 'admin.pages.index',
                    'label' => trans_choice('page.label', 2),
                ],
                [
                    'route' => 'admin.posts.index',
                    'label' => trans_choice('post.label', 2),
                ],
                [
                    'enabled' => Features::hasDecisions(),
                    'route' => 'admin.decisions.index',
                    'label' => trans_choice('decision.label', 2),
                ],
                [
                    'route' => 'admin.forms.index',
                    'label' => trans_choice('form.label', 2),
                ],
                [
                    'route' => 'admin.people.index',
                    'label' => trans_choice('person.label', 2),
                ],
            ],
            'secondary' => [
                //
            ],
            'profile' => [
                [
                    'enabled' => auth()->user()->can('create', MenuItem::class),
                    'route' => 'admin.menus.index',
                    'label' => trans_choice('menu.label', 2),
                ],
                [
                    'enabled' => auth()->user()->can('create', User::class),
                    'route' => 'admin.users.index',
                    'label' => trans_choice('user.label', 2),
                ],
                [
                    'enabled' => auth()->user()->can('create', Setting::class),
                    'route' => 'admin.settings.index',
                    'label' => trans_choice('setting.label', 2),
                ],
                [
                    'enabled' => auth()->user()->can('create', Language::class),
                    'route' => 'admin.languages.index',
                    'label' => trans_choice('language.label', 2),
                ],
                [
                    'route' => 'auth.logout',
                    'label' => __('auth.logout'),
                    'method' => 'post',
                ],
            ],
        ];

        return collect($menus)
            ->map(function (array $items) {
                return collect($items)
                    ->filter(fn (array $item) => \boolval($item['enabled'] ?? true))
                    ->values();
            })
            ->toArray();
    }

    protected function mediaLibraryConfig(): array
    {
        $extractConfig = function (string $prop) {
            return collect(config('mediable.aggregate_types'))
                ->mapToGroups(function ($item, $key) use ($prop) {
                    $key = \in_array($key, ['image', 'vector'])
                    ? 'images'
                    : 'files';

                    return [$key => $item[$prop]];
                })
                ->map(
                    fn ($item) => $item
                        ->flatten()
                        ->sort()
                        ->values()
                );
        };

        return [
            'allowedExtensions' => $extractConfig('extensions'),
            'allowedMimeTypes'  => $extractConfig('mime_types'),

            'maxFileSize' => [
                'raw'       => config('mediable.max_size'),
                'formatted' => format_bytes(config('mediable.max_size')),
            ],
        ];
    }
}
