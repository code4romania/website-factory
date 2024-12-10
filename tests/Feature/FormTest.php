<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Form;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class FormTest extends TestCase
{
    #[Test]
    #[DataProvider('fields')]
    public function it_generates_form_fields(array $expected)
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
            'form' => $form,
        ]));

        $response->assertSuccessful();
        $response->assertViewIs('front.forms.show');

        // submit
        $response = $this->post(
            localized_route('front.forms.show', ['form' => $form]),
            []
        );
    }

    #[Test]
    #[DataProvider('fields')]
    public function it_accepts_valid_submissions(array $expected, array $input)
    {
        $form = Form::factory()
            ->withField($expected)
            ->create();

        $field = $form->blocks->first();

        $response = $this->post(localized_route('front.forms.submit', ['form' => $form]), [
            $field->name => $input['valid'],
        ]);

        $response->assertValid($field->name);
    }

    #[Test]
    #[DataProvider('fields')]
    public function it_rejects_invalid_submissions(array $expected, array $input)
    {
        $form = Form::factory()
            ->withField($expected)
            ->create();

        $field = $form->blocks->first();

        $response = $this->post(localized_route('front.forms.submit', ['form' => $form]), [
            $field->name => $input['invalid'],
        ]);

        $response->assertInvalid($field->name);
    }

    public static function fields(): array
    {
        return [
            // Text
            'text-required' => [
                [
                    'type' => 'text',
                    'required' => true,
                    'min_length' => null,
                    'max_length' => null,
                ],
                [
                    'valid' => 'Test',
                    'invalid' => null,
                ],
            ],
            'text-optional' => [
                [
                    'type' => 'text',
                    'required' => false,
                    'min_length' => null,
                    'max_length' => null,
                ],
                [
                    'valid' => null,
                    'invalid' => [],
                ],
            ],
            'text-min' => [
                [
                    'type' => 'text',
                    'required' => false,
                    'min_length' => 25,
                    'max_length' => null,
                ],
                [
                    'valid' => 'This text is long enough to validate',
                    'invalid' => 'This is too short',
                ],
            ],
            'text-max' => [
                [
                    'type' => 'text',
                    'required' => false,
                    'min_length' => null,
                    'max_length' => 25,
                ],
                [
                    'valid' => 'This is short enough',
                    'invalid' => 'This is way too much text to validate',
                ],
            ],

            // Textarea
            'textarea-required' => [
                [
                    'type' => 'textarea',
                    'required' => true,
                    'min_length' => null,
                    'max_length' => null,
                ],
                [
                    'valid' => 'Test',
                    'invalid' => null,
                ],
            ],
            'textarea-optional' => [
                [
                    'type' => 'textarea',
                    'required' => false,
                    'min_length' => null,
                    'max_length' => null,
                ],
                [
                    'valid' => null,
                    'invalid' => [],
                ],
            ],
            'textarea-min' => [
                [
                    'type' => 'textarea',
                    'required' => false,
                    'min_length' => 25,
                    'max_length' => null,
                ],
                [
                    'valid' => 'This text is long enough to validate',
                    'invalid' => 'This is too short',
                ],
            ],
            'textarea-max' => [
                [
                    'type' => 'textarea',
                    'required' => false,
                    'min_length' => null,
                    'max_length' => 25,
                ],
                [
                    'valid' => 'This is short enough',
                    'invalid' => 'This is way too much text to validate',
                ],
            ],

            // Email
            'email-required' => [
                [
                    'type' => 'email',
                    'required' => true,
                ],
                [
                    'valid' => 'test@example.com',
                    'invalid' => null,
                ],
            ],
            'email-optional' => [
                [
                    'type' => 'email',
                    'required' => false,
                ],
                [
                    'valid' => null,
                    'invalid' => 'not an email',
                ],
            ],

            // Url
            'url-required' => [
                [
                    'type' => 'url',
                    'required' => true,
                ],
                [
                    'valid' => 'https://example.com',
                    'invalid' => null,
                ],
            ],
            'url-optional' => [
                [
                    'type' => 'url',
                    'required' => false,
                ],
                [
                    'valid' => null,
                    'invalid' => 'not a url',
                ],
            ],

            // Number
            'number-required' => [
                [
                    'type' => 'number',
                    'required' => true,
                    'min_value' => null,
                    'max_value' => null,
                ],
                [
                    'valid' => 17,
                    'invalid' => null,
                ],
            ],
            'number-optional' => [
                [
                    'type' => 'number',
                    'required' => false,
                    'min_value' => null,
                    'max_value' => null,
                ],
                [
                    'valid' => null,
                    'invalid' => 'not a number',
                ],
            ],
            'number-min' => [
                [
                    'type' => 'number',
                    'required' => false,
                    'min_value' => 17,
                    'max_value' => null,
                ],
                [
                    'valid' => 17,
                    'invalid' => 5,
                ],
            ],
            'number-max' => [
                [
                    'type' => 'number',
                    'required' => false,
                    'min_value' => null,
                    'max_value' => 17,
                ],
                [
                    'valid' => 17,
                    'invalid' => 25,
                ],
            ],
            'number-min-0' => [
                [
                    'type' => 'number',
                    'required' => false,
                    'min_value' => 0,
                    'max_value' => 1,
                ],
                [
                    'valid' => 1,
                    'invalid' => 5,
                ],
            ],
            'number-max-0' => [
                [
                    'type' => 'number',
                    'required' => false,
                    'min_value' => 5,
                    'max_value' => 0,
                ],
                [
                    'valid' => \PHP_INT_MAX,
                    'invalid' => 3,
                ],
            ],

            // Date
            'date-required' => [
                [
                    'type' => 'date',
                    'required' => true,
                    'min_date' => null,
                    'max_date' => null,
                ],
                [
                    'valid' => today(),
                    'invalid' => null,
                ],
            ],
            'date-optional' => [
                [
                    'type' => 'date',
                    'required' => false,
                    'min_date' => null,
                    'max_date' => null,
                ],
                [
                    'valid' => null,
                    'invalid' => 'not a date',
                ],
            ],
            'date-min' => [
                [
                    'type' => 'date',
                    'required' => false,
                    'min_date' => '2020-01-01',
                    'max_date' => null,
                ],
                [
                    'valid' => '2022-01-01',
                    'invalid' => '1999-01-01',
                ],
            ],
            'date-max' => [
                [
                    'type' => 'date',
                    'required' => false,
                    'min_date' => null,
                    'max_date' => '2021-12-31',
                ],
                [
                    'valid' => '1999-01-01',
                    'invalid' => '2022-01-01',
                ],
            ],
            'date-minmax' => [
                [
                    'type' => 'date',
                    'required' => false,
                    'min_date' => '2020-01-01',
                    'max_date' => '2021-12-31',
                ],
                [
                    'valid' => '2020-06-01',
                    'invalid' => '2022-01-01',
                ],
            ],

            // Radio
            'radio-required' => [
                [
                    'type' => 'radio',
                    'required' => true,
                    'options' => [
                        'similique',
                        'accusantium',
                        'minima',
                        'deleniti',
                    ],
                ],
                [
                    'valid' => 'similique',
                    'invalid' => null,
                ],
            ],

            'radio-optional' => [
                [
                    'type' => 'radio',
                    'required' => false,
                    'options' => [
                        'assumenda',
                        'excepturi',
                        'impedit',
                        'autem',
                    ],
                ],
                [
                    'valid' => null,
                    'invalid' => 'not a valid option',
                ],
            ],

            // Checkbox
            'checkbox-required' => [
                [
                    'type' => 'checkbox',
                    'required' => true,
                    'options' => [
                        'architecto',
                        'quis',
                        'maiores',
                    ],
                ],
                [
                    'valid' => ['quis', 'maiores'],
                    'invalid' => null,
                ],
            ],

            'checkbox-optional' => [
                [
                    'type' => 'checkbox',
                    'required' => false,
                    'options' => [
                        'dolorem',
                        'iure',
                        'animi',
                        'reprehenderit',
                    ],
                ],
                [
                    'valid' => ['iure'],
                    'invalid' => 'not a valid option',
                ],
            ],
        ];
    }
}
