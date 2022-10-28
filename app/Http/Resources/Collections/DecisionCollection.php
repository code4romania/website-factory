<?php

declare(strict_types=1);

namespace App\Http\Resources\Collections;

class DecisionCollection extends ResourceCollection
{
    /**
     * The default table columns.
     *
     * @var array
     */
    protected array $columns = [
        'title', 'number', 'date', 'created_at', 'published_at',
    ];
}
