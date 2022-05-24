<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;

class FormSubmissionResource extends Resource
{
    public array $routeMap = [
        'admin.form_submissions.show' => 'show',
    ];

    protected function show(Request $request): array
    {
        return [
            'form_submission' => $this->id,
            'form'            => FormResource::make($this->form),
            'created_at'      => $this->created_at->toDateTimeString(),
            'uuid'            => $this->uuid,
            'data'            => $this->data,
        ];
    }

    protected function default(Request $request): array
    {
        return [
            'form_submission' => $this->id,
            'form'            => $this->form_id,
            'created_at'      => $this->created_at->toDateTimeString(),
            'uuid'            => $this->uuid,
        ];
    }
}
