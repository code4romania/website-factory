<?php

declare(strict_types=1);

namespace App\Http\Requests\Front;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SearchRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'query' => ['required', 'string', 'min:3'],
            'type' => ['string', Rule::in(
                collect(config('search.models'))
                    ->map(fn (string $model) => app($model)->getMorphClass())
            )],
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->mergeIfMissing([
            'type' => 'page',
        ]);
    }
}
