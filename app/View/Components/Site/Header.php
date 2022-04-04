<?php

declare(strict_types=1);

namespace App\View\Components\Site;

use App\Models\MenuItem;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Traits\Localizable;
use Illuminate\View\Component;

class Header extends Component
{
    use Localizable;

    public string $logo;

    public ?string $title;

    public Collection $menu;

    public Collection $alternateUrls;

    public function __construct()
    {
        $this->logo = settings('site.logo')
            ? Storage::cloud()->url(settings('site.logo'))
            : ''; // TODO: fallback

        $this->title = localized_settings('site.title');

        $this->menu = Cache::rememberForever(
            'menu-header',
            fn () => MenuItem::query()
                ->location('header')
                ->get()
                ->toTree()
        );

        $this->alternateUrls = $this->getAlternateUrls();
    }

    public function render(): View
    {
        return view('components.site.header');
    }

    private function getAlternateUrls(): Collection
    {
        $routeName = Route::currentRouteName();

        $model = collect(Route::getCurrentRoute()->parameters())
            ->filter(fn ($value) => $value instanceof Model)
            ->first();

        return locales()
            ->reject(fn (array $config, string $locale) => app()->getLocale() === $locale)
            ->mapWithKeys(fn (array $config, string $locale) => [
                $locale => $this->withLocale($locale, function () use ($routeName, $model, $locale) {
                    if (Str::endsWith($routeName, '.search')) {
                        return route($routeName, array_merge(
                            Arr::wrap(request()->query()),
                            ['locale' => $locale]
                        ));
                    }

                    if (Str::endsWith($routeName, '.index')) {
                        return route($routeName, ['locale' => $locale]);
                    }

                    if (! \is_null($model)) {
                        return $model->url;
                    }

                    return null;
                }),
            ])
            ->filter();
    }
}
