<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\ClearsResponseCache;
use App\Traits\HasMedia;
use App\Traits\HasRelated;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Block extends Model
{
    use ClearsResponseCache;
    use HasFactory;
    use HasMedia;
    use HasRelated;

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
        'children', 'related',
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
        return "blocks.{$this->type}";
    }

    public function input(string $field)
    {
        return $this->content[$field] ?? null;
    }

    public function translatedInput(string $field, ?string $locale = null)
    {
        return localized_input($this->input($field), $locale);
    }

    public function checkbox(string $field): bool
    {
        return (bool) $this->input($field);
    }

    public function date(string $field): ?Carbon
    {
        $input = $this->input($field);

        if (\is_null($input)) {
            return null;
        }

        return Carbon::parse($input);
    }
}
