<?php

declare(strict_types=1);

namespace App\Http\Requests\Admin;

use Astrotomic\Translatable\Validation\RuleFactory;
use Illuminate\Foundation\Http\FormRequest as BaseRequest;

class PageRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return RuleFactory::make([
            // '%title%' => ['required', 'string'],
            'blocks'           => ['sometimes', 'array'],
            'blocks.*.id'      => ['required', 'numeric', 'integer'],
            'blocks.*.type'    => ['required', 'string'],
            'blocks.*.content' => ['required', 'array'],
        ]);
    }
}
