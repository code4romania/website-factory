<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MenuRequest;
use App\Http\Resources\Collections\MenuItemCollection;
use App\Models\MenuItem;
use App\Models\Page;
use App\Models\Post;
use App\Models\PostCategory;
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
            'models' => [
                'page'          => Page::all(['id', 'title', 'slug']),
                'post'          => Post::all(['id', 'title', 'slug']),
                'post_category' => PostCategory::all(['id', 'title', 'slug']),
            ],
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

                if (MenuItem::allowedModels()->contains($item['type'])) {
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
