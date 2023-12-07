<?php

declare(strict_types=1);

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Front\FormSubmissionRequest;
use App\Models\Form;
use App\Models\FormField;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FormController extends Controller
{
    public function show(string $locale, Form $form): View
    {
        seo()
            ->title((string) $form->title)
            ->description((string) $form->description);

        return view('front.forms.show', [
            'form' => $form,
        ]);
    }

    public function submit(string $locale, FormSubmissionRequest $request, Form $form): JsonResponse
    {
        $attributes = $request->validated();

        $formStoragePath = sprintf('forms/%s', Str::orderedUuid());

        $data = $form->blocks()
            ->onlyFields()
            ->get()
            ->map(function (FormField $field) use ($attributes, $formStoragePath) {
                $value = $attributes[$field->name] ?? null;

                if ($field->type === 'file') {
                    $value = collect($value)
                        ->map(fn (UploadedFile $file) => [
                            'url' => Storage::url($file->store($formStoragePath)),
                            'name' => $file->getClientOriginalName(),
                            'size' => $file->getSize(),
                        ])
                        ->all();
                }

                return [
                    'type' => $field->type,
                    'label' => $field->translatedInput('label'),
                    'value' => $value,
                ];
            })
            ->all();

        $form->processSubmission($data);

        return response()->json([
            'message' => __('form.event.sent'),
        ]);
    }
}
