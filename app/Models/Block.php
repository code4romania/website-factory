<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\HasMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Arr;

class Block extends Model
{
    use HasFactory;
    use HasMedia;

    public $timestamps = false;

    protected $fillable = [
        'blockable_type',
        'blockable_id',
        'type',
        'position',
        'content',
        'parent_id',
    ];

    protected $casts = [
        'content' => 'json',
    ];

    protected $with = [
        'children',
    ];

    public function blockable(): MorphTo
    {
        return $this->morphTo();
    }

    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id')
            ->orderBy('position');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class);
    }

    public function getComponentAttribute(): string
    {
        return match ($this->blockable_type) {
            'form' => "blocks.form.{$this->type}",
            default => "blocks.{$this->type}",
        };
    }

    public function input(string $field)
    {
        return $this->content[$field] ?? null;
    }

    public function translatedInput(string $field, ?string $locale = null)
    {
        $input = Arr::wrap($this->input($field));

        $locale ??= app()->getLocale();

        if (! \array_key_exists($locale, $input) || $input[$locale] === '') {
            $locale = config('app.fallback_locale');
        }

        return $input[$locale] ?? null;
    }

    public function checkbox(string $field): bool
    {
        return (bool) $this->input($field);
    }
}
