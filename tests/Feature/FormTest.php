<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Form;
use Tests\TestCase;

class FormTest extends TestCase
{
    /** @dataProvider fields */
    public function test_it_generates_form_fields(array $expected)
    {
        $form = Form::factory()
            ->withField($expected)
            ->create();

        $field = $form->blocks->first();

        $this->assertEquals($expected['type'], $field->type);
        $this->assertEquals($expected['required'], $field->checkbox('required'));

        if (\array_key_exists('min_length', $expected)) {
            $this->assertEquals($expected['min_length'], $field->input('min_length'));
        }

        if (\array_key_exists('max_length', $expected)) {
            $this->assertEquals($expected['max_length'], $field->input('max_length'));
        }

        if (\array_key_exists('min_value', $expected)) {
            $this->assertEquals($expected['min_value'], $field->input('min_value'));
        }

        if (\array_key_exists('max_value', $expected)) {
            $this->assertEquals($expected['max_value'], $field->input('max_value'));
        }

        if (\array_key_exists('min_date', $expected)) {
            $this->assertEquals($expected['min_date'], $field->input('min_date'));
        }

        if (\array_key_exists('max_date', $expected)) {
            $this->assertEquals($expected['max_date'], $field->input('max_date'));
        }

        // Show
        $response = $this->get(localized_route('front.forms.show', [
            'form' => $form->uuid,
        ]));

        $response->assertSuccessful();
        $response->assertViewIs('front.forms.show');

        // dd($response);
    }

    public function fields(): array
    {
        return [
            // Text
            'text-required' => [
                [
                    'type'       => 'text',
                    'required'   => true,
                    'min_length' => null,
                    'max_length' => null,
                ],
            ],
            'text-optional' => [
                [
                    'type'       => 'text',
                    'required'   => false,
                    'min_length' => null,
                    'max_length' => null,
                ],
            ],
            'text-min' => [
                [
                    'type'       => 'text',
                    'required'   => false,
                    'min_length' => \mt_rand(1, 9),
                    'max_length' => null,
                ],
            ],
            'text-max' => [
                [
                    'type'       => 'text',
                    'required'   => false,
                    'min_length' => null,
                    'max_length' => \mt_rand(1, 9),
                ],
            ],

            // Textarea
            'textarea-required' => [
                [
                    'type'       => 'textarea',
                    'required'   => true,
                    'min_length' => null,
                    'max_length' => null,
                ],
            ],
            'textarea-optional' => [
                [
                    'type'       => 'textarea',
                    'required'   => false,
                    'min_length' => null,
                    'max_length' => null,
                ],
            ],
            'textarea-min' => [
                [
                    'type'       => 'textarea',
                    'required'   => false,
                    'min_length' => \mt_rand(1, 9),
                    'max_length' => null,
                ],
            ],
            'textarea-max' => [
                [
                    'type'       => 'textarea',
                    'required'   => false,
                    'min_length' => null,
                    'max_length' => \mt_rand(1, 9),
                ],
            ],

            // Email
            'email-required' => [
                [
                    'type'     => 'email',
                    'required' => true,
                ],
            ],
            'email-optional' => [
                [
                    'type'     => 'email',
                    'required' => false,
                ],
            ],

            // Url
            'url-required' => [
                [
                    'type'     => 'url',
                    'required' => true,
                ],
            ],
            'url-optional' => [
                [
                    'type'     => 'url',
                    'required' => false,
                ],
            ],

            // Number
            'number-required' => [
                [
                    'type'      => 'number',
                    'required'  => true,
                    'min_value' => null,
                    'max_value' => null,
                ],
            ],
            'number-optional' => [
                [
                    'type'      => 'number',
                    'required'  => false,
                    'min_value' => null,
                    'max_value' => null,
                ],
            ],
            'number-min' => [
                [
                    'type'      => 'number',
                    'required'  => false,
                    'min_value' => \mt_rand(1, 9),
                    'max_value' => null,
                ],
            ],
            'number-max' => [
                [
                    'type'      => 'number',
                    'required'  => false,
                    'min_value' => null,
                    'max_value' => \mt_rand(1, 9),
                ],
            ],

            // Date
            'date-required' => [
                [
                    'type'     => 'date',
                    'required' => true,
                    'min_date' => null,
                    'max_date' => null,
                ],
            ],
            'date-optional' => [
                [
                    'type'     => 'date',
                    'required' => false,
                    'min_date' => null,
                    'max_date' => null,
                ],
            ],
            'date-min' => [
                [
                    'type'     => 'date',
                    'required' => false,
                    'min_date' => '2020-01-01',
                    'max_date' => null,
                ],
            ],
            'date-max' => [
                [
                    'type'     => 'date',
                    'required' => false,
                    'min_date' => null,
                    'max_date' => '2021-12-31',
                ],
            ],
            'date-minmax' => [
                [
                    'type'     => 'date',
                    'required' => false,
                    'min_date' => '2020-01-01',
                    'max_date' => '2021-12-31',
                ],
            ],

            // Radio
            'radio-required' => [
                [
                    'type'     => 'radio',
                    'required' => true,
                    'options'  => [
                        'similique',
                        'accusantium',
                        'minima',
                        'deleniti',
                    ],
                ],
            ],

            'radio-optional' => [
                [
                    'type'     => 'radio',
                    'required' => false,
                    'options'  => [
                        'assumenda',
                        'excepturi',
                        'impedit',
                        'autem',
                    ],
                ],
            ],

            // Checkbox
            'checkbox-required' => [
                [
                    'type'     => 'checkbox',
                    'required' => true,
                    'options'  => [
                        'architecto',
                        'quis',
                        'maiores',
                    ],
                ],
            ],

            'checkbox-optional' => [
                [
                    'type'     => 'checkbox',
                    'required' => false,
                    'options'  => [
                        'dolorem',
                        'iure',
                        'animi',
                        'reprehenderit',
                    ],
                ],
            ],

        ];
    }
}
