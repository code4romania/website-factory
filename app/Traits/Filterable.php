<?php

declare(strict_types=1);

namespace App\Traits;

use App\Services\SupportsTrait;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;

trait Filterable
{
    public function initializeFilterable(): void
    {
        if (! property_exists($this, 'allowedFilters') || ! \is_array($this->allowedFilters)) {
            throw new Exception('Property allowedFilters not defined on ' . \get_class($this));
        }

        $this->allowedFilters[] = 'status';
    }

    public function scopeFilter(Builder $query): Builder
    {
        $filters = Request::query('filter', []);

        if (\is_string($filters)) {
            $filters = json_decode($filters, true);
        }

        collect($filters)
            ->filter(fn ($value, $key) => $this->isFilterableAttribute($key))
            ->each(function ($value, $key) use ($query) {
                $filter = Str::camel("filter_by_{$key}");

                if (! method_exists($this, $filter)) {
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
            return explode(',', $value);
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
        if (SupportsTrait::publishable($query->getModel())) {
            if ($status === 'published') {
                return $query->onlyPublished();
            }

            if ($status === 'draft') {
                return $query->onlyDrafted();
            }
        }

        if (
            SupportsTrait::softDeletes($query->getModel()) &&
            $status === 'trashed'
        ) {
            return $query
                ->when(
                    SupportsTrait::publishable($query->getModel()),
                    fn (Builder $query) => $query->withDrafted()
                )
                ->onlyTrashed();
        }

        return $query;
    }
}
