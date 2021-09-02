<?php

declare(strict_types=1);

namespace App\Http\Resources\Collections;

use App\Traits\Sortable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection as BaseCollection;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use ReflectionClass;

abstract class ResourceCollection extends BaseCollection
{
    /**
     * The name of the collection's corresponding model.
     *
     * @var string
     */
    protected string $model;

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
        return \array_merge([
            'route'   => Str::replace('.index', '.edit', $request->route()->getName()),
            'columns' => $this->tableColumns($request),
            'sort'    => $this->sort($request),
            'data'    => $this->collection,
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
                'field'        => \str_replace('.', '___', $column),
                'label'        => __("field.{$column}"),
                'sortable'     => $this->isColumnSortable($column),
            ]);
    }

    /**
     * Get the resource name for the given model name.
     *
     * @return string
     */
    protected function resolveResourceName(): string
    {
        $model = (new ReflectionClass($this->model))->getShortName();

        return 'App\\Http\\Resources\\' . $model . 'Resource';
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
        $model = app($this->model);

        if (! \in_array(Sortable::class, class_uses_recursive($model))) {
            return false;
        }

        return $model->isSortableAttribute($column);
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

        if (! app($this->model)->isSortableAttribute($column)) {
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
}
