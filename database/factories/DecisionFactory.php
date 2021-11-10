<?php

declare(strict_types=1);

namespace Database\Factories;

class DecisionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'        => $this->translatedFaker('sentence'),
            'slug'         => $this->translatedFaker('slug'),
            'description'  => $this->translatedFaker('text'),
            'published_at' => $this->faker->boolean(95) ? $this->faker->dateTimeThisYear() : null,
            'deleted_at'   => $this->faker->boolean(5) ? $this->faker->dateTime() : null,
        ];
    }
}
