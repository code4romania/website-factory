<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;

class FormResource extends Resource
{
    public array $routeMap = [
        'admin.forms.index' => 'index',
        'admin.forms.show' => 'show',
        'admin.forms.edit' => 'edit',
    ];

    protected function index(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'created_at' => $this->created_at->toDateTimeString(),
            'trashed' => $this->trashed(),
            'store_submissions' => $this->store_submissions,
            'send_submissions' => $this->send_submissions,
            'submissions_count' => $this->submissions_count,
        ];
    }

    protected function show(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'slug' => $this->slug,
            'created_at' => $this->created_at->toDateTimeString(),
            // 'published_at'      => $this->published_at?->toDateTimeString(),
            'store_submissions' => $this->store_submissions,
            'send_submissions' => $this->send_submissions,
            'recipients' => $this->recipients,
            'blocks' => BlockResource::collection($this->blocks),
            'submissions' => FormSubmissionResource::collection($this->submissions),
        ];
    }

    protected function edit(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->getTranslations('title'),
            'description' => $this->getTranslations('description'),
            'slug' => $this->getTranslations('slug'),
            'created_at' => $this->created_at->toDateTimeString(),
            // 'published_at'      => $this->published_at?->toDateTimeString(),
            'store_submissions' => $this->store_submissions,
            'send_submissions' => $this->send_submissions,
            'recipients' => $this->recipients,
            'blocks' => BlockResource::collection($this->blocks),
        ];
    }

    protected function default(Request $request): array
    {
        $this->withoutPermissions();

        return [
            'id' => $this->id,
            'type' => $this->getMorphClass(),
            'title' => $this->title,
        ];
    }
}
