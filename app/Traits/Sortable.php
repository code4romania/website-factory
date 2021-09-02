<?php

declare(strict_types=1);

namespace App\Traits;

use Astrotomic\Translatable\Contracts\Translatable;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;

trait Sortable
{
    /**
     * Sort by request query string.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     * @throws \InvalidArgumentException
     */
    public function scopeSort(Builder $query): Builder
    {
        if (! \property_exists($this, 'allowedSorts') || ! \is_array($this->allowedSorts)) {
            throw new Exception('Property allowedSorts not defined on ' . \get_class($this));
        }

        $sort = Request::query('sort');

        if (! $sort || ! \is_string($sort)) {
            return $query;
        }

        $column = \ltrim($sort, '-');
        $direction = $sort[0] === '-' ? 'DESC' : 'ASC';

        if (! \in_array($column, $this->allowedSorts)) {
            return $query;
        }

        if (
            $this instanceof Translatable &&
            $this->isTranslationAttribute($column)
        ) {
            return $query->orderByTranslation($column, $direction);
        }

        if (Str::contains($column, '.')) {
            [$relationship, $attribute] = explode('.', $column);

            if (! $this->hasRelation($relationship)) {
                return $query;
            }

            $plural = Str::plural($relationship);
            $singular = Str::singular($relationship);

            return $query->join($plural, "{$plural}.id", '=', $this->getTable() . ".{$singular}_id")
                ->orderBy("{$plural}.{$attribute}", $direction)
                ->with($relationship);
        }

        return $query->orderBy($column, $direction);
    }

    protected function hasRelation(string $key): bool
    {
        if ($this->relationLoaded($key)) {
            return true;
        }

        if (\method_exists($this, $key)) {
            return is_a($this->$key(), Relation::class);
        }

        return false;
    }

    public function isSortableAttribute(string $key): bool
    {
        return \in_array($key, $this->allowedSorts);
    }
}
