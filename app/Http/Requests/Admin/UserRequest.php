<?php

declare(strict_types=1);

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest as BaseRequest;
use Illuminate\Validation\Rule;

class UserRequest extends BaseRequest
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
        return [
            'name'   => ['required', 'string', 'max:200'],
            'email'  => ['required', 'email', Rule::unique('users')->ignore($this->user)],
            'role'   => ['required', 'string'],
            'locale' => ['required', 'string', Rule::in(config('translatable.locales'))],
        ];
    }
}
