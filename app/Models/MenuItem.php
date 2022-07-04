<?php

declare(strict_types=1);

namespace App\Models;

use App\Services\Features;
use App\Traits\ClearsResponseCache;
use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Kalnoy\Nestedset\NodeTrait;

class MenuItem extends Model
{
    use ClearsResponseCache;
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
        'id', 'type', 'location', 'position', 'model_type', 'model_id', 'route',
    ];

    /**
     * Models that can be added as menu items.
     *
     * @return \Illuminate\Support\Collection
     */
    public static function allowedModels(): Collection
    {
        return collect([
            'page', 'post', 'post_category',
        ]);
    }

    /**
     * Allowed menu item types.
     *
     * @return array
     */
    public static function allowedTypes(): array
    {
        return [
            'text',
            'external',
            'page',
            'post',
            'post_category',
            'route',
        ];
    }

    /**
     * Routes that can be added as menu items.
     *
     * @return \Illuminate\Support\Collection
     */
    public static function allowedRoutes(): Collection
    {
        $routes = [
            'posts.index',
        ];

        if (Features::hasDecisions()) {
            $routes[] = 'decisions.index';
        }

        return collect($routes);
    }

    protected static function booted()
    {
        static::addGlobalScope('position', function (Builder $query) {
            $query->orderBy('position');
        });

        // Dissociate model if changing to other menu item type
        static::saving(function (self $item) {
            if (
                ! \is_null($item->model_type) &&
                $item->type !== 'model'
            ) {
                $item->model()->dissociate();
            }
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
        if ($this->type === 'route' && Route::is("front.$this->route")) {
            return true;
        }

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
        $this->attributes['type'] = self::allowedModels()->contains($type) ? 'model' : $type;
    }

    public function getNormalizedTypeAttribute(): string
    {
        return $this->type === 'model'
            ? $this->model_type
            : $this->type;
    }
}
