<?php

declare(strict_types=1);

namespace App\Http\Requests\Admin;

use App\Models\MenuItem;
use App\Services\TranslatableFormRequestRules;
use Illuminate\Foundation\Http\FormRequest as BaseRequest;
use Illuminate\Support\Str;

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
        return TranslatableFormRequestRules::make(MenuItem::class, $this->nestedRules(2));
    }

    protected function nestedRules(int $depth): array
    {
        $template = [
            '%prefix%'                => ['array'],
            '%prefix%.*.label'        => ['required', 'string'],
            '%prefix%.*.type'         => ['required', 'string'],
            '%prefix%.*.external_url' => ['nullable', 'url'],
        ];

        $rules = collect();

        for ($level = 0; $level <= $depth; $level++) {
            $prefix = 'items' . \str_repeat('.*.children', $level);

            foreach ($template as $key => $value) {
                $rules->put(Str::replace('%prefix%', $prefix, $key), $value);
            }
        }

        return $rules->all();
    }
}
