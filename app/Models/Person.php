<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\ClearsResponseCache;
use App\Traits\Filterable;
use App\Traits\HasBlocks;
use App\Traits\HasMedia;
use App\Traits\HasSlug;
use App\Traits\Sortable;
use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Person extends Model
{
    use ClearsResponseCache;
    use Filterable;
    use HasBlocks;
    use HasFactory;
    use HasMedia;
    use HasSlug;
    use SoftDeletes;
    use Sortable;
    use Translatable;

    public string $slugFieldSource = 'name';

    public $casts = [
        'social' => 'json',
    ];

    public $fillable = [
        'name', 'social',
    ];

    public array $translatable = [
        'title', 'description',
    ];

    public array $allowedSorts = [
        'name', 'title',
    ];

    public array $allowedFilters = [
        //
    ];

    public function getSocialProfiles(): array
    {
        return collect(config('website-factory.social_platforms'))
            ->mapWithKeys(fn (array $config, string $id) => [
                $id => data_get($this->social, $id),
            ])
            ->all();
    }
}
