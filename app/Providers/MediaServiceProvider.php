<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;
use Intervention\Image\Constraint;
use Intervention\Image\Facades\Image as ImageFacade;
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
                $image = ImageFacade::make($file->getPathname());

                $callback($image);

                $image->save();
            });
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
