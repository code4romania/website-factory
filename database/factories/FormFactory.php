<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Block;
use App\Models\Form;

class FormFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $send_submissions = $this->faker->boolean();

        return [
            'title'             => $this->translatedFaker('sentence'),
            'store_submissions' => $this->faker->boolean(),
            'send_submissions'  => $send_submissions,
            'recipients'        => $send_submissions ? [
                $this->faker->safeEmail(),
                $this->faker->safeEmail(),
                $this->faker->safeEmail(),
            ] : null,
        ];
    }

    /**
     * @param  string|array|null               $fields
     * @return \Database\Factories\FormFactory
     */
    public function withSection($fields = null): self
    {
        $fields = collect($fields);

        return $this->afterCreating(function (Form $form) use ($fields) {
            Block::factory()
                ->for($form, 'blockable')
                ->state([
                    'type'    => 'form_section',
                    'content' => [
                        'title'       => $this->translatedFaker('word'),
                        'description' => $this->translatedFaker('sentence'),
                    ],
                ])
                ->afterCreating(function (Block $section) use ($fields) {
                    $section->children()->createMany(
                        $fields->map(fn (array $field, int $position) => [
                            'blockable_id'   => $section->blockable_id,
                            'blockable_type' => $section->blockable_type,
                            'position'       => $position,
                            'type'           => 'form_field',
                            'content'        => $field,
                            'parent_id'      => $section->id,
                        ])
                    );
                })
                ->create();

            $form->loadMissing('blocks.children');
        });
    }
}
