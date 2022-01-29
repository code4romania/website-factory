<?php

declare(strict_types=1);

namespace App\Http\Requests\Admin;

use App\Models\Person;
use App\Services\TranslatableFormRequestRules;
use Illuminate\Foundation\Http\FormRequest as BaseRequest;

class PersonRequest extends BaseRequest
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
        $platforms = collect(config('website-factory.social_platforms'))
            ->keys()
            ->implode(',');

        return TranslatableFormRequestRules::make(Person::class, [
            'name'                => ['required', 'string', 'max:200'],
            'slug'                => ['required', 'string', 'max:200', "unique_translation:people,slug,{$this->person?->id}"],
            'title'               => ['required', 'string', 'max:200'],
            'social'              => ['required', "array:$platforms"],
            'description'         => ['required', 'string'],
            'media'               => ['array'],
            'media.*.id'          => ['required', 'exists:media'],
            'blocks'              => ['array'],
            'blocks.*.id'         => ['required', 'numeric', 'integer'],
            'blocks.*.type'       => ['required', 'string'],
            'blocks.*.content'    => ['required', 'array'],
            'blocks.*.children'   => ['array'],
            'blocks.*.media'      => ['array'],
            'blocks.*.media.*.id' => ['required', 'exists:media'],
        ]);
    }
}
