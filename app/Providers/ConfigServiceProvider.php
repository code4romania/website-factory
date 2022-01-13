<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class ConfigServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Config::set(
            'website-factory.settings',
            Setting::all()
                ->groupBy('section')
                ->map
                ->pluck('value', 'key')
                ->toArray()
        );
    }
}
