<?php

declare(strict_types=1);

namespace Tests\Unit\Models;

use App\Models\Block;
use App\Models\Form;
use App\Models\Page;
use Tests\TestCase;

class FormTest extends TestCase
{
    /** @test */
    public function test_it_creates_an_empty_section()
    {
        $form = Form::factory()
            ->withSection()
            ->create();

        $this->assertCount(1, $form->sections());
        $this->assertEmpty($form->fields($form->sections()->first()));
    }

    /** @dataProvider fieldsProvider */
    public function test_it_creates_a_section_with_a_field(array $expected)
    {
        $form = Form::factory()
            ->withSection([$expected])
            ->create();

        $field = $form->fields($form->sections()->first())->first();

        $locale = app()->getLocale();

        $this->assertCount(1, $form->sections());

        $this->assertEquals($expected['type'], $field['type']);
        $this->assertEquals($expected['required'], $field['required']);
        $this->assertEquals($expected['label'][$locale], $field['label']);
        $this->assertEquals($expected['help'][$locale], $field['help']);

        if (array_key_exists('min_length', $expected)) {
            $this->assertEquals($expected['min_length'], $field['min_length']);
        }

        if (array_key_exists('max_length', $expected)) {
            $this->assertEquals($expected['max_length'], $field['max_length']);
        }

        if (array_key_exists('min_value', $expected)) {
            $this->assertEquals($expected['min_value'], $field['min_value']);
        }

        if (array_key_exists('max_value', $expected)) {
            $this->assertEquals($expected['max_value'], $field['max_value']);
        }

        if (array_key_exists('min_date', $expected)) {
            $this->assertEquals($expected['min_date'], $field['min_date']);
        }

        if (array_key_exists('max_date', $expected)) {
            $this->assertEquals($expected['max_date'], $field['max_date']);
        }
    }

    public function old_test_it_configures_the_form_fields()
    {
        $currentLocale = app()->getLocale();
        $sections = 2;
        $fields = $this->fields();

        $form = $this->createFormWithSectionsAndFields($fields, $sections);

        $allLabels = $form->getFieldsColumn('label');
        $this->assertCount($sections * $fields->count(), $allLabels);

        $form->fieldsBySection()->each(function ($section, $sectionIndex) use ($allLabels) {
            $section['fields']->each(function ($field, $fieldIndex) use ($sectionIndex, $allLabels) {
                $this->assertEquals($field['label'], $allLabels["fields.${sectionIndex}.${fieldIndex}"]);
            });
        });
    }

    public function old_test_it_generates_the_form_fields()
    {
        $fields = $this->fields();

        $form = $this->createFormWithSectionsAndFields($fields);

        $page = factory(Page::class)
            ->state('published')
            ->create();

        $page->blocks()->create(
            factory(Block::class)
                ->make([
                    'blockable_id'   => $this->faker->randomDigitNotNull,
                    'blockable_type' => 'page',
                    'type'           => 'form',
                    'position'       => 1,
                    'content'        => [
                        'form' => $form->id,
                    ],
                ])
                ->toArray()
        );

        $page->load('blocks');

        $this->visitRoute('front.pages.show', ['slug' => $page->slug])
            ->seeElement('form', [
                'method' => 'POST',
                'action' => route('front.form.submit', $form->id),
            ])
            ->seeElementCount('fieldset', 1)
            ->seeElementCount('.field', $fields->count());
    }

