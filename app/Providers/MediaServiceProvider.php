<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;
use Intervention\Image\Image;
use Intervention\Image\Laravel\Facades\Image as ImageFacade;
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
        $this->registerMacros();

        $this->imageVariants()
            ->each(function (ImageManipulation $manipulation, string $name) {
                ImageManipulator::defineVariant($name, $manipulation);
            });
    }

    protected function registerMacros(): void
    {
        UploadedFile::macro('manipulate', function (callable $callback) {
            return tap($this, function (UploadedFile $file) use ($callback) {
                $image = ImageFacade::read($file->getPathname());

                $callback($image);

                $image->save();
            });
        });
    }

    protected function imageVariants(): Collection
    {
        return collect([
            'thumb' => ImageManipulation::make(function (Image $image) {
                $image->scaleDown(256, 256);
            }),
            '600' => ImageManipulation::make(function (Image $image) {
                $image->scaleDown(600, 600);
            }),
        ]);
    }
}
