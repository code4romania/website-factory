<?php

declare(strict_types=1);

namespace App\Http\Requests\Admin;

use App\Models\Page;
use App\Rules\OneEmailPerLine;
use App\Services\TranslatableFormRequestRules;
use Illuminate\Foundation\Http\FormRequest as BaseRequest;
use Illuminate\Validation\Rule;

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
            'title'             => ['required', 'string', 'max:200'],
            'description'       => ['nullable', 'string'],
            'published_at'      => ['nullable', 'date'],
            'store_submissions' => ['nullable', 'boolean'],
            'send_submissions'  => ['nullable', 'boolean'],
            'recipients'        => [Rule::requiredIf($this->send_submissions), new OneEmailPerLine],
            'blocks'            => ['array'],
            'blocks.*.id'       => ['required', 'numeric', 'integer'],
            'blocks.*.type'     => ['required', 'string'],
            'blocks.*.content'  => ['required', 'array'],
        ]);
    }
}
