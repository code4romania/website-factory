<?php

declare(strict_types=1);

namespace App\Traits;

use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Traits\Localizable;

trait HasSlug
{
    use Localizable;

    public string $slugSeparator = '-';

    public function getSlugFieldSource(): string
    {
        if (! \property_exists($this, 'slugFieldSource')) {
            throw new Exception('Property slugFieldSource not defined on ' . \get_class($this));
        }

        return $this->slugFieldSource;
    }

    public static function bootHasSlug(): void
    {
        static::creating(fn (Model $model) => $model->fillMissingSlugs());
        static::updating(fn (Model $model) => $model->fillMissingSlugs());
    }

    /**
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  string                                $slug
     * @param  null|string                           $locale
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeForSlug(Builder $query, string $slug, ?string $locale = null): Builder
    {
        $locale ??= app()->getLocale();

        return $query->where("slug->{$locale}", $slug);
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
            $field = 'slug->' . app()->getLocale();
        }

        return parent::resolveRouteBinding($value, $field);
    }

    protected function fillMissingSlugs()
    {
        locales()->each(function (string $locale) {
            $this->withLocale($locale, function () {
                if ($this->slug === null) {
                    $this->slug = $this->generateSlug();
                }
            });
        });
    }

    public function generateSlug(): string
    {
        $slug = Str::slug($this->{$this->getSlugFieldSource()}, $this->slugSeparator, app()->getLocale());
        $suffix = 1;

        while ($this->slugAlreadyUsed($slug)) {
            $slug .= $this->slugSeparator . $suffix++;
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

        if (\in_array('Illuminate\Database\Eloquent\SoftDeletes', \class_uses_recursive($this))) {
            $query->withTrashed();
        }

        return $query->exists();
    }
}
