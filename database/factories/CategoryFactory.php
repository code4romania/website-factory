<?php

declare(strict_types=1);

namespace Database\Factories;

class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->translatedFaker('word'),
        ];
    }
}
