<?php

declare(strict_types=1);

namespace App\Http\Requests\Admin;

use App\Enums\UserRole;
use Illuminate\Foundation\Http\FormRequest as BaseRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class UserRequest extends BaseRequest
{
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
            'role'   => ['required', 'string', new Enum(UserRole::class)],
            'locale' => ['required', 'string', Rule::in(locales()->keys())],
        ];
    }
}
