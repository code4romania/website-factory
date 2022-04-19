<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\Language;
use Illuminate\Support\ServiceProvider;
use Throwable;

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
            try {
                return Language::all()
                    ->mapWithKeys(fn (Language $language) => [
                        $language->code => $language->only(['name', 'enabled']),
                    ])
                    ->reject(fn (array $config) => ! $config['enabled']);
            } catch (Throwable $th) {
                logger('Could not open connection to database server. Skipping loading site languages...', [
                    'error' => $th->getMessage(),
                ]);
            }
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
