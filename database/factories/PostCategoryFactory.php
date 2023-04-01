<?php

declare(strict_types=1);

namespace Database\Factories;

class PostCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'title' => $this->translatedFaker('word'),
            'slug' => $this->translatedFaker('slug'),
            'description' => $this->translatedFaker('text'),
            'deleted_at' => $this->faker->boolean(5) ? $this->faker->dateTime() : null,
        ];
    }
}
