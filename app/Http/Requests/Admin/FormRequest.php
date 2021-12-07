<?php

declare(strict_types=1);

namespace App\Http\Requests\Admin;

use App\Models\Page;
use App\Services\TranslatableFormRequestRules;
use Illuminate\Foundation\Http\FormRequest as BaseRequest;

class FormRequest extends BaseRequest
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
        return TranslatableFormRequestRules::make(Page::class, [
            'title'               => ['required', 'string', 'max:200'],
            'description'         => ['required', 'string'],
            'published_at'        => ['nullable', 'date'],
            'blocks'              => ['array'],
            'blocks.*.id'         => ['required', 'numeric', 'integer'],
            'blocks.*.type'       => ['required', 'string'],
            'blocks.*.content'    => ['required', 'array'],
        ]);
    }
}
