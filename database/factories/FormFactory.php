<?php

declare(strict_types=1);

namespace Database\Factories;

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
            'title' => $this->translatedFaker('sentence'),
            'slug' => $this->translatedFaker('slug'),
            'store_submissions' => $this->faker->boolean(),
            'send_submissions' => $send_submissions,
            'recipients' => $send_submissions ? collect([
                $this->faker->safeEmail(),
                $this->faker->safeEmail(),
                $this->faker->safeEmail(),
            ])->join(\PHP_EOL) : null,
        ];
    }

    public function withField(array $field = []): self
    {
        return $this->afterCreating(function (Form $form) use ($field) {
            $type = $field['type'];

            unset($field['type']);

            if (\array_key_exists('options', $field) && \is_array($field['options'])) {
                $field['options'] = implode(\PHP_EOL, $field['options']);
            }

            $form->blocks()->create([
                'blockable_id' => $form->id,
                'blockable_type' => $form->getMorphClass(),
                'position' => 1,
                'type' => $type,
                'content' => array_merge([
                    'label' => $this->translatedFaker('word'),
                    'help' => $this->translatedFaker('sentence'),
                ], $field),
            ]);
        });
    }
}
