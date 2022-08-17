<?php

declare(strict_types=1);

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest as BaseRequest;
use Illuminate\Validation\Rule;

class LanguageRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'code'    => ['required', 'size:2',
                Rule::unique('languages', 'code')->ignore($this->code, 'code'),

            ],
            'name'    => ['required', 'string'],
            'enabled' => ['boolean'],
            'lines'   => ['array'],
        ];
    }
}
