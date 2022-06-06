<?php

declare(strict_types=1);

namespace App\Models;

use App\Mail\FormSubmitted;
use App\Traits\ClearsResponseCache;
use App\Traits\Filterable;
use App\Traits\HasBlocks;
use App\Traits\HasSlug;
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
    use Filterable;
    use HasBlocks;
    use HasFactory;
    use HasSlug;
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
        if ($this->store_submissions) {
            $this->storeSubmission($data);
        }

        if ($this->send_submissions) {
            $this->sendSubmission($data);
        }
    }

    public function storeSubmission(array $data): void
    {
        $this->submissions()->create([
            'data' => $data,
        ]);
    }

    public function sendSubmission(array $data): void
    {
        $this->recipients_list->each(
            fn (string $recipient) => Mail::to($recipient)
                ->send(new FormSubmitted($this, $data))
        );
    }
}
