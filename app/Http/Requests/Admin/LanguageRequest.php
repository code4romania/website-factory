<?php

declare(strict_types=1);

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest as BaseRequest;

class LanguageRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return auth()->user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'code'    => ['required', 'size:2'],
            'name'    => ['required', 'string'],
            'enabled' => ['boolean'],
            'lines'   => ['array'],
        ];
    }
}
