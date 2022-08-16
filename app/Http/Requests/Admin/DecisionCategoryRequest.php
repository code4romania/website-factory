<?php

declare(strict_types=1);

namespace App\Http\Requests\Admin;

use App\Models\Decision;
use App\Services\TranslatableFormRequestRules;
use Illuminate\Foundation\Http\FormRequest as BaseRequest;

class DecisionCategoryRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return TranslatableFormRequestRules::make(Decision::class, [
            'title'               => ['required', 'string', 'max:200'],
            'slug'                => ['required', 'string', 'max:200'],
            'description'         => ['nullable', 'string'],
        ]);
    }
}
