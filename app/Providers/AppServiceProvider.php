<?php

declare(strict_types=1);

namespace App\Providers;

use App\Services\BlockCollection;
use App\Traits\HasBlocks;
use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use Inertia\Response;

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

        Validator::excludeUnvalidatedArrayKeys();

        Model::preventLazyLoading(! $this->app->isProduction());

        $this->registerBlueprintMacros();
        $this->registerInertiaMacros();
    }

    protected function registerBlueprintMacros(): void
    {
        Blueprint::macro('commonFields', function (bool $softDeletes = true, bool $published = true) {
            $this->id();
            $this->timestamps();

            if ($softDeletes) {
                $this->softDeletes();
            }

            if ($published) {
                $this->timestamp('published_at')->nullable();
            }
        });
    }

    protected function registerInertiaMacros(): void
    {
        Response::macro('model', function (string $model) {
            $model = \resolve($model);
            $traits = \class_uses_recursive($model);

            return $this->with([
                'model' => [
                    'blocks'       => \in_array(HasBlocks::class, $traits) ? (new BlockCollection('block'))->all() : [],
                    'repeaters'    => \in_array(HasBlocks::class, $traits) ? (new BlockCollection('repeater'))->all() : [],
                    'translatable' => \in_array(Translatable::class, $traits) ? $model->translatable : [],
                ],
            ]);
        });
    }
}
