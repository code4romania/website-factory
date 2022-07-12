<?php

declare(strict_types=1);

namespace App\Http\Resources\Collections;

use App\Exceptions\PropertyNotDefinedException;
use App\Services\SupportsTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection as BaseCollection;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

abstract class ResourceCollection extends BaseCollection
{
    /**
     * The collection's corresponding model.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected Model $model;

    /**
     * The table columns.
     *
     * @var array
     */
    protected array $columns = [];

    /**
     * @var array
     */
    protected array $routeMap = [];

    /**
     * @var array
     */
    protected array $appends = [];

    /**
     * Create a new resource instance.
     *
     * @param  mixed $resource
     * @return void
     */
    public function __construct($resource)
    {
        $this->model = $this->resolveModel();
        $this->collects = $this->resolveResourceName();

        parent::__construct($resource);
    }

    public function append(string $key, $value): self
    {
        $this->appends[$key] = $value;

        return $this;
    }

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request): array
    {
        $morphClass = $this->model->getMorphClass();

        return array_merge([
            'columns'    => $this->tableColumns($request),
            'statuses'   => $this->statuses(),
            'filters'    => $this->filters($request),
            'sort'       => $this->sort($request),
            'data'       => $this->collection,
            'properties' => [
                'model'              => $morphClass,
                'main_action_route'  => $this->mainActionRoute ?? 'admin.' . Str::plural($morphClass) . '.edit',
                'admin_route_prefix' => 'admin.' . Str::plural($morphClass),
                'front_route_prefix' => 'front.' . Str::plural($morphClass),
            ],
        ], $this->appends);
    }

    /**
     * Build the table column properties required by the frontend.
     *
     * @param  \Illuminate\Http\Request       $request
     * @return \Illuminate\Support\Collection
     */
    protected function tableColumns(Request $request): Collection
    {
        return $this->getColumnsByRouteName($request)
            ->map(fn (string $column) => [
                'field'    => Str::replace('.', '___', $column),
                'label'    => __("field.{$column}"),
                'sortable' => $this->isColumnSortable($column),
            ]);
    }

    protected function resolveModel(): Model
    {
        $model = Str::replace('Collection', '', class_basename($this));

        return app('App\\Models\\' . $model);
    }

    protected function resolveResourceName(): string
    {
        $resource = Str::replace('Collection', 'Resource', class_basename($this));

        return 'App\\Http\\Resources\\' . $resource;
    }

    protected function getColumnsByRouteName(Request $request): Collection
    {
        $routeName = $request->route()->getName();

        $property = \array_key_exists($routeName, $this->routeMap)
            ? $this->routeMap[$routeName]
            : 'columns';

        if (
            ! property_exists($this, $property) ||
            ! \is_array($this->$property)
        ) {
            throw new PropertyNotDefinedException($property, $this);
        }

        return collect($this->$property);
    }

    protected function isColumnSortable(string $column): bool
    {
        if (! SupportsTrait::sortable($this->model)) {
            return false;
        }

        return $this->model->isSortableAttribute($column);
    }

    protected function filters(): array
    {
        if (! SupportsTrait::filterable($this->model)) {
            return [];
        }

        return $this->model->filters()->all();
    }

    protected function sort(Request $request): ?array
    {
        $column = $request->query('sort');
        $direction = 'asc';

        if (! \is_string($column)) {
            return [
                'column'    => null,
                'direction' => null,
            ];
        }

        if (Str::startsWith($column, '-')) {
            $column = ltrim($column, '-');
            $direction = 'desc';
        }

        if (! $this->isColumnSortable($column)) {
            return [
                'column'    => null,
                'direction' => null,
            ];
        }

        return [
            'column'    => $column,
            'direction' => $direction,
        ];
    }

    protected function statuses(): array
    {
        $statuses = collect();

        if (SupportsTrait::publishable($this->model)) {
            $statuses->push([
                'name'  => 'all',
                'count' => $this->model
                    ->newQuery()
                    ->withDrafted()
                    ->count(),
            ]);

            $statuses->push([
                'name'  => 'published',
                'count' => $this->model
                    ->newQuery()
                    ->count(),
            ]);

            $statuses->push([
                'name'  => 'draft',
                'count' => $this->model
                    ->newQuery()
                    ->onlyDrafted()
                    ->count(),
            ]);
        } else {
            $statuses->push([
                'name'  => 'all',
                'count' => $this->model
                    ->newQuery()
                    ->count(),
            ]);
        }

        if (SupportsTrait::softDeletes($this->model)) {
            $statuses->push([
                'name'  => 'trashed',
                'count' => $this->model
                    ->newQuery()
                    ->onlyTrashed()
                    ->when(
                        SupportsTrait::publishable($this->model),
                        fn (Builder $query) => $query->withDrafted()
                    )
                    ->count(),
            ]);
        }

        return $statuses->all();
    }
}
