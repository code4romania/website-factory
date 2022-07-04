<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\SupportsTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
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
    }

    public function destroy(int $id): RedirectResponse
    {
        $this->model::query()
            ->when(
                SupportsTrait::publishable($this->model),
                fn (Builder $query) => $query->withDrafted()
            )
            ->find($id)
            ->delete();

        return $this->success('index', 'deleted');
    }

    public function restore(int $id): RedirectResponse
    {
        $model = $this->model::onlyTrashed()
            ->find($id);

        $model->restore();

        return $this->success('edit', 'restored', $model);
    }

    public function forceDelete(int $id): RedirectResponse
    {
        $this->model::onlyTrashed()
            ->find($id)
            ->forceDelete();

        return $this->success('index', 'forceDeleted');
    }

    public function duplicate(int $id): RedirectResponse
    {
        /** @var Model */
        $source = $this->model::find($id);

        /** @var Model */
        $duplicate = $source->replicate();

        $duplicate->push();

        if (SupportsTrait::blocks($this->model)) {
            $duplicate->saveBlocks($source->blocks->toArray());
        }

        if (SupportsTrait::media($this->model)) {
            $duplicate->saveMedia($source->media->toArray());
        }

        return $this->success('edit', 'duplicated', $duplicate);
    }

    public function collection(): JsonResource
    {
        return $this->resource::collection(
            $this->model::all()
        );
    }

    protected function success(string $route, string $event, ?Model $model = null): RedirectResponse
    {
        $singular = Str::snake(class_basename($this->model));
        $plural = Str::plural($singular);

        return redirect()
            ->route("admin.$plural.$route", $model)
            ->with('success', __("$singular.event.$event"));
    }
}
