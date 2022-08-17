<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public string $model;

    public string $resource;

    public function __construct()
    {
        $model = Str::replace('Controller', '', class_basename($this));

        $this->model = 'App\\Models\\' . $model;

        $this->resource = 'App\\Http\\Resources\\' . $model . 'Resource';

        $this->authorizeResource($this->model);
    }

    /**
     * Get the map of resource methods to ability names.
     *
     * @return array
     */
    protected function resourceAbilityMap(): array
    {
        return [
            'index'       => 'viewAny',
            'show'        => 'view',
            'create'      => 'create',
            'store'       => 'create',
            'duplicate'   => 'create',
            'edit'        => 'update',
            'update'      => 'update',
            'destroy'     => 'delete',
            'restore'     => 'restore',
            'forceDelete' => 'forceDelete',
        ];
    }

    public function collection(): JsonResource
    {
        return $this->resource::collection(
            $this->model::all()
        );
    }
}
