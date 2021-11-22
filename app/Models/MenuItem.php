<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class MenuItem extends Model
{
    use HasFactory;
    use Translatable;
    use NodeTrait;

    public $timestamps = false;

    public array $translatable = [
        'label', 'external_url',
    ];

    public $casts = [
        'new_tab' => 'boolean',
    ];

    protected $fillable = [
        'type', 'location', 'position', 'external_url',
    ];

    protected static function booted()
    {
        static::addGlobalScope('position', function (Builder $query) {
            $query->orderBy('position');
        });
    }

    public function scopeLocation(Builder $query, string $location): Builder
    {
        return $query->where('location', $location);
    }

    public function getUrlAttribute(): ?string
    {
        switch ($this->type) {
            case 'external':
                return $this->external_url;
                break;

            default:
                return null;
                break;
        }
    }

    public function getNewTabAttribute(): bool
    {
        return $this->type === 'external' && $this->attributes['new_tab'];
    }

    public function getComponentAttribute(): string
    {
        return "menu-item.{$this->type}";
    }
}
