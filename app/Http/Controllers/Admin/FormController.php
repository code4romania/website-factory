<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\FormRequest;
use App\Http\Resources\Collections\FormCollection;
use App\Http\Resources\FormResource;
use App\Models\Form;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class FormController extends AdminController
{
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
        return Inertia::render('Forms/Edit', [
            //
        ])->model(Form::class);
    }

    public function store(FormRequest $request): RedirectResponse
    {
        $attributes = $request->validated();

        $form = Form::create($attributes);

        $form->saveBlocks($attributes['blocks']);

        return redirect()->route('admin.forms.edit', $form)
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
            'resource' => FormResource::make($form),
        ])->model(Form::class);
    }

    public function update(FormRequest $request, Form $form): RedirectResponse
    {
        $attributes = $request->validated();

        // dd($attributes);

        $form->update($attributes);

        $form->saveBlocks($attributes['blocks']);

        return redirect()->route('admin.forms.edit', $form)
            ->with('success', __('form.event.updated'));
    }
}
