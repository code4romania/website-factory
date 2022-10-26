<?php

declare(strict_types=1);

namespace App\Providers;

use App\Services\BlockCollection;
use App\Services\SupportsTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;
use Inertia\Response;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        config(['app.version' => $this->getAppVersion()]);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Relation::enforceMorphMap([
            'block'             => \App\Models\Block::class,
            'decision_author'   => \App\Models\DecisionAuthor::class,
            'decision_category' => \App\Models\DecisionCategory::class,
            'decision'          => \App\Models\Decision::class,
            'form_field'        => \App\Models\FormField::class,
            'form_submission'   => \App\Models\FormSubmission::class,
            'form'              => \App\Models\Form::class,
            'language'          => \App\Models\Language::class,
            'media'             => \App\Models\Media::class,
            'menu_item'         => \App\Models\MenuItem::class,
            'page'              => \App\Models\Page::class,
            'partner'           => \App\Models\Partner::class,
            'person'            => \App\Models\Person::class,
            'post_category'     => \App\Models\PostCategory::class,
            'post'              => \App\Models\Post::class,
            'setting'           => \App\Models\Setting::class,
            'user'              => \App\Models\User::class,
        ]);

        Validator::excludeUnvalidatedArrayKeys();

        Model::preventLazyLoading($this->app->isLocal());

        Password::defaults(
            fn () => Password::min(8)
                ->letters()
                ->symbols()
                ->uncompromised()
        );

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
            $model = resolve($model);

            if (SupportsTrait::blocks($model)) {
                $allowedBlocks = (new BlockCollection($model->allowedBlockType ?? 'block'))->all();
            }

            if (SupportsTrait::translatable($model)) {
                $translatable = $model->translatable;
            }

            $morphClass = $model->getMorphClass();

            return $this->with([
                'model' => [
                    'name'               => $morphClass,
                    'admin_route_prefix' => 'admin.' . Str::plural($morphClass),
                    'front_route_prefix' => 'front.' . Str::plural($morphClass),
                    'allowed_blocks'     => $allowedBlocks ?? [],
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

    /**
     * Read the application version.
     *
     * @return string
     */
    public function getAppVersion(): string
    {
        $version = base_path('.version');

        if (! file_exists($version)) {
            return 'develop';
        }

        return trim(file_get_contents($version));
    }
}
