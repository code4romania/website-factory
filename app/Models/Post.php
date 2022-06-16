<?php

declare(strict_types=1);

namespace App\Models;

use App\DataTransferObjects\SearchResult;
use App\Traits\ClearsResponseCache;
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
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use ClearsResponseCache;
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

    protected $fillable = [
        'author',
    ];

    public array $allowedSorts = [
        'title', 'created_at', 'published_at',
    ];

    public array $allowedFilters = [
        //
    ];

    public $with = [
        'categories',
    ];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(PostCategory::class, 'category_post');
    }

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
            'url_admin'   => route('admin.posts.edit', $this->id),
            'url_public'  => localized_route('front.posts.show', ['post' => $this->slug]),
            'updated_at'  => $this->updated_at->diffForHumans(),
        ]);
    }
}
