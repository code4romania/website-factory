<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Kalnoy\Nestedset\NodeTrait;

class MenuItem extends Model
{
    use HasFactory;
    use Translatable;
    use NodeTrait;

    public $timestamps = false;

    public array $translatable = [
        'label', 'url',
    ];

    public $casts = [
        'new_tab' => 'boolean',
    ];

    protected $fillable = [
        'id', 'type', 'location', 'position', 'model_type', 'model_id',
    ];

    /**
     * Models that can be added as menu items.
     *
     * @var array
     */
    public array $allowedModels = [
        'page', 'post', 'post_category',
    ];

    protected static function booted()
    {
        static::addGlobalScope('position', function (Builder $query) {
            $query->orderBy('position');
        });
    }

    public function model(): MorphTo
    {
        return $this->morphTo();
    }

    public function scopeLocation(Builder $query, string $location): Builder
    {
        return $query->where('location', $location)
            ->with('model:id,title,slug');
    }

    public function getComponentAttribute(): string
    {
        return "menu-item.{$this->type}";
    }

    public function isCurrentUrl(): bool
    {
        if (! $this->model) {
            return false;
        }

        if (Route::currentRouteName() === 'front.pages.index') {
            return false;
        }

        return Str::startsWith(url()->current(), $this->model->url);
    }

    public function setTypeAttribute(string $type): void
    {
        $this->attributes['type'] = \in_array($type, $this->allowedModels) ? 'model' : $type;
    }

    public function getNormalizedTypeAttribute(): string
    {
        return $this->type === 'model'
            ? $this->model_type
            : $this->type;
    }
}
