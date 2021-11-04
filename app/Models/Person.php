<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\Filterable;
use App\Traits\HasMedia;
use App\Traits\HasSlug;
use App\Traits\Publishable;
use App\Traits\Sortable;
use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Person extends Model
{
    use Filterable;
    use HasFactory;
    use HasMedia;
    use HasSlug;
    use Publishable;
    use SoftDeletes;
    use Sortable;
    use Translatable;

    public string $slugFieldSource = 'name';

    public array $translatable = [
        'title', 'description',
    ];

    public array $allowedSorts = [
        'name', 'title',
    ];

    public array $allowedFilters = [
        //
    ];
}
