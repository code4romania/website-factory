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
        return TranslatableFormRequestRules::make(MenuItem::class, $this->nestedRules(
            $this->location === 'header' ? 2 : 1
        ));
    }

    protected function nestedRules(int $depth): array
    {
        $template = [
            '%prefix%'                => ['array'],
            '%prefix%.*.label'        => ['required', 'string'],
            '%prefix%.*.type'         => ['required', 'string'],
            '%prefix%.*.external_url' => ['required_if:%prefix%.*.type,external', 'nullable', 'url'],
            '%prefix%.*.new_tab'      => ['required_if:%prefix%.*.type,external', 'boolean'],
            '%prefix%.*.model'        => ['required_unless:%prefix%.*.type,external'],
        ];

        $rules = collect();

        for ($level = 0; $level <= $depth; $level++) {
            $prefix = 'items' . \str_repeat('.*.children', $level);

            foreach ($template as $key => $value) {
                $rules->put(
                    Str::replace('%prefix%', $prefix, $key),
                    collect($value)
                        ->map(fn ($rule) => Str::replace('%prefix%', $prefix, $rule))
                        ->all()
                );
            }
        }

        return $rules->all();
    }
}
