<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PersonRequest;
use App\Http\Resources\Collections\PersonCollection;
use App\Http\Resources\PersonResource;
use App\Models\Person;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class PersonController extends Controller
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
        $person = Person::create($request->validated());

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
        // dd($request->validated());
        $person->update($request->validated());

        return redirect()->route('admin.people.edit', $person)
            ->with('success', __('person.event.updated'));
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

        return redirect()->route('admin.people.index')
            ->with('success', __('person.event.restored'));
    }

    public function forceDelete(Person $person): RedirectResponse
    {
        $person->forceDelete();

        return redirect()->route('admin.people.index')
            ->with('success', __('person.event.forceDeleted'));
    }
}
