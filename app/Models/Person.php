<?php

declare(strict_types=1);

namespace App\Models;

use App\DataTransferObjects\SearchResult;
use App\Traits\ClearsResponseCache;
use App\Traits\Duplicatable;
use App\Traits\Filterable;
use App\Traits\HasBlocks;
use App\Traits\HasMedia;
use App\Traits\HasSlug;
use App\Traits\Searchable;
use App\Traits\Sortable;
use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Person extends Model
{
    use ClearsResponseCache;
    use Duplicatable;
    use Filterable;
    use HasBlocks;
    use HasFactory;
    use HasMedia;
    use HasSlug;
    use Searchable;
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

    public function getSearchableColumns(): array
    {
        return ['name', 'title', 'description'];
    }

    public function getSearchResultAttribute(): SearchResult
    {
        return new SearchResult(
            type: $this->getMorphClass(),
            title: $this->name,
            description: $this->title,
            url_admin: route('admin.people.edit', $this->id),
            url_public: localized_route('front.people.show', ['person' => $this->slug]),
            updated_at: $this->updated_at,
        );
    }
}
