<?php

declare(strict_types=1);

namespace App\Http\Requests\Admin;

use App\Models\Page;
use App\Services\TranslatableFormRequestRules;
use Illuminate\Foundation\Http\FormRequest as BaseRequest;

class PageRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return TranslatableFormRequestRules::make(Page::class, [
            'title' => ['required', 'string', 'max:200'],
            'slug' => ['nullable', 'string', 'max:200'],
            'description' => ['nullable', 'string'],
            'published_at' => ['nullable', 'date'],
            'parent' => ['nullable', 'exists:pages,id'],
            'media' => ['array'],
            'media.*.id' => ['required', 'exists:media'],
            'blocks' => ['array'],
            'blocks.*.id' => ['required', 'numeric', 'integer'],
            'blocks.*.type' => ['required', 'string'],
            'blocks.*.content' => ['required', 'array'],
            'blocks.*.media' => ['array'],
            'blocks.*.media.*.id' => ['required', 'exists:media'],
            'blocks.*.related' => ['array'],
            'blocks.*.related.*.id' => ['required', 'numeric', 'integer'],
            'blocks.*.related.*.type' => ['required', 'string'],
            'blocks.*.children' => ['array'],
            'blocks.*.children.*.id' => ['required', 'numeric', 'integer'],
            'blocks.*.children.*.type' => ['required', 'string'],
            'blocks.*.children.*.content' => ['required', 'array'],
            'blocks.*.children.*.media' => ['array'],
            'blocks.*.children.*.media.*.id' => ['required', 'exists:media'],
            'blocks.*.children.*.related' => ['array'],
            'blocks.*.children.*.related.*.id' => ['required', 'numeric', 'integer'],
            'blocks.*.children.*.related.*.type' => ['required', 'string'],
        ]);
    }
}
