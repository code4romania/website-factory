<?php

declare(strict_types=1);

namespace App\Models;

use App\Mail\FormSubmitted;
use App\Traits\Filterable;
use App\Traits\HasBlocks;
use App\Traits\HasUuid;
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
    use Filterable;
    use HasBlocks;
    use HasFactory;
    use HasUuid;
    use SoftDeletes;
    use Sortable;
    use Translatable;

    public array $translatable = [
        'title', 'description',
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
            ->map(fn ($email) => \filter_var($email, \FILTER_VALIDATE_EMAIL));
    }

    public function storeSubmission(array $data): void
    {
        if (! $this->store_submissions) {
            return;
        }

        $this->submissions()->create([
            'data' => $data,
        ]);
    }

    public function sendSubmission(array $data): void
    {
        if (! $this->send_submissions) {
            return;
        }

        $this->recipients_list->each(
            fn (string $recipient) => Mail::to($recipient)
                ->send(new FormSubmitted($this, $data))
        );
    }
}
