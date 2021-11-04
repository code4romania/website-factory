<?php

declare(strict_types=1);

namespace Database\Factories;

class BlockFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'type'      => null,
            'position'  => $this->faker->randomDigit(),
            'content'   => [],
            'parent_id' => null,
        ];
    }
}
