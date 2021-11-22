<?php

declare(strict_types=1);

namespace App\View\Components\Site;

use App\Models\MenuItem;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Illuminate\Support\Traits\Localizable;
use Illuminate\View\Component;

class Header extends Component
{
    use Localizable;

    public string $logo;

    public Collection $menu;

    public Collection $alternateUrls;

    public function __construct()
    {
        $this->logo = asset('assets/images/logo.png');

        $this->menu = $this->getMenuItems();

        $this->alternateUrls = $this->getAlternateUrls();
    }

    public function render(): View
    {
        return view('components.site.header');
    }

    private function getMenuItems(): Collection
    {
        return Cache::rememberForever('menu-header', function () {
            return MenuItem::query()
                ->location('header')
                ->get()
                ->toTree();
        });
    }

    private function getAlternateUrls(): Collection
    {
        $routeName = Route::currentRouteName();

        $model = collect(Route::getCurrentRoute()->parameters())
            ->filter(fn ($value) => $value instanceof Model)
            ->first();

        return locales()
            ->reject(fn (string $locale) => app()->getLocale() === $locale)
            ->mapWithKeys(function (string $locale) use ($routeName, $model) {
                if (Str::endsWith($routeName, '.index')) {
                    return $this->withLocale($locale, fn () => [
                        $locale => route($routeName, ['locale' => $locale]),
                    ]);
                }

                if (! \is_null($model)) {
                    $key = $model->getMorphClass();

                    return $this->withLocale($locale, fn () => [
                        $locale => route($routeName, [
                            'locale' => $locale,
                            $key     => $model->slug,
                        ]),
                    ]);
                }

                return [];
            })
            ->filter();
    }
}
