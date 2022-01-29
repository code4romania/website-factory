<?php

declare(strict_types=1);

namespace App\Http\Requests\Admin;

use App\Models\Setting;
use App\Rules\ValidHex;
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
        return auth()->user()->isAdmin() && Setting::sections()->contains($this->section);
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

        return match ($this->section) {
            'default' => [],
            'site' => [
                'settings.title'          => ['array'],
                'settings.description'    => ['array'],
                'settings.logo'           => ['nullable', 'image'],
                'settings.front_page'     => ['required', 'exists:pages,id'],
                'settings.colors'         => ['array'],
                'settings.colors.primary' => ['required', new ValidHex],
                'settings.social'         => ['required', "array:$platforms"],
            ],
            'donations' => [
                'settings.mobilpay_enabled'     => ['boolean'],
                'settings.mobilpay_signature'   => ['nullable', 'regex:/^([A-Z0-9]{4}-?){5}$/'],
                'settings.mobilpay_public_key'  => ['nullable', 'file'],
                'settings.mobilpay_private_key' => ['nullable', 'file'],

                'settings.euplatesc_enabled' => ['boolean'],
                'settings.euplatesc_mid'     => ['nullable', 'string'],
                'settings.euplatesc_key'     => ['nullable', 'string'],
            ],
        };
    }
}
