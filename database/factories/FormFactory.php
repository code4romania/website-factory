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
            'recipients'        => $send_submissions ? collect([
                $this->faker->safeEmail(),
                $this->faker->safeEmail(),
                $this->faker->safeEmail(),
            ])->join(PHP_EOL) : null,
        ];
    }

    public function withFields(array $fields = []): self
    {
        return $this->afterCreating(function (Form $form) use ($fields) {
            $fields = collect($fields)
                ->map(function (array $field, int $position) use ($form) {
                    $type = $field['type'];

                    unset($field['type']);

                    $content = \array_merge([
                        'label' => $this->translatedFaker('word'),
                        'help'  => $this->translatedFaker('sentence'),
                    ], $field);

                    return [
                        'blockable_id'   => $form->id,
                        'blockable_type' => $form->getMorphClass(),
                        'position'       => $position,
                        'type'           => $type,
                        'content'        => $content,
                    ];
                });

            $form->blocks()->createMany($fields);
        });
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
