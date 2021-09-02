<?php

declare(strict_types=1);

namespace Database\Factories;

use Astrotomic\Translatable\Locales;
use Illuminate\Database\Eloquent\Factories\Factory as BaseFactory;
use Illuminate\Support\Collection;

abstract class Factory extends BaseFactory
{
    public function translatedFaker(string $method): Collection
    {
        return collect(app(Locales::class)->all())
            ->mapWithKeys(fn (string $locale) => [
                $locale => $this->faker->$method(),
            ]);
    }
}
