<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class Resource extends JsonResource
{
    /**
     * The "data" wrapper that should be applied.
     *
     * @var string
     */
    public static $wrap = null;

    /**
     * Whether or not to include resource permissions props.
     *
     * @var bool
     */
    public bool $withPermissions = true;

    /**
     * @var array
     */
    public array $routeMap = [];

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return array_merge(
            $this->getAttributesByRouteName($request),
            $this->getResourcePermissions(),
        );
    }

    protected function getAttributesByRouteName(Request $request): array
    {
        $routeName = optional($request->route())->getName();

        $method = Arr::last(explode('.', (string) $routeName));

        if (! method_exists($this, $method)) {
            $method = 'default';
        }

        return $this->$method($request);
    }

    protected function getResourcePermissions(): array
    {
        if (! $this->withPermissions) {
            return [];
        }

        return [
            'can' => collect(['view', 'update', 'delete', 'forceDelete', 'restore'])
                ->mapWithKeys(fn (string $ability) => [
                    $ability => auth()->user()->can($ability, $this->resource),
                ])
                ->merge($this->getCustomPermissions()),

        ];
    }

    protected function getCustomPermissions(): array
    {
        return [];
    }

    public function withoutPermissions()
    {
        $this->withPermissions = false;

        return $this;
    }

    /**
     * Fetches all translations for $attribute.
     *
     * @param  string                         $attribute
     * @return \Illuminate\Support\Collection
     */
    protected function translatable(string $attribute): Collection
    {
        return $this->translations->pluck($attribute, 'locale');
    }
}
