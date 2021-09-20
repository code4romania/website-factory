<?php

declare(strict_types=1);

namespace App\Traits;

use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;

trait Filterable
{
    public function initializeFilterable(): void
    {
        if (! \property_exists($this, 'allowedFilters') || ! \is_array($this->allowedFilters)) {
            throw new Exception('Property allowedFilters not defined on ' . \get_class($this));
        }

        $this->allowedFilters[] = 'status';
    }

    public function scopeFilter(Builder $query): Builder
    {
        $filters = Request::query('filter', []);

        if (\is_string($filters)) {
            $filters = \json_decode($filters, true);
        }

        collect($filters)
            ->filter(fn ($value, $key) => $this->isFilterableAttribute($key))
            ->each(function ($value, $key) use ($query) {
                $filter = Str::camel("filter_by_{$key}");

                if (! \method_exists($this, $filter)) {
                    throw new Exception("Method $filter not defined on " . \get_class($this), 1);
                }

                $this->$filter($query, $this->sanitizeFilter($value));
            });

        return $query;
    }

    public function filters(): Collection
    {
        $filters = Request::query('filter');

        if (\is_string($filters)) {
            return collect();
        }

        return collect($filters)
            ->map(fn ($value) => $this->sanitizeFilter($value));
    }

    protected function sanitizeFilter($value)
    {
        if (\is_array($value)) {
            return collect($value)
                ->map(fn ($v) => $this->sanitizeFilter($v))
                ->all();
        }

        if (Str::contains($value, ',')) {
            return \explode(',', $value);
        }

        if ($value === 'true') {
            return true;
        }

        if ($value === 'false') {
            return false;
        }

        return $value;
    }

    public function isFilterableAttribute(string $key): bool
    {
        return \in_array($key, $this->allowedFilters);
    }

    final public function filterByStatus(Builder $query, string $status): Builder
    {
        $traits = \class_uses_recursive($query->getModel());

        if (\in_array(Publishable::class, $traits)) {
            if ($status === 'published') {
                return $query->published();
            }

            if ($status === 'draft') {
                return $query->onlyDraft();
            }
        }

        if (
            \in_array(SoftDeletes::class, $traits) &&
            $status === 'trashed'
        ) {
            return $query->onlyTrashed();
        }

        return $query;
    }
}
