<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\ClearsResponseCache;
use App\Traits\Sortable;
use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class PageGroupItem extends Pivot
{
    use ClearsResponseCache;
    use HasFactory;
    use Sortable;
    use Translatable;

    public array $translatable = [
        'title',
    ];

    public array $allowedSorts = [
        'title',
    ];

    public array $allowedFilters = [
        //
    ];

    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }
}
