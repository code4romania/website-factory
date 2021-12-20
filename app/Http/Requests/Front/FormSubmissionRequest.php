<?php

declare(strict_types=1);

namespace App\Http\Requests\Front;

use App\Exceptions\InvalidFormFieldType;
use App\Models\Block;
use Illuminate\Foundation\Http\FormRequest as BaseRequest;
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
        return $this->form->blocks
            ->mapWithKeys(function (Block $field) {
                $rules = [
                    $field->checkbox('required') ? 'required' : 'nullable',
                ];

                return [
                    "field-{$field->id}" => match ($field->type) {
                        'checkbox' => $this->rulesOptions($field, $rules),
                        'date'     => $this->rulesDate($field, $rules),
                        'email'    => $this->rulesEmail($field, $rules),
                        'file'     => $this->rulesFile($field, $rules),
                        'number'   => $this->rulesNumber($field, $rules),
                        'radio'    => $this->rulesOption($field, $rules),
                        'select'   => $this->rulesOptions($field, $rules),
                        'text'     => $this->rulesText($field, $rules),
                        'textarea' => $this->rulesText($field, $rules),
                        'url'      => $this->rulesUrl($field, $rules),
                        default    => throw new InvalidFormFieldType($field->type),
                    },
                ];
            })
            // ->dd()
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

        return $rules;
    }

    private function rulesEmail(Block $field, array $rules): array
    {
        $rules[] = 'email';

        return $rules;
    }

    private function rulesFile(Block $field, array $rules): array
    {
        $max_size = $field->input('max_size');

        $rules[] = 'file';

        if (! \is_null($max_size)) {
            $rules[] = 'max:' . ($max_size * 1024);
        }

        return $rules;
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

        return $rules;
    }

    private function rulesOption(Block $field, array $rules): array
    {
        $rules[] = Rule::in($field->translatedOptions());

        return $rules;
    }

    private function rulesOptions(Block $field, array $rules): array
    {
        $rules[] = 'array';
        $rules[] = Rule::in($field->translatedOptions());

        return $rules;
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

        return $rules;
    }

    private function rulesUrl(Block $field, array $rules): array
    {
        $rules[] = 'url';

        return $rules;
    }
}
