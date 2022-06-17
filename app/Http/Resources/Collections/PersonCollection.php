<?php

declare(strict_types=1);

namespace App\Http\Resources\Collections;

class PersonCollection extends ResourceCollection
{
    /**
     * The default table columns.
     *
     * @var array
     */
    protected array $columns = [
        'name', 'created_at',
    ];
}
