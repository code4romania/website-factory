<?php

declare(strict_types=1);

namespace App\Traits;

use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;

trait Filterable
{
    public function scopeFilter(Builder $query): Builder
    {
        if (! \property_exists($this, 'allowedFilters') || ! \is_array($this->allowedFilters)) {
            throw new Exception('Property allowedFilters not defined on ' . \get_class($this));
        }

        $filters = Request::query('filter', []);

        if (\is_string($filters)) {
            $filters = \json_decode($filters, true);
        }

        collect($filters)
            ->filter(fn ($value, $key) => \in_array($key, $this->allowedFilters))
            ->each(function ($value, $key) use ($query) {
                $value = $this->getFilterValue($value);

                $filter = Str::camel("filter_by_{$key}");

                if (! \method_exists($this, $filter)) {
                    throw new Exception("Method $filter not defined on " . \get_class($this), 1);
                }

                $this->$filter($query, $value);
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
            ->map(fn ($value) => $this->getFilterValue($value));
    }

    protected function getFilterValue(mixed $value): mixed
    {
        if (\is_array($value)) {
            return collect($value)
                ->map(fn ($v) => $this->getFilterValue($v))
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
}
