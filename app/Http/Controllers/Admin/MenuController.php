<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MenuRequest;
use App\Http\Resources\Collections\MenuItemCollection;
use App\Models\MenuItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;
use Inertia\Response;

class MenuController extends Controller
{
    public function index(): RedirectResponse
    {
        return redirect()->route('admin.menus.edit', 'header');
    }

    public function edit(string $location): Response
    {
        return Inertia::render('Menus/Edit', [
            'location'   => $location,
            'collection' => new MenuItemCollection(
                MenuItem::query()
                    ->location($location)
                    ->get()
                    ->toTree()
            ),
            'types' => MenuItem::allowedTypes(),
            'routes' => MenuItem::allowedRoutes(),
            'models' => MenuItem::allowedModels()
                ->map(fn (string $model) => $model::all(['id', 'title', 'slug'])),
        ])->model(MenuItem::class);
    }

    public function update(MenuRequest $request, string $location): RedirectResponse
    {
        $attributes = $request->validated();

        MenuItem::location($location)
            ->rebuildTree(
                $this->prepareItems($attributes['items'], $location),
                true
            );

        Cache::forget("menu-$location");

        return redirect()->route('admin.menus.edit', ['location' => $location])
            ->with('success', __('menu.event.updated'));
    }

    protected function prepareItems(array $items, string $location, int $depth = 0): array
    {
        if ($depth === 3) {
            return [];
        }

        return collect($items)
            ->map(function (array $item, int $index) use ($location, $depth) {
                $prepared = [
                    'location'     => $location,
                    'position'     => $index + 1,
                    'label'        => $item['label'],
                    'type'         => $item['type'],
                    'url'          => $item['type'] === 'external' ? $item['url'] : null,
                    'route'        => $item['type'] === 'route' ? $item['route'] : null,
                    'children'     => $this->prepareItems($item['children'] ?? [], $location, ++$depth),
                ];

                if (MenuItem::allowedModels()->has($item['type'])) {
                    $prepared['model_type'] = $item['type'];
                    $prepared['model_id'] = $item['model'];
                }

                if (\array_key_exists('id', $item) && ! \is_null($item['id'])) {
                    $prepared['id'] = $item['id'];
                }

                return $prepared;
            })
            ->all();
    }
}
