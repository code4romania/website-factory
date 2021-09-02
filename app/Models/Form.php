<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\HasBlocks;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rule;

class Form extends Model
{
    use HasBlocks;
    use HasFactory;
    use Translatable;

    public array $translatedAttributes = [
        'title',
    ];

    public function submissions(): HasMany
    {
        return $this->hasMany(FormSubmission::class);
    }

    public function sections()
    {
        return $this->blocks
            ->where('type', 'form_section')
            ->whereNull('parent_id');
    }

    public function section(Block $section): array
    {
        return [
            'title'       => $section->translatedInput('name'),
            'description' => $section->translatedInput('description'),
            'fields'      => $this->fields($section),
        ];
    }

    public function fields(Block $section)
    {
        return $section
            ->children
            ->where('type', 'form_field')
            ->where('parent_id', $section->id)
            ->map(fn (Block $field) => $this->fieldAttributes($field));
    }

    public function fieldsBySection(): Collection
    {
        return $this->sections
            ->map(fn (Block $section) => $this->section($section));
    }

    /**
     * Return the values from a single column in the fields array. Acts like array_column.
     *
     * @param  string $column
     * @return array
     */
    public function fieldColumn(string $column): array
    {
        return $this->fieldsBySection()
            ->flatMap(
                fn ($section, $sectionIndex) => $section['fields']
                    ->mapWithKeys(
                        fn ($field, $fieldIndex) => [
                            "fields.${sectionIndex}.${fieldIndex}" => $field[$column],
                        ]
                    )
            )
            ->toArray();
    }

    private function fieldAttributes(Block $field): array
    {
        $attributes = [
            'type'       => $field->input('type'),
            'label'      => $field->translatedInput('label'),
            'help'       => $field->translatedInput('help'),
            'required'   => $field->checkbox('required'),
            'validation' => [
                $field->checkbox('required') ? 'required' : 'nullable',
            ],
        ];

        return match ($attributes['type']) {
            'checkbox' => $this->fieldAttributesCheckbox($field, $attributes),
            'date'     => $this->fieldAttributesDate($field, $attributes),
            'email'    => $this->fieldAttributesEmail($field, $attributes),
            'file'     => $this->fieldAttributesFile($field, $attributes),
            'number'   => $this->fieldAttributesNumber($field, $attributes),
            'radio'    => $this->fieldAttributesRadio($field, $attributes),
            'text'     => $this->fieldAttributesText($field, $attributes),
            'textarea' => $this->fieldAttributesText($field, $attributes),
            'url'      => $this->fieldAttributesUrl($field, $attributes),
        };
    }

    private function fieldAttributesCheckbox(Block $field, array $attributes): array
    {
        $attributes['validation'][] = 'array';
        $attributes['validation'][] = Rule::in($field->translatedInput('options'));

        return $attributes;
    }

    private function fieldAttributesDate(Block $field, array $attributes): array
    {
        $attributes['min_date'] = $field->input('min_date')
            ? Carbon::parse($field->input('min_date'))->toDateString()
            : null;

        $attributes['max_date'] = $field->input('max_date')
            ? Carbon::parse($field->input('max_date'))->toDateString()
            : null;

        $attributes['focused_date'] = Carbon::today()->greaterThan($attributes['min_date'])
            ? Carbon::today()->toDateString()
            : $attributes['min_date'];

        $attributes['validation'][] = 'date';

        if ($attributes['min_date']) {
            $attributes['validation'][] = sprintf('after_or_equal:%s', $attributes['min_date']);
        }

        if ($attributes['max_date']) {
            $attributes['validation'][] = sprintf('before_or_equal:%s', $attributes['max_date']);
        }

        return $attributes;
    }

    private function fieldAttributesEmail(Block $field, array $attributes): array
    {
        $attributes['validation'][] = 'email';

        return $attributes;
    }

    private function fieldAttributesFile(Block $field, array $attributes): array
    {
        $attributes['max_size'] = (int) $field->input('max_size') ?: false;
        $attributes['input_label'] = __('form.choose');

        $attributes['validation'][] = 'file';

        if ($attributes['max_size']) {
            $attributes['validation'][] = 'max:' . $attributes['max_size'] * 1024;
        }

        return $attributes;
    }

    private function fieldAttributesNumber(Block $field, array $attributes): array
    {
        $attributes['min_value'] = intval($field->input('min_value')) ?: false;
        $attributes['max_value'] = intval($field->input('max_value')) ?: false;

        $attributes['validation'][] = 'integer';

        if ($attributes['min_value']) {
            $attributes['validation'][] = 'min:' . $attributes['min_value'];
        }

        if ($attributes['max_value']) {
            $attributes['validation'][] = 'max:' . $attributes['max_value'];
        }

        return $attributes;
    }

    private function fieldAttributesRadio(Block $field, array $attributes): array
    {
        $attributes['validation'][] = Rule::in($field->translatedInput('options'));

        return $attributes;
    }

    private function fieldAttributesText(Block $field, array $attributes): array
    {
        $attributes['min_length'] = (int) $field->input('min_length') ?: false;
        $attributes['max_length'] = (int) $field->input('max_length') ?: false;

        $attributes['validation'][] = 'string';

        if ($attributes['min_length']) {
            $attributes['validation'][] = 'min:' . $attributes['min_length'];
        }

        if ($attributes['max_length']) {
            $attributes['validation'][] = 'max:' . $attributes['max_length'];
        }

        return $attributes;
    }

    private function fieldAttributesUrl(Block $field, array $attributes): array
    {
        $attributes['validation'][] = 'url';

        return $attributes;
    }
}
