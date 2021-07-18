<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * The Website Factory version.
     *
     * @var string
     */
    public const VERSION = '0.1.0';

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        config(['app.version' => static::VERSION]);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
