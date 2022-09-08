<?php

declare(strict_types=1);

namespace App\Http\Resources\Collections;

class PartnerCollection extends ResourceCollection
{
    /**
     * The default table columns.
     *
     * @var array
     */
    protected array $columns = [
        'name', 'position', 'created_at',
    ];
}
