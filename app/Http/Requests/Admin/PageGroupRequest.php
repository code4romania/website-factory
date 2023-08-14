<?php

declare(strict_types=1);

namespace App\Http\Requests\Admin;

use App\Models\PageGroup;
use App\Services\TranslatableFormRequestRules;

class PageGroupRequest extends MenuRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return TranslatableFormRequestRules::make(PageGroup::class, [
            'title' => ['required', 'string', 'max:200'],
            ...$this->nestedRules(3),
        ]);
    }
}
