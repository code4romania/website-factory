<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
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
        Relation::morphMap([
            'block' => \App\Models\Block::class,
            'form'  => \App\Models\Form::class,
            'page'  => \App\Models\Page::class,
            'post'  => \App\Models\Post::class,
            'user'  => \App\Models\User::class,
        ]);

        Model::preventLazyLoading(! $this->app->isProduction());
    }
}
