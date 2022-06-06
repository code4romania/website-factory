<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\ClearsResponseCache;
use App\Traits\Filterable;
use App\Traits\HasSlug;
use App\Traits\Sortable;
use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostCategory extends Model
{
    use ClearsResponseCache;
    use Filterable;
    use HasFactory;
    use HasSlug;
    use SoftDeletes;
    use Sortable;
    use Translatable;

    public $timestamps = false;

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

    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'category_post')
            ->orderByDesc('published_at');
    }
}
