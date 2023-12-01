<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\ClearsResponseCache;
use App\Traits\Duplicatable;
use App\Traits\Filterable;
use App\Traits\Sortable;
use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class PageGroup extends Model
{
    use ClearsResponseCache;
    use Duplicatable;
    use Filterable;
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

    public function items(): BelongsToMany
    {
        return $this->belongsToMany(PageGroupItem::class)
            ->using(PageGroupItem::class);
    }
}
