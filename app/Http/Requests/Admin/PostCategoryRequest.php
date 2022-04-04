<?php

declare(strict_types=1);

namespace App\Http\Requests\Admin;

use App\Models\Post;
use App\Services\TranslatableFormRequestRules;
use Illuminate\Foundation\Http\FormRequest as BaseRequest;

class PostCategoryRequest extends BaseRequest
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
        return TranslatableFormRequestRules::make(Post::class, [
            'title'               => ['required', 'string', 'max:200'],
            'slug'                => ['required', 'string', 'max:200'],
            'description'         => ['nullable', 'string'],
        ]);
    }
}
