<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Intervention\Image\Image;
use Plank\Mediable\Facades\ImageManipulator;
use Plank\Mediable\ImageManipulation;

class MediaServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerImageVariants();
    }

    protected function registerImageVariants(): void
    {
        ImageManipulator::defineVariant(
            'thumb',
            ImageManipulation::make(function (Image $image) {
                $image->resize(256, 256, function ($constraint) {
                    $constraint->aspectRatio();
                });
            })
        );

        ImageManipulator::defineVariant(
            '600',
            ImageManipulation::make(function (Image $image) {
                $image->resize(600, 600, function ($constraint) {
                    $constraint->aspectRatio();
                });
            })
        );
    }
}
