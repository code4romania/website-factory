<?php

declare(strict_types=1);

namespace App\Http\Resources\Collections;

class FormSubmissionCollection extends ResourceCollection
{
    /**
     * The default table columns.
     *
     * @var array
     */
    protected array $columns = [
        'id', 'created_at',
    ];

    protected string $mainActionRoute = 'admin.form_submissions.show';
}
