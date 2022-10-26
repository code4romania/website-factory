<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\DecisionAuthorRequest;
use App\Http\Resources\Collections\DecisionAuthorCollection;
use App\Http\Resources\DecisionAuthorResource;
use App\Models\DecisionAuthor;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class DecisionAuthorController extends AdminController
{
    public function index(): Response
    {
        return Inertia::render('Decisions/Authors/Index', [
            'collection' => new DecisionAuthorCollection(
                DecisionAuthor::query()
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
        return Inertia::render('Decisions/Authors/Edit', [
            //
        ])->model(DecisionAuthor::class);
    }

    public function store(DecisionAuthorRequest $request): RedirectResponse
    {
        $attributes = $request->validated();

        $decisionAuthor = DecisionAuthor::create($attributes);

        return redirect()->route('admin.decision_authors.edit', $decisionAuthor)
            ->with('success', __('decision_author.event.created'));
    }

    public function edit(DecisionAuthor $decisionAuthor): Response
    {
        return Inertia::render('Decisions/Authors/Edit', [
            'resource' => DecisionAuthorResource::make($decisionAuthor),
            'subnav' => $this->subnav(),
        ])->model(DecisionAuthor::class);
    }

    public function update(DecisionAuthorRequest $request, DecisionAuthor $decisionAuthor): RedirectResponse
    {
        $attributes = $request->validated();

        $decisionAuthor->update($attributes);

        return redirect()->route('admin.decision_authors.edit', $decisionAuthor)
            ->with('success', __('decision_author.event.updated'));
    }

    public function duplicate(DecisionAuthor $decisionAuthor): RedirectResponse
    {
        $duplicate = $decisionAuthor->duplicate();

        return redirect()->route('admin.decision_authors.edit', $duplicate)
            ->with('success', __('decision_author.event.duplicated'));
    }

    public function destroy(DecisionAuthor $decisionAuthor): RedirectResponse
    {
        $decisionAuthor->delete();

        return redirect()->route('admin.decision_authors.index')
            ->with('success', __('decision_author.event.deleted'));
    }

    public function restore(DecisionAuthor $decisionAuthor): RedirectResponse
    {
        $decisionAuthor->restore();

        return redirect()->route('admin.decision_authors.edit', $decisionAuthor)
            ->with('success', __('decision_author.event.restored'));
    }

    public function forceDelete(DecisionAuthor $decisionAuthor): RedirectResponse
    {
        $decisionAuthor->forceDelete();

        return redirect()->route('admin.decision_authors.index')
            ->with('success', __('decision_author.event.deleted'));
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
