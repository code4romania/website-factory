<?php

declare(strict_types=1);

namespace App\Http\Requests\Front;

use App\Exceptions\InvalidFormFieldTypeException;
use App\Models\Block;
use Illuminate\Foundation\Http\FormRequest as BaseRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class FormSubmissionRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return $this->form->blocks()
            ->onlyFields()
            ->get()
            ->mapWithKeys(function (Block $field) {
                $rules = [
                    $field->checkbox('required') ? 'required' : 'nullable',
                ];

                $method = Str::of("rules-{$field->type}")
                    ->slug()
                    ->camel()
                    ->value();

                if (! method_exists($this, $method)) {
                    throw new InvalidFormFieldTypeException($field->type);
                }

                return $this->$method($field, $rules);
            })
            ->all();
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes(): array
    {
        return $this->form->blocks
            ->mapWithKeys(fn (Block $field) => [
                "field-{$field->id}" => $field->translatedInput('label'),
                "field-{$field->id}.*" => $field->translatedInput('label'),
            ])
            ->all();
    }

    private function rulesDate(Block $field, array $rules): array
    {
        $min_date = $field->date('min_date')?->toDateString();
        $max_date = $field->date('max_date')?->toDateString();

        $rules[] = 'date';

        if (! \is_null($min_date)) {
            $rules[] = 'after_or_equal:' . $min_date;
        }

        if (! \is_null($max_date)) {
            $rules[] = 'before_or_equal:' . $max_date;
        }

        return [
            "field-{$field->id}" => $rules,
        ];
    }

    private function rulesEmail(Block $field, array $rules): array
    {
        $rules[] = 'email';

        return [
            "field-{$field->id}" => $rules,
        ];
    }

    private function rulesFile(Block $field, array $rules): array
    {
        $max_files = $field->checkbox('multiple')
            ? $field->input('max_files')
            : 1;

        $parentRules = array_merge($rules, ['array']);

        if ($max_files) {
            $parentRules[] = 'max:' . $max_files;
        }

        $rules[] = 'file';

        $accept = collect($field->input('accepts'));

        if ($accept->contains('other')) {
            $accept = collect();
        } else {
            $accept = $accept
                ->flatMap(fn (string $type) => config("mediable.aggregate_types.{$type}.extensions"))
                ->filter();
        }

        if ($accept->isNotEmpty()) {
            $rules[] = 'mimes:' . $accept->implode(',');
        }

        return [
            "field-{$field->id}" => $parentRules,
            "field-{$field->id}.*" => $rules,
        ];
    }

    private function rulesNumber(Block $field, array $rules): array
    {
        $min_value = $field->input('min_value');
        $max_value = $field->input('max_value');

        $rules[] = 'integer';

        if (! \is_null($min_value)) {
            $rules[] = 'min:' . $min_value;
        }

        if (! \is_null($max_value)) {
            $rules[] = 'max:' . $max_value;
        }

        return [
            "field-{$field->id}" => $rules,
        ];
    }

    private function rulesOption(Block $field, array $rules): array
    {
        $rules[] = Rule::in($field->options());

        return [
            "field-{$field->id}" => $rules,
        ];
    }

    private function rulesRadio(Block $field, array $rules): array
    {
        return $this->rulesOption($field, $rules);
    }

    private function rulesSelect(Block $field, array $rules): array
    {
        return $this->rulesOption($field, $rules);
    }

    private function rulesCheckbox(Block $field, array $rules): array
    {
        $rules[] = 'array';
        $rules[] = Rule::in($field->options());

        return [
            "field-{$field->id}" => $rules,
        ];
    }

    private function rulesText(Block $field, array $rules): array
    {
        $min_length = (int) $field->input('min_length');
        $max_length = (int) $field->input('max_length');

        $rules[] = 'string';

        if ($min_length) {
            $rules[] = 'min:' . $min_length;
        }

        if ($max_length) {
            $rules[] = 'max:' . $max_length;
        }

        return [
            "field-{$field->id}" => $rules,
        ];
    }

    private function rulesTextarea(Block $field, array $rules): array
    {
        return $this->rulesText($field, $rules);
    }

    private function rulesUrl(Block $field, array $rules): array
    {
        $rules[] = 'url';

        return [
            "field-{$field->id}" => $rules,
        ];
    }
}
