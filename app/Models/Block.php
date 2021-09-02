<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\HasChildren;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Arr;

class Block extends Model
{
    use HasChildren;
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'blockable_type',
        'blockable_id',
        'type',
        'position',
        'content',
    ];

    protected $casts = [
        'content' => 'json',
    ];

    public function blockable(): MorphTo
    {
        return $this->morphTo();
    }

    public function input(string $field): mixed
    {
        return $this->content[$field] ?? null;
    }

    public function translatedInput(string $field, ?string $locale = null): mixed
    {
        $input = Arr::wrap($this->input($field));

        $locale ??= ! \array_key_exists(app()->getLocale(), $input ?? [])
            ? config('app.fallback_locale')
            : app()->getLocale();

        return $input[$locale] ?? null;
    }

    public function checkbox(string $field): bool
    {
        return (bool) $this->input($field);
    }
}
