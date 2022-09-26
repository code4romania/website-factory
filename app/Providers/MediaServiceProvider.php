<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;
use Intervention\Image\Image;
use Plank\Mediable\Facades\ImageManipulator;
use Plank\Mediable\ImageManipulation;

class MediaServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->imageVariants()
            ->each(function (ImageManipulation $manipulation, string $name) {
                ImageManipulator::defineVariant($name, $manipulation);
            });
    }

    protected function imageVariants(): Collection
    {
        return collect([
            'thumb' => ImageManipulation::make(function (Image $image) {
                $image->resize(256, 256, function (Constraint $constraint) {
                    $constraint->aspectRatio();
                });
            }),
            '600' => ImageManipulation::make(function (Image $image) {
                $image->resize(600, 600, function (Constraint $constraint) {
                    $constraint->aspectRatio();
                });
            }),
        ]);
    }
}