    public function fieldsProvider(): array
    {
        return [
            // Text
            'text-required' => $this->field([
                'type'       => 'text',
                'required'   => true,
                'min_length' => null,
                'max_length' => null,
            ]),
            'text-optional' => $this->field([
                'type'       => 'text',
                'required'   => false,
                'min_length' => null,
                'max_length' => null,
            ]),
            'text-min' => $this->field([
                'type'       => 'text',
                'required'   => false,
                'min_length' => \mt_rand(1, 9),
                'max_length' => null,
            ]),
            'text-max' => $this->field([
                'type'       => 'text',
                'required'   => false,
                'min_length' => null,
                'max_length' => \mt_rand(1, 9),
            ]),

            // Textarea
            'textarea-required' => $this->field([
                'type'       => 'textarea',
                'required'   => true,
                'min_length' => null,
                'max_length' => null,
            ]),
            'textarea-optional' => $this->field([
                'type'       => 'textarea',
                'required'   => false,
                'min_length' => null,
                'max_length' => null,
            ]),
            'textarea-min' => $this->field([
                'type'       => 'textarea',
                'required'   => false,
                'min_length' => \mt_rand(1, 9),
                'max_length' => null,
            ]),
            'textarea-max' => $this->field([
                'type'       => 'textarea',
                'required'   => false,
                'min_length' => null,
                'max_length' => \mt_rand(1, 9),
            ]),

            // Email
            'email-required' => $this->field([
                'type'     => 'email',
                'required' => true,
            ]),
            'email-optional' => $this->field([
                'type'     => 'email',
                'required' => false,
            ]),

            // Url
            'url-required' => $this->field([
                'type'     => 'url',
                'required' => true,
            ]),
            'url-optional' => $this->field([
                'type'     => 'url',
                'required' => false,
            ]),

            // Number
            'number-required' => $this->field([
                'type'      => 'number',
                'required'  => true,
                'min_value' => null,
                'max_value' => null,
            ]),
            'number-optional' => $this->field([
                'type'      => 'number',
                'required'  => false,
                'min_value' => null,
                'max_value' => null,
            ]),
            'number-min' => $this->field([
                'type'      => 'number',
                'required'  => false,
                'min_value' => \mt_rand(1, 9),
                'max_value' => null,
            ]),
            'number-max' => $this->field([
                'type'      => 'number',
                'required'  => false,
                'min_value' => null,
                'max_value' => \mt_rand(1, 9),
            ]),

            // Date
            'date-required' => $this->field([
                'type'     => 'date',
                'required' => true,
                'min_date' => null,
                'max_date' => null,
            ]),
            'date-optional' => $this->field([
                'type'     => 'date',
                'required' => false,
                'min_date' => null,
                'max_date' => null,
            ]),
            'date-min' => $this->field([
                'type'     => 'date',
                'required' => false,
                'min_date' => '2020-01-01',
                'max_date' => null,
            ]),
            'date-max' => $this->field([
                'type'     => 'date',
                'required' => false,
                'min_date' => null,
                'max_date' => '2021-12-31',
            ]),
            'date-minmax' => $this->field([
                'type'     => 'date',
                'required' => false,
                'min_date' => '2020-01-01',
                'max_date' => '2021-12-31',
            ]),

            // Radio
            'radio-required' => $this->field([
                'type'     => 'radio',
                'required' => true,
                'options'  => $this->localize([
                    'similique',
                    'accusantium',
                    'minima',
                    'deleniti',
                ]),
            ]),
            'radio-optional' => $this->field([
                'type'     => 'radio',
                'required' => false,
                'options'  => $this->localize([
                    'assumenda',
                    'excepturi',
                    'impedit',
                    'autem',
                ]),
            ]),

            // Checkbox
            'checkbox-required' => $this->field([
                'type'     => 'checkbox',
                'required' => true,
                'options'  => $this->localize([
                    'architecto',
                    'quis',
                    'maiores',
                ]),
            ]),
            'checkbox-optional' => $this->field([
                'type'     => 'checkbox',
                'required' => false,
                'options'  => $this->localize([
                    'dolorem',
                    'iure',
                    'animi',
                    'reprehenderit',
                ]),
            ]),
        ];
    }

    private function field(array $data): array
    {
        return [
            \array_merge([
                'label' => $this->localize('Input label'),
                'help'  => $this->localize('Helper text'),
            ], $data),
        ];
    }

    private function localize($content)
    {
        return [
            'ro' => $content,
            'en' => $content,
        ];
    }
}
