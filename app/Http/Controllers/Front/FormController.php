<?php

declare(strict_types=1);

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Front\FormSubmissionRequest;
use App\Models\Block;
use App\Models\Form;
use Artesaos\SEOTools\Traits\SEOTools;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class FormController extends Controller
{
    use SEOTools;

    public function show(string $locale, Form $form): View
    {
        $this->seo()
            ->setTitle($form->title)
            ->setDescription($form->description);

        return view('front.forms.show', [
            'form' => $form,
        ]);
    }

    public function submit(string $locale, FormSubmissionRequest $request, Form $form): RedirectResponse
    {
        $attributes = $request->validated();

        $data = $form->blocks
            ->map(fn (Block $field) => [
                'label' => $field->translatedInput('label'),
                'value' => $attributes["field-{$field->id}"] ?? '&mdash;',
            ])
            ->all();

        $form->storeSubmission($data);
        // $form->sendSubmission($data);

        return redirect()->route('front.forms.show', ['form' => $form])
            ->with('success', __('form.event.sent'));
    }
}
