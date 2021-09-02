<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\Filterable;
use App\Traits\HasBlocks;
use App\Traits\Sortable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model implements TranslatableContract
{
    use Filterable;
    use HasBlocks;
    use HasFactory;
    use Sortable;
    use Translatable;

    public array $translatedAttributes = [
        'title',
        'slug',
    ];

    public array $allowedSorts = [
        'title',
    ];

    public array $allowedFilters = [
        //
    ];
}
