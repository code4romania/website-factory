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
        'title', 'created_at',
    ];
}
