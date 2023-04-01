<?php

declare(strict_types=1);

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PartnerRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:200'],
            'url' => ['nullable', 'string', 'url', 'max:200'],
            'position' => ['nullable', 'integer'],
            'media' => ['array'],
            'media.*.id' => ['required', 'exists:media'],
        ];
    }
}
