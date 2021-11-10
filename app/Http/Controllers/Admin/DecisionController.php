<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\DecisionRequest;
use App\Http\Resources\Collections\DecisionCollection;
use App\Http\Resources\DecisionResource;
use App\Models\Decision;
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
                    ->sort()
                    ->filter()
                    ->paginate()
            ),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Decisions/Edit', [
            //
        ])->model(Decision::class);
    }

    public function store(DecisionRequest $request): RedirectResponse
    {
        $attributes = $request->validated();

        $decision = Decision::create($attributes);

        $decision->saveBlocks($attributes['blocks']);

        return redirect()->route('admin.decisions.edit', $decision)
            ->with('success', __('decision.event.created'));
    }

    public function edit(Decision $decision): Response
    {
        return Inertia::render('Decisions/Edit', [
            'resource' => DecisionResource::make($decision),
        ])->model(Decision::class);
    }

    public function update(DecisionRequest $request, Decision $decision): RedirectResponse
    {
        $attributes = $request->validated();

        $decision->update($attributes);

        $decision->saveBlocks($attributes['blocks']);

        return redirect()->route('admin.decisions.edit', $decision)
            ->with('success', __('decision.event.updated'));
    }
}
