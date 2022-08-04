<?php

declare(strict_types=1);

namespace App\Http\Requests\Admin;

use App\Models\Decision;
use App\Services\TranslatableFormRequestRules;
use Illuminate\Foundation\Http\FormRequest as BaseRequest;

class DecisionCategoryRequest extends BaseRequest
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
        return TranslatableFormRequestRules::make(Decision::class, [
            'title'               => ['required', 'string', 'max:200'],
            'slug'                => ['nullable', 'string', 'max:200'],
            'description'         => ['nullable', 'string'],
        ]);
    }
}
