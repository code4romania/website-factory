<?php

declare(strict_types=1);

namespace App\Models;

use App\Http\Resources\PageResource;
use App\Services\Features;
use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Setting extends Model
{
    use ClearsResponseCache;

    public $timestamps = false;

    protected $fillable = [
        'section', 'key', 'value',
    ];

    protected $casts = [
        'value' => 'json',
    ];

    protected static function defaults(): Collection
    {
        $translatable = locales()
            ->mapWithKeys(fn (array $config, string $locale) => [$locale => null]);

        $sections = [
            'site' => [
                'title' => $translatable,
                'description' => $translatable,
                'default_locale' => Language::whereEnabled()->first()?->code,
                'front_page' => null,
                'privacy_page' => null,
                'terms_page' => null,
                'logo' => null,
                'favicon' => null,
                'footer' => $translatable,
                'html' => [
                    'header' => null,
                    'footer' => null,
                ],
            ],
            'site-notice' => [
                'enabled' => false,
                'color' => null,
                'text' => $translatable,
            ],
            'social' => [
                'profiles' => collect(config('website-factory.social_platforms'))
                    ->mapWithKeys(fn (array $config, string $id) => [$id => null]),
            ],
        ];

        if (Features::hasTheme()) {
            $sections['site']['colors'] = [
                'primary' => null,
            ];
        }

        if (Features::hasDonations()) {
            $sections['donations'] = [
                'page' => [
                    'thanks' => null,
                ],
                'amounts' => [],
                'mobilpay_enabled' => false,
                'mobilpay_signature' => null,
                'mobilpay_certificate' => null,
                'mobilpay_private_key' => null,
                'euplatesc_enabled' => false,
                'euplatesc_mid' => null,
                'euplatesc_key' => null,
            ];
        }

        return collect($sections);
    }

    protected static function sectionData(string $section): array
    {
        $pages = PageResource::collection(
            Page::query()
                ->orderByTranslated('title')
                ->get(['id', 'title'])
        );

        return match ($section) {
            'site' => [
                'pages' => $pages,
            ],
            'social' => [
                'platforms' => config('website-factory.social_platforms', []),
            ],
            'donations' => [
                'pages' => $pages,
            ],
            default => []
        };
    }

    public static function sections(): Collection
    {
        return static::defaults()->keys();
    }

    public static function allowedSettings(string $section): Collection
    {
        return collect(static::defaults()->get($section));
    }

    public static function section(string $section): Collection
    {
        return static::allowedSettings($section)
            ->merge(
                static::query()
                    ->where('section', $section)
                    ->pluck('value', 'key')
            );
    }
}
