<?php

declare(strict_types=1);

namespace App\Http\Requests\Admin;

use App\Models\Setting;
use App\Rules\ValidHex;
use App\Services\Features;
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
        return Setting::sections()->contains($this->section);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        if ($this->section === 'site') {
            $rules = [
                'settings.title' => ['array'],
                'settings.description' => ['array'],
                'settings.logo' => ['nullable', 'image', 'mimes:jpg,png,gif,svg'],
                'settings.favicon' => ['nullable', 'image', 'mimes:jpg,png,gif', 'dimensions:min_width=32,max_width=1000'],
                'settings.default_locale' => ['required', 'exists:languages,code'],
                'settings.front_page' => ['required', 'exists:pages,id'],
                'settings.privacy_page' => ['required', 'exists:pages,id'],
                'settings.terms_page' => ['required', 'exists:pages,id'],
                'settings.html' => ['array'],
                'settings.html.header' => ['nullable', 'string'],
                'settings.html.footer' => ['nullable', 'string'],
            ];

            if (Features::hasTheme()) {
                $rules['settings.colors'] = ['array'];
                $rules['settings.colors.primary'] = ['required', new ValidHex];
            }

            return $rules;
        }

        if ($this->section === 'site-notice') {
            return [
                'settings.enabled' => ['required', 'boolean'],
                'settings.color' => ['required', new ValidHex],
                'settings.text' => ['array'],
            ];
        }

        if ($this->section === 'social') {
            $platforms = collect(config('website-factory.social_platforms'))
                ->keys()
                ->implode(',');

            return [
                'settings.profiles' => ['required', "array:$platforms"],
                'settings.profiles.*' => ['nullable', 'url'],
            ];
        }

        if ($this->section === 'donations') {
            return [
                'settings.page.thanks' => ['required', 'exists:pages,id'],
                'settings.amounts' => ['array'],
                'settings.amounts.*.amount' => ['required', 'integer'],

                'settings.mobilpay_enabled' => ['boolean'],
                'settings.mobilpay_signature' => ['nullable', 'regex:/^([A-Z0-9]{4}-?){5}$/'],
                'settings.mobilpay_certificate' => ['nullable', 'file'],
                'settings.mobilpay_private_key' => ['nullable', 'file'],

                'settings.euplatesc_enabled' => ['boolean'],
                'settings.euplatesc_mid' => ['nullable', 'string'],
                'settings.euplatesc_key' => ['nullable', 'string'],
            ];
        }

        return [];
    }
}
