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
                    ]),
                ]);
        });
    }
}
