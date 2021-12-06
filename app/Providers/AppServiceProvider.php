<?php

declare(strict_types=1);

namespace App\Providers;

use App\Services\BlockCollection;
use App\Services\SupportsTrait;
use App\Traits\HasLayout;
use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
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
            'block'         => \App\Models\Block::class,
            'decision'      => \App\Models\Decision::class,
            'form'          => \App\Models\Form::class,
            'media'         => \App\Models\Media::class,
            'page'          => \App\Models\Page::class,
            'person'        => \App\Models\Person::class,
            'post_category' => \App\Models\PostCategory::class,
            'post'          => \App\Models\Post::class,
            'user'          => \App\Models\User::class,
        ]);

        Validator::excludeUnvalidatedArrayKeys();

        Model::preventLazyLoading($this->app->isLocal());

        $this->registerBlueprintMacros();
        $this->registerCarbonMacros();
        $this->registerInertiaMacros();

        Paginator::defaultView('pagination.default');
        Paginator::defaultSimpleView('pagination.simple');
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

    protected function registerCarbonMacros(): void
    {
        Carbon::macro('toLocaleDateString', fn () => self::this()->isoFormat('D MMMM YYYY'));
        Carbon::macro('toLocaleDateTimeString', fn () => self::this()->isoFormat('LLL'));
    }

    protected function registerInertiaMacros(): void
    {
        Response::macro('model', function (string $model) {
            /** @var Model */
            $model = \resolve($model);
            $traits = \class_uses_recursive($model);

            if (SupportsTrait::blocks($model)) {
                $blocks = (new BlockCollection($model->allowedBlockType ?? 'block'))->all();
            }

            if (\in_array(HasLayout::class, $traits)) {
                $layouts = $model->getAvailableLayouts();
            }

            if (\in_array(Translatable::class, $traits)) {
                $translatable = $model->translatable;
            }

            $morphClass = $model->getMorphClass();

            return $this->with([
                'model' => [
                    'name'               => $morphClass,
                    'admin_route_prefix' => 'admin.' . Str::plural($morphClass),
                    'front_route_prefix' => 'front.' . Str::plural($morphClass),
                    'blocks'             => $blocks ?? [],
                    'layouts'            => $layouts ?? [],
                    'translatable'       => $translatable ?? [],
                ],
            ]);
        });

        Response::macro('submenu', function (array $items) {
            return $this->with([
                'submenu' => $items,
            ]);
        });
    }
}
