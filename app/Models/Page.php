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
use App\Traits\Publishable;
use App\Traits\Searchable;
use App\Traits\Sortable;
use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use ClearsResponseCache;
    use Duplicatable;
    use Filterable;
    use HasBlocks;
    use HasFactory;
    use HasMedia;
    use HasSlug;
    use Publishable;
    use Searchable;
    use SoftDeletes;
    use Sortable;
    use Translatable;

    public string $slugFieldSource = 'title';

    public array $translatable = [
        'title', 'slug', 'description',
    ];

    public array $allowedSorts = [
        'title',
    ];

    public array $allowedFilters = [
        //
    ];

    public function getSearchableColumns(): array
    {
        return ['title', 'description'];
    }

    public function getSearchResultAttribute(): SearchResult
    {
        return new SearchResult([
            'type'        => $this->getMorphClass(),
            'title'       => $this->title,
            'description' => $this->description,
            'url_admin'   => route('admin.pages.edit', $this->id),
            'url_public'  => localized_route('front.pages.show', ['page' => $this->slug]),
            'updated_at'  => $this->updated_at->diffForHumans(),
        ]);
    }
}
