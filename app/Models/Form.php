<?php

declare(strict_types=1);

namespace App\Models;

use App\DataTransferObjects\SearchResult;
use App\Mail\FormSubmitted;
use App\Traits\ClearsResponseCache;
use App\Traits\Duplicatable;
use App\Traits\Filterable;
use App\Traits\HasBlocks;
use App\Traits\HasSlug;
use App\Traits\Searchable;
use App\Traits\Sortable;
use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;

class Form extends Model
{
    use ClearsResponseCache;
    use Duplicatable;
    use Filterable;
    use HasBlocks;
    use HasFactory;
    use HasSlug;
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

    protected $fillable = [
        'store_submissions',
        'send_submissions',
        'recipients',
    ];

    public $casts = [
        'store_submissions' => 'boolean',
        'send_submissions'  => 'boolean',
    ];

    public string $allowedBlockType = 'form';

    protected $blockable = FormField::class;

    public function submissions(): HasMany
    {
        return $this->hasMany(FormSubmission::class);
    }

    public function getRecipientsListAttribute(): Collection
    {
        return collect(preg_split('/\r\n|\r|\n/', $this->recipients))
            ->map(fn ($email) => filter_var($email, \FILTER_VALIDATE_EMAIL));
    }

    public function processSubmission(array $data): void
    {
        $storedSubmission = null;

        if ($this->store_submissions) {
            $storedSubmission = $this->storeSubmission($data);
        }

        if ($this->send_submissions) {
            $this->sendSubmission($data, $storedSubmission);
        }
    }

    public function storeSubmission(array $data): FormSubmission
    {
        return $this->submissions()->create([
            'data' => $data,
        ]);
    }

    public function sendSubmission(array $data, ?FormSubmission $stored): void
    {
        $this->recipients_list->each(
            fn (string $recipient) => Mail::to($recipient)
                ->send(new FormSubmitted(
                    form: $this,
                    stored: $stored,
                    data: $data,
                ))
        );
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
            'url_admin'   => route('admin.forms.edit', $this->id),
            'url_public'  => localized_route('front.forms.show', ['form' => $this->slug]),
            'updated_at'  => $this->updated_at->diffForHumans(),
        ]);
    }
}
