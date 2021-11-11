<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MenuRequest;
use App\Http\Resources\Collections\MenuItemCollection;
use App\Models\MenuItem;
use Illuminate\Http\RedirectResponse;
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
            ),
        ])->model(MenuItem::class);
    }

    public function update(MenuRequest $request, string $location): RedirectResponse
    {
        $attributes = $request->validated();

        MenuItem::query()->location($location)->delete();

        MenuItem::rebuildTree($this->prepareItems($attributes['items'], $location));

        return redirect()->route('admin.menus.edit', ['location' => $location])
            ->with('success', __('menu.event.updated'));
    }

    protected function prepareItems(array $items, string $location, int $depth = 0): array
    {
        if ($depth === 3) {
            return [];
        }

        return collect($items)
            ->map(fn (array $item, int $index) => [
                'location'     => $location,
                'position'     => $index + 1,
                'label'        => $item['label'],
                'type'         => $item['type'],
                'external_url' => $item['external_url'],
                'children'     => $this->prepareItems($item['children'] ?? [], $location, ++$depth),
            ])
            ->all();
    }
}
