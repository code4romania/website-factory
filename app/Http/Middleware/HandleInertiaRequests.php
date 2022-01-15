<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Models\MenuItem;
use App\Models\Setting;
use App\Models\User;
use App\Services\Features;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
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
            'route'  => fn () => $request->route()->getName(),
            'app'    => fn () => [
                'debug'   => config('app.debug'),
                'edition' => config('website-factory.edition'),
                'version' => config('app.version'),
            ],
            'locales' => fn () => [
                'available' => config('translatable.locales', []),
                'current'   => app()->getLocale(),
            ],
            'navigation' => fn () => collect(['primary', 'secondary'])
                ->mapWithKeys(fn (string $key) => [
                    $key => $this->{Str::camel("navigation-$key")}($request)
                        ->filter(function (array $item) {
                            if (! \array_key_exists('enabled', $item)) {
                                return true;
                            }

                            return \boolval($item['enabled']);
                        })
                        ->forget('enabled')
                        ->values()
                        ->all(),
                ]),

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
     * Define the application's primary navigation.
     *
     * @param  \Illuminate\Http\Request       $request
     * @return \Illuminate\Support\Collection
     */
    protected function navigationPrimary(Request $request): Collection
    {
        return collect([
            [
                'route' => 'admin.dashboard',
                'label' => __('app.dashboard'),
            ],
            [
                'route' => 'admin.pages.index',
                'label' => \trans_choice('page.label', 2),
            ],
            [
                'route' => 'admin.posts.index',
                'label' => \trans_choice('post.label', 2),
            ],
            [
                'enabled' => Features::hasDecisions(),
                'route' => 'admin.decisions.index',
                'label' => \trans_choice('decision.label', 2),
            ],
            [
                'route' => 'admin.forms.index',
                'label' => \trans_choice('form.label', 2),
            ],
            [
                'route' => 'admin.people.index',
                'label' => \trans_choice('person.label', 2),
            ],
        ]);
    }

    /**
     * Define the application's secondary navigation.
     *
     * @param  \Illuminate\Http\Request       $request
     * @return \Illuminate\Support\Collection
     */
    protected function navigationSecondary(Request $request): Collection
    {
        return collect([
            [
                'enabled' => auth()->user()->can('create', MenuItem::class),
                'route' => 'admin.menus.index',
                'label' => \trans_choice('menu.label', 2),
            ],
            [
                'enabled' => auth()->user()->can('create', User::class),
                'route' => 'admin.users.index',
                'label' => \trans_choice('user.label', 2),
            ],
            [
                'enabled' => auth()->user()->can('create', Setting::class),
                'route' => 'admin.settings.index',
                'label' => \trans_choice('setting.label', 2),
            ],
        ]);
    }
}
