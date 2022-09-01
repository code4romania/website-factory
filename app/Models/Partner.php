<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\ClearsResponseCache;
use App\Traits\Duplicatable;
use App\Traits\Filterable;
use App\Traits\HasMedia;
use App\Traits\Sortable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Partner extends Model
{
    use ClearsResponseCache;
    use Duplicatable;
    use Filterable;
    use HasFactory;
    use HasMedia;
    use SoftDeletes;
    use Sortable;

    protected $fillable = [
        'name', 'url', 'position',
    ];

    protected $casts = [
        'position' => 'integer',
    ];

    public array $allowedSorts = [
        'name', 'position',
    ];

    public array $allowedFilters = [
        //
    ];

    public function getLogoAttribute(): ?string
    {
        return $this->firstMedia('image')
            ?->findVariant('thumb')
            ?->getUrl();
    }
}
