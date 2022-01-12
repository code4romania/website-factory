<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Setting extends Model
{
    use HasMedia;

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
            'site_title'       => $translatable,
            'site_description' => $translatable,
            'logo'             => null,
            'colors'           => [
                'primary' => null,
            ],
        ]);

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
                    ->withMedia()
                    ->where('section', $section)
                    ->get()
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
