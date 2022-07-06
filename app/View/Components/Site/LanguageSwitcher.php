<?php

declare(strict_types=1);

namespace App\View\Components\Site;

use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Illuminate\Support\Traits\Localizable;
use Illuminate\View\Component;

class LanguageSwitcher extends Component
{
    use Localizable;

    public Collection $alternateUrls;

    public function __construct()
    {
        $this->alternateUrls = $this->getAlternateUrls();
    }

    public function render(): View
    {
        return view('components.site.language-switcher');
    }

    public function shouldRender(): bool
    {
        return $this->alternateUrls->count() > 1;
    }

    private function getAlternateUrls(): Collection
    {
        $routeName = Route::currentRouteName();

        $model = collect(Route::getCurrentRoute()->parameters())
            ->filter(fn ($value) => $value instanceof Model)
            ->first();

        return active_locales()
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

                    return $model?->url;
                }),
            ])
            ->filter();
    }
}
