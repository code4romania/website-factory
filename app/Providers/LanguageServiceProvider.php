<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\Language;
use Illuminate\Support\ServiceProvider;

class LanguageServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('languages', function () {
            return Language::all()
                ->mapWithKeys(fn (Language $language) => [
                    $language->code => $language->only([
                        'name',
                        'nativeName',
                        'enabled',
                        'direction',
                    ]),
                ]);
        });
    }

    public function boot(): void
    {
        // Set default locale as fallback
        tap(settings('site.default_locale'), function ($locale) {
            if (active_locales()->has($locale)) {
                app()->setFallbackLocale($locale);
            }
        });
    }
}
