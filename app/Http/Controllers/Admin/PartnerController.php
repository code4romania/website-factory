<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\PartnerRequest;
use App\Http\Resources\Collections\PartnerCollection;
use App\Http\Resources\PartnerResource;
use App\Models\Partner;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class PartnerController extends AdminController
{
    public function index(): Response
    {
        return Inertia::render('Partners/Index', [
            'collection' => new PartnerCollection(
                Partner::query()
                    ->sort(
                        defaultColumn: 'position',
                        defaultDirection: 'asc'
                    )
                    ->filter()
                    ->paginate()
            ),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Partners/Edit', [
            //
        ])->model(Partner::class);
    }

    public function store(PartnerRequest $request): RedirectResponse
    {
        $attributes = $request->validated();

        $partner = Partner::create($attributes);

        $partner->saveMedia($attributes['media']);

        return redirect()->route('admin.partners.edit', $partner)
            ->with('success', __('partner.event.created'));
    }

    public function edit(Partner $partner): Response
    {
        return Inertia::render('Partners/Edit', [
            'resource' => PartnerResource::make($partner),
        ])->model(Partner::class);
    }

    public function update(PartnerRequest $request, Partner $partner): RedirectResponse
    {
        $attributes = $request->validated();

        $partner->update($attributes);

        $partner->saveMedia($attributes['media']);

        return redirect()->route('admin.partners.edit', $partner)
            ->with('success', __('partner.event.updated'));
    }

    public function duplicate(Partner $partner): RedirectResponse
    {
        $duplicate = $partner->duplicate();

        return redirect()->route('admin.partners.edit', $duplicate)
            ->with('success', __('partner.event.duplicated'));
    }

    public function destroy(Partner $partner): RedirectResponse
    {
        $partner->delete();

        return redirect()->route('admin.partners.index')
            ->with('success', __('partner.event.deleted'));
    }

    public function restore(Partner $partner): RedirectResponse
    {
        $partner->restore();

        return redirect()->route('admin.partners.edit', $partner)
            ->with('success', __('partner.event.restored'));
    }

    public function forceDelete(Partner $partner): RedirectResponse
    {
        $partner->forceDelete();

        return redirect()->route('admin.partners.index')
            ->with('success', __('partner.event.deleted'));
    }
}
