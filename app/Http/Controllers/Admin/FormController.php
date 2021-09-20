<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Collections\FormCollection;
use App\Models\Form;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class FormController extends Controller
{
    public function __construct()
    {
        // $this->authorizeResource(Form::class);
    }

    public function index(): Response
    {
        return Inertia::render('Forms/Index', [
            'collection' => new FormCollection(
                Form::query()
                    ->sort()
                    ->filter()
                    ->paginate()
            ),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Forms/Create', [
            //
        ]);
    }

    public function store(FormRequest $request): RedirectResponse
    {
        $form = Form::create($request->validated());

        return redirect()->route('admin.forms.show', $form)
            ->with('success', __('form.event.created'));
    }

    public function show(Form $form): Response
    {
        return Inertia::render('Forms/Show', [
            //
        ]);
    }

    public function edit(Form $form): Response
    {
        return Inertia::render('Forms/Edit', [
            //
        ]);
    }

    public function update(FormRequest $request, Form $form): RedirectResponse
    {
        $form->fill($request->validated());

        $form->save();

        return redirect()->route('admin.forms.show', $form)
            ->with('success', __('form.event.updated'));
    }

    public function destroy(Form $form): RedirectResponse
    {
        $form->delete();

        return redirect()->route('admin.forms.show', $form)
            ->with('success', __('form.event.deleted'));
    }
}
