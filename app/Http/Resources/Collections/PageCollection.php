<?php

declare(strict_types=1);

namespace App\Http\Resources\Collections;

use App\Models\Page;

class PageCollection extends ResourceCollection
{
    /**
     * The name of the collection's corresponding model.
     *
     * @var string
     */
    protected string $model = Page::class;

    /**
     * The default table columns.
     *
     * @var array
     */
    protected array $columns = [
        'title',
    ];
}
