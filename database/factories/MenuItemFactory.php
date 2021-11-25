<?php

declare(strict_types=1);

namespace Database\Factories;

class MenuItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'location'  => $this->faker->randomElement(['header', 'footer']),
            'label'     => $this->translatedFaker('word'),
            'position'  => $this->faker->randomDigit(),
            'parent_id' => null,
        ];
    }

    public function header(): self
    {
        return $this->state(fn (array $attributes) => [
            'location' => 'header',
        ]);
    }

    public function footer(): self
    {
        return $this->state(fn (array $attributes) => [
            'location' => 'footer',
        ]);
    }

    public function external(): self
    {
        return $this->state(fn (array $attributes) => [
            'type' => 'external',
            'url'  => 'https://example.com/',
        ]);
    }
}
