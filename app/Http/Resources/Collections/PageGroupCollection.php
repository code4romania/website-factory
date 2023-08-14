<?php

declare(strict_types=1);

namespace App\Http\Resources\Collections;

class PageGroupCollection extends ResourceCollection
{
    /**
     * The default table columns.
     *
     * @var array
     */
    protected array $columns = [
        'title', 'pages_count',
    ];
}
