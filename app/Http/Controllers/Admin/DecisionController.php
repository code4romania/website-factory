<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\DecisionRequest;
use App\Http\Resources\Collections\DecisionCollection;
use App\Http\Resources\DecisionResource;
use App\Models\Decision;
use App\Models\DecisionAuthor;
use App\Models\DecisionCategory;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class DecisionController extends AdminController
{
    public function index(): Response
    {
        return Inertia::render('Decisions/Index', [
            'collection' => new DecisionCollection(
                Decision::query()
                    ->with('categories')
                    ->sort()
                    ->filter()
                    ->paginate()
            ),
            'subnav' => $this->subnav(),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Decisions/Edit', [
            'categories' => DecisionCategory::all(['id', 'title']),
            'authors' => DecisionAuthor::all(['id', 'title']),
            'subnav' => $this->subnav(),
        ])->model(Decision::class);
    }

    public function store(DecisionRequest $request): RedirectResponse
    {
        $attributes = $request->validated();

        $decision = Decision::create($attributes);

        $decision->categories()->sync($attributes['categories']);
        $decision->authors()->sync($attributes['authors']);

        $decision->saveBlocks($attributes['blocks'])
            ->saveMedia($attributes['media']);

        return redirect()->route('admin.decisions.edit', $decision)
            ->with('success', __('decision.event.created'));
    }

    public function edit(Decision $decision): Response
    {
        return Inertia::render('Decisions/Edit', [
            'resource' => DecisionResource::make($decision),
            'categories' => DecisionCategory::all(['id', 'title']),
            'authors' => DecisionAuthor::all(['id', 'title']),
            'subnav' => $this->subnav(),
        ])->model(Decision::class);
    }

    public function update(DecisionRequest $request, Decision $decision): RedirectResponse
    {
        $attributes = $request->validated();

        $decision->update($attributes);

        $decision->categories()->sync($attributes['categories']);
        $decision->authors()->sync($attributes['authors']);

        $decision->saveBlocks($attributes['blocks'])
            ->saveMedia($attributes['media']);

        return redirect()->route('admin.decisions.edit', $decision)
            ->with('success', __('decision.event.updated'));
    }

    public function duplicate(Decision $decision): RedirectResponse
    {
        $duplicate = $decision->duplicate();

        return redirect()->route('admin.decisions.edit', $duplicate)
            ->with('success', __('decision.event.duplicated'));
    }

    public function destroy(Decision $decision): RedirectResponse
    {
        $decision->delete();

        return redirect()->route('admin.decisions.index')
            ->with('success', __('decision.event.deleted'));
    }

    public function restore(Decision $decision): RedirectResponse
    {
        $decision->restore();

        return redirect()->route('admin.decisions.edit', $decision)
            ->with('success', __('decision.event.restored'));
    }

    public function forceDelete(Decision $decision): RedirectResponse
    {
        $decision->forceDelete();

        return redirect()->route('admin.decisions.index')
            ->with('success', __('decision.event.deleted'));
    }

    protected function subnav(): array
    {
        return [
            [
                'label' => 'decision.subnav.decisions',
                'route' => 'admin.decisions.index',
            ],
            [
                'label' => 'decision.subnav.categories',
                'route' => 'admin.decision_categories.index',
            ],
            [
                'label' => 'decision.subnav.authors',
                'route' => 'admin.decision_authors.index',
            ],
        ];
    }
}
