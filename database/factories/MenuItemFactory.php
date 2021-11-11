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
            'type'      => 'external',
            'label'     => $this->translatedFaker('word'),
            'position'  => $this->faker->randomDigit(),
            'parent_id' => null,
        ];
    }
}
