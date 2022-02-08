<?php

declare(strict_types=1);

namespace App\Traits;

use App\Services\SupportsTrait;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Illuminate\Support\Traits\Localizable;

trait HasSlug
{
    use Localizable;

    public function initializeHasSlug(): void
    {
        if (! property_exists($this, 'slugFieldSource')) {
            throw new Exception('Property slugFieldSource not defined on ' . \get_class($this));
        }

        $this->fillable[] = 'slug';
    }

    public function getSlugFieldSource(): string
    {
        if (
            SupportsTrait::translatable($this) &&
            \in_array($this->slugFieldSource, $this->translatable)
        ) {
            return $this->translate($this->slugFieldSource);
        }

        return $this->{$this->slugFieldSource};
    }

    public static function bootHasSlug(): void
    {
        static::creating(fn (Model $model) => $model->fillSlugs());
        static::updating(fn (Model $model) => $model->fillSlugs());
    }

    /**
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  string                                $slug
     * @param  null|string                           $locale
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeForSlug(Builder $query, string $slug, ?string $locale = null): Builder
    {
        return $query->where($this->getSlugColumn($locale), $slug);
    }

    /**
     * Retrieve the model for a bound value.
     *
     * @param  mixed                                    $value
     * @param  string|null                              $field
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function resolveRouteBinding($value, $field = null)
    {
        if ($field === 'slug') {
            $field = $this->getSlugColumn();
        }

        $isAdminRoute = Str::startsWith(Route::currentRouteName(), 'admin.');

        return $this
            ->when($isAdminRoute && SupportsTrait::publishable($this), fn (Builder $query) => $query->withDrafted())
            ->where($field ?? $this->getRouteKeyName(), $value)
            ->first();
    }

    protected function getSlugColumn(?string $locale = null): string
    {
        $column = 'slug';

        if ($this->slugIsTranslatable()) {
            $column .= '->' . ($locale ?? app()->getLocale());
        }

        return $column;
    }

    protected function fillSlugs()
    {
        locales()->each(function (string $locale) {
            $this->withLocale($locale, function () {
                if (! $this->slug || $this->slugAlreadyUsed($this->slug)) {
                    $this->slug = $this->generateSlug();
                }
            });
        });
    }

    public function generateSlug(): string
    {
        $base = $slug = Str::slug($this->getSlugFieldSource());
        $suffix = 1;

        while ($this->slugAlreadyUsed($slug)) {
            $slug = Str::slug($base . '_' . $suffix++);
        }

        return $slug;
    }

    protected function slugAlreadyUsed(string $slug): bool
    {
        $query = static::forSlug($slug)
            ->withoutGlobalScopes();

        if ($this->exists) {
            $query->where($this->getKeyName(), '!=', $this->getKey());
        }

        if (SupportsTrait::softDeletes($this)) {
            $query->withTrashed();
        }

        return $query->exists();
    }

    protected function slugIsTranslatable(): bool
    {
        return SupportsTrait::translatable($this) && \in_array('slug', $this->translatable);
    }

    public function getUrlAttribute(): string
    {
        $key = $this->getMorphClass();

        return route('front.' . Str::plural($key) . '.show', [
            'locale' => app()->getLocale(),
            $key     => $this->slugIsTranslatable()
                ? $this->getTranslationWithoutFallback('slug', app()->getLocale())
                : $this->slug,
        ]);
    }
}
