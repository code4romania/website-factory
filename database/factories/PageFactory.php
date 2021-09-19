<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Page;

class PageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Page::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'title' => $this->translatedFaker('sentence'),
            'slug'  => $this->translatedFaker('slug'),
        ];
    }
}
