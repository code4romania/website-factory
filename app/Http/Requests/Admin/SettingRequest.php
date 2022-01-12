<?php

declare(strict_types=1);

namespace App\Http\Requests\Admin;

use App\Rules\ValidRGB;
use Illuminate\Foundation\Http\FormRequest as BaseRequest;

class SettingRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return auth()->user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return match ($this->section) {
            'site' => $this->sectionSiteRules(),
            default => [],
        };
    }

    protected function sectionSiteRules(): array
    {
        return [
            'settings.site_title'       => ['array'],
            'settings.site_description' => ['array'],
            'settings.logo'             => ['nullable', 'image'],
            'settings.colors'           => ['array'],
            'settings.colors.primary'   => ['required', new ValidRGB],
        ];
    }
}
