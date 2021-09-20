<?php

declare(strict_types=1);

namespace App\Http\Resources\Collections;

use App\Traits\Filterable;
use App\Traits\Publishable;
use App\Traits\Sortable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection as BaseCollection;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

abstract class ResourceCollection extends BaseCollection
{
    /**
     * The collection's corresponding model.
     *
     * @var string
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

        return \array_merge([
            'model'        => $morphClass,
            'route_prefix' => 'admin.' . Str::plural($morphClass),
            'columns'      => $this->tableColumns($request),
            'statuses'     => $this->statuses(),
            'filters'      => $this->filters($request),
            'sort'         => $this->sort($request),
            'data'         => $this->collection,
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
                'field'    => \str_replace('.', '___', $column),
                'label'    => __("field.{$column}"),
                'sortable' => $this->isColumnSortable($column),
            ]);
    }

    protected function resolveModel(): Model
    {
        $model = Str::replace('Collection', '', \class_basename($this));

        return app('App\\Models\\' . $model);
    }

    protected function resolveResourceName(): string
    {
        $resource = Str::replace('Collection', 'Resource', \class_basename($this));

        return 'App\\Http\\Resources\\' . $resource;
    }

    protected function getColumnsByRouteName(Request $request): Collection
    {
        $routeName = $request->route()->getName();

        $property = \array_key_exists($routeName, $this->routeMap)
            ? $this->routeMap[$routeName]
            : 'columns';

        if (
            ! \property_exists($this, $property) ||
            ! \is_array($this->$property)
        ) {
            throw new \Exception("Property `$property` not defined on " . get_class($this));
        }

        return collect([
            'bulk',
            ...$this->$property,
            'actions',
        ]);
    }

    protected function isColumnSortable(string $column): bool
    {
        if (! \in_array(Sortable::class, \class_uses_recursive($this->model))) {
            return false;
        }

        return $this->model->isSortableAttribute($column);
    }

    protected function filters(): array
    {
        if (! \in_array(Filterable::class, \class_uses_recursive($this->model))) {
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
            $column = \ltrim($column, '-');
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
        $traits = \class_uses_recursive($this->model);

        $statuses = collect();

        $statuses->push([
            'name' => 'all',
            'count' => $this->model->newQuery()->count(),
        ]);

        if (\in_array(Publishable::class, $traits)) {
            $statuses->push([
                'name' => 'published',
                'count' => $this->model->newQuery()->published()->count(),
            ]);
            $statuses->push([
                'name' => 'draft',
                'count' => $this->model->newQuery()->onlyDraft()->count(),
            ]);
        }

        if (\in_array(SoftDeletes::class, $traits)) {
            $statuses->push([
                'name' => 'trashed',
                'count' => $this->model->newQuery()->onlyTrashed()->count(),
            ]);
        }

        return $statuses->all();
    }

    protected function routePrefix(): string
    {
        return 'admin.' . Str::plural($this->model->getMorphClass());
    }
}
