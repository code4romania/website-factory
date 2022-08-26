<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\DecisionCategoryRequest;
use App\Http\Resources\Collections\DecisionCategoryCollection;
use App\Http\Resources\DecisionCategoryResource;
use App\Models\DecisionCategory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class DecisionCategoryController extends AdminController
{
    public function index(): Response
    {
        return Inertia::render('Decisions/Categories/Index', [
            'collection' => new DecisionCategoryCollection(
                DecisionCategory::query()
                    ->withCount([
                        'decisions' => function (Builder $query) {
                            $query->withDrafted();
                        },
                    ])
                    ->sort()
                    ->filter()
                    ->paginate()
            ),
            'subnav' => $this->subnav(),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Decisions/Categories/Edit', [
            //
        ])->model(DecisionCategory::class);
    }

    public function store(DecisionCategoryRequest $request): RedirectResponse
    {
        $attributes = $request->validated();

        $decisionCategory = DecisionCategory::create($attributes);

        return redirect()->route('admin.decision_categories.edit', $decisionCategory)
            ->with('success', __('decision_category.event.created'));
    }

    public function edit(DecisionCategory $decisionCategory): Response
    {
        return Inertia::render('Decisions/Categories/Edit', [
            'resource' => DecisionCategoryResource::make($decisionCategory),
            'subnav' => $this->subnav(),
        ])->model(DecisionCategory::class);
    }

    public function update(DecisionCategoryRequest $request, DecisionCategory $decisionCategory): RedirectResponse
    {
        $attributes = $request->validated();

        $decisionCategory->update($attributes);

        return redirect()->route('admin.decision_categories.edit', $decisionCategory)
            ->with('success', __('decision_category.event.updated'));
    }

    public function duplicate(DecisionCategory $decisionCategory): RedirectResponse
    {
        $duplicate = $decisionCategory->duplicate();

        return redirect()->route('admin.decision_categories.edit', $duplicate)
            ->with('success', __('decision_category.event.duplicated'));
    }

    public function destroy(DecisionCategory $decisionCategory): RedirectResponse
    {
        $decisionCategory->delete();

        return redirect()->route('admin.decision_categories.index')
            ->with('success', __('decision_category.event.deleted'));
    }

    public function restore(DecisionCategory $decisionCategory): RedirectResponse
    {
        $decisionCategory->restore();

        return redirect()->route('admin.decision_categories.edit', $decisionCategory)
            ->with('success', __('decision_category.event.restored'));
    }

    public function forceDelete(DecisionCategory $decisionCategory): RedirectResponse
    {
        $decisionCategory->forceDelete();

        return redirect()->route('admin.decision_categories.index')
            ->with('success', __('decision_category.event.deleted'));
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
        ];
    }
}
