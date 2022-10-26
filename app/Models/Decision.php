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
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Decision extends Model
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

    protected $fillable = [
        'number', 'date',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public array $translatable = [
        'title', 'slug', 'description',
    ];

    public array $allowedSorts = [
        'title', 'date',
    ];

    public array $allowedFilters = [
        //
    ];

    protected $with = [
        'categories', 'authors',
    ];

    public function authors(): BelongsToMany
    {
        return $this->belongsToMany(DecisionAuthor::class, 'author_decision');
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(DecisionCategory::class, 'category_decision');
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
            'url_admin'   => route('admin.decisions.edit', $this->id),
            'url_public'  => localized_route('front.decisions.show', ['decision' => $this->slug]),
            'updated_at'  => $this->updated_at->diffForHumans(),
        ]);
    }
}
