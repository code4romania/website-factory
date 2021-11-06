<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Support\Str;

class PersonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->name();

        return [
            'name'         => $name,
            'slug'         => Str::slug($name),
            'title'        => $this->translatedFaker('jobTitle'),
            'description'  => $this->translatedFaker('realText'),
            'deleted_at'   => $this->faker->boolean(5) ? $this->faker->dateTime() : null,
        ];
    }
}
