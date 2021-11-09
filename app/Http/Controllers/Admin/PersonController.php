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
            //
        ])->model(Person::class);
    }

    public function store(PersonRequest $request): RedirectResponse
    {
        $attributes = $request->validated();

        $person = Person::create($attributes);

        $person->saveBlocks($attributes['blocks'])
            ->saveImages($attributes['media']);

        return redirect()->route('admin.people.edit', $person)
            ->with('success', __('person.event.created'));
    }

    public function edit(Person $person): Response
    {
        return Inertia::render('People/Edit', [
            'person' => PersonResource::make($person),
        ])->model(Person::class);
    }

    public function update(PersonRequest $request, Person $person): RedirectResponse
    {
        $attributes = $request->validated();
        $person->update($attributes);

        $person->saveBlocks($attributes['blocks'])
            ->saveImages($attributes['media']);

        return redirect()->route('admin.people.edit', $person)
            ->with('success', __('person.event.updated'));
    }
}
