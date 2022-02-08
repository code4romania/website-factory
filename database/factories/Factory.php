<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory as BaseFactory;

abstract class Factory extends BaseFactory
{
    public function translatedFaker(string $method): array
    {
        return locales()
            ->mapWithKeys(fn (array $config, string $locale) => [
                $locale => $this->faker->$method(),
            ])
            ->toArray();
    }
}
