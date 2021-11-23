<?php

declare(strict_types=1);

namespace App\Traits;

use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Illuminate\Support\Traits\Localizable;

trait HasSlug
{
    use Localizable;

    public string $slugSeparator = '-';

    public function initializeHasSlug(): void
    {
        if (! \property_exists($this, 'slugFieldSource')) {
            throw new Exception('Property slugFieldSource not defined on ' . \get_class($this));
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
     * @param  mixed                                    $value
     * @param  string|null                              $field
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function resolveRouteBinding($value, $field = null)
    {
        if ($field === 'slug') {
            $field = $this->getSlugColumn();
        }

        return parent::resolveRouteBinding($value, $field);
    }

    protected function getSlugColumn(?string $locale = null): string
    {
        if (
            \in_array(Translatable::class, \class_uses_recursive($this)) &&
            \in_array('slug', $this->translatable)
        ) {
            $locale ??= app()->getLocale();

            return "slug->{$locale}";
        }

        return 'slug';
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

        if (\in_array(SoftDeletes::class, \class_uses_recursive($this))) {
            $query->withTrashed();
        }

        return $query->exists();
    }

    public function getUrlAttribute(): string
    {
        $key = $this->getMorphClass();

        return route('front.' . Str::plural($key) . '.show', [
            'locale' => app()->getLocale(),
            $key     => $this->slug,
        ]);
    }
}
