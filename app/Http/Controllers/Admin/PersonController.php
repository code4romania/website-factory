<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\PersonRequest;
use App\Http\Resources\Collections\PersonCollection;
use App\Http\Resources\PersonResource;
use App\Models\Person;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class PersonController extends AdminController
{
    public function index(): Response
    {
        return Inertia::render('People/Index', [
            'collection' => new PersonCollection(
                Person::query()
                    ->sort()
                    ->filter()
                    ->paginate()
            ),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('People/Edit', [
            'platforms' => config('website-factory.social_platforms', []),
        ])->model(Person::class);
    }

    public function store(PersonRequest $request): RedirectResponse
    {
        $attributes = $request->validated();

        $person = Person::create($attributes);

        $person->saveBlocks($attributes['blocks'])
            ->saveMedia($attributes['media']);

        return redirect()->route('admin.people.edit', $person)
            ->with('success', __('person.event.created'));
    }

    public function edit(Person $person): Response
    {
        return Inertia::render('People/Edit', [
            'resource'  => PersonResource::make($person),
            'platforms' => config('website-factory.social_platforms', []),
        ])->model(Person::class);
    }

    public function update(PersonRequest $request, Person $person): RedirectResponse
    {
        $attributes = $request->validated();
        $person->update($attributes);

        $person->saveBlocks($attributes['blocks'])
            ->saveMedia($attributes['media']);

        return redirect()->route('admin.people.edit', $person)
            ->with('success', __('person.event.updated'));
    }

    public function duplicate(Person $person): RedirectResponse
    {
        $duplicate = $person->duplicate();

        return redirect()->route('admin.people.edit', $duplicate)
            ->with('success', __('person.event.duplicated'));
    }

    public function destroy(Person $person): RedirectResponse
    {
        $person->delete();

        return redirect()->route('admin.people.index')
            ->with('success', __('person.event.deleted'));
    }

    public function restore(Person $person): RedirectResponse
    {
        $person->restore();

        return redirect()->route('admin.people.edit', $person)
            ->with('success', __('person.event.restored'));
    }

    public function forceDelete(Person $person): RedirectResponse
    {
        $person->forceDelete();

        return redirect()->route('admin.people.index')
            ->with('success', __('person.event.forceDeleted'));
    }
}
