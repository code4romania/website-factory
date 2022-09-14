<?php

declare(strict_types=1);

namespace App\Traits;

use App\Exceptions\PropertyNotDefinedException;
use App\Services\SupportsTrait;
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
            throw new PropertyNotDefinedException('slugFieldSource', $this);
        }

        $this->fillable[] = 'slug';
    }

    public function getSlugFieldSource(): string
    {
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
     * @inheritdoc
     */
    public function resolveRouteBindingQuery($query, $value, $field = null)
    {
        if ($field === 'slug') {
            $field = $this->getSlugColumn();
        }

        $isAdminRoute = Str::startsWith(Route::currentRouteName(), 'admin.');

        return parent::resolveRouteBindingQuery($query, $value, $field)
            ->when(
                $isAdminRoute && SupportsTrait::publishable($this),
                fn (Builder $query) => $query->withDrafted()
            );
    }

    protected function getSlugColumn(?string $locale = null): string
    {
        $column = 'slug';

        if ($this->slugIsTranslatable()) {
            $column .= '->' . ($locale ?? app()->getLocale());
        }

        return $column;
    }

    protected function fillSlugs(): void
    {
        if (
            ! \array_key_exists('slug', $this->attributes) ||
            ! \array_key_exists($this->slugFieldSource, $this->attributes)
        ) {
            return;
        }

        if ($this->slugIsTranslatable()) {
            $slugs = $this->getTranslationsWithFallback('slug');

            locales()->each(
                fn (array $config, string $locale) => $this->withLocale($locale, function () use ($slugs) {
                    $slug = Str::slug($slugs[app()->getLocale()]);

                    if (! $slug || $this->slugAlreadyUsed($slug)) {
                        $this->slug = $this->generateSlug();
                    }
                })
            );
        } else {
            locales()->each(function () {
                $this->slug = Str::slug($this->slug);

                if (! $this->slug || ! $this->slugAlreadyUsed($this->slug)) {
                    $this->slug = $this->generateSlug();
                }
            });
        }
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

    public function getUrlAttribute(): ?string
    {
        $key = $this->getMorphClass();

        $slug = $this->slugIsTranslatable()
            ? $this->getTranslationWithoutFallback('slug', app()->getLocale())
            : $this->slug;

        if (! $slug) {
            return null;
        }

        return route('front.' . Str::plural($key) . '.show', [
            'locale' => app()->getLocale(),
            $key     => $slug,
        ]);
    }
}
