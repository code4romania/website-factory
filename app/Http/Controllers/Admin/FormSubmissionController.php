<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Resources\FormSubmissionResource;
use App\Models\Form;
use App\Models\FormSubmission;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class FormSubmissionController extends AdminController
{
    public function show(Form $form, FormSubmission $formSubmission): Response
    {
        return Inertia::render('Forms/Submission', [
            'resource' => FormSubmissionResource::make($formSubmission),
        ])->model(FormSubmission::class);
    }

    public function destroy(FormSubmission $formSubmission): RedirectResponse
    {
        $formSubmission->delete();

        return redirect()->route('admin.forms.show', $formSubmission->form)
            ->with('success', __('form_submission.event.deleted'));
    }
}
