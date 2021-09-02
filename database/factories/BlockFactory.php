<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Block;

class BlockFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Block::class;

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
