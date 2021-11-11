<?php

declare(strict_types=1);

namespace App\Http\Requests\Admin;

use App\Models\MenuItem;
use App\Services\TranslatableFormRequestRules;
use Illuminate\Foundation\Http\FormRequest as BaseRequest;

class MenuRequest extends BaseRequest
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
        return TranslatableFormRequestRules::make(MenuItem::class, [
            'items'                               => ['array'],
            'items.*.label'                       => ['required', 'string'],
            'items.*.type'                        => ['required', 'string'],
            'items.*.children.*.label'            => ['required', 'string', 'sometimes'],
            'items.*.children.*.type'             => ['required', 'string', 'sometimes'],
            'items.*.children.*.children.*.label' => ['required', 'string', 'sometimes'],
            'items.*.children.*.children.*.type'  => ['required', 'string', 'sometimes'],
        ]);
    }
}
