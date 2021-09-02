<?php

declare(strict_types=1);

namespace Database\Factories\Translations;

use App\Translations\PageTranslation;
use Illuminate\Database\Eloquent\Factories\Factory;

class PageTranslationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PageTranslation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
        ];
    }
}
