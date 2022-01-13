<?php

declare(strict_types=1);

namespace App\Models;

use App\Services\Features;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Setting extends Model
{
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
            ->mapWithKeys(fn (string $locale) => [$locale => null]);

        $sections = collect();

        $sections->put('site', [
            'title'       => $translatable,
            'description' => $translatable,
            'logo'        => null,
            'colors'      => [
                'primary' => null,
            ],
        ]);

        if (Features::hasDonations()) {
            $sections->put('donations', [
                'mobilpay_enabled'     => false,
                'mobilpay_signature'   => null,
                'mobilpay_public_key'  => null,
                'mobilpay_private_key' => null,
            ]);
        }

        return $sections;
    }

    public static function set(string $key, mixed $value, ?string $section = null): void
    {
        static::updateOrCreate(
            [
                'key'     => $key,
                'section' => $section,
            ],
            [
                'value' => $value,
            ]
        );
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

    public function getTranslatedValueAttribute()
    {
        return array_filter(
            $this->value,
            fn ($value) => $value !== null && $value !== '',
            ARRAY_FILTER_USE_BOTH
        );
    }
}
