<?php

declare(strict_types=1);

namespace App\Traits;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

trait Publishable
{
    public function initializePublishable(): void
    {
        $this->fillable[] = 'published_at';

        $this->casts['published_at'] = 'datetime';
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->whereNotNull('published_at')
            ->where('published_at', '<=', Carbon::now());
    }

    public function scopeUnpublished(Builder $query): Builder
    {
        return $query->whereNull('published_at')
            ->orWhere('published_at', '>', Carbon::now());
    }

    public function scopeOnlyDraft(Builder $query): Builder
    {
        return $query->whereNull('published_at');
    }

    public function scopeOnlyScheduled(Builder $query): Builder
    {
        return $query->where('published_at', '>', Carbon::now());
    }

    public function isDraft(): bool
    {
        return \is_null($this->published_at);
    }

    public function isPublished(): bool
    {
        return ! $this->isDraft() && $this->published_at->isPast();
    }

    public function isScheduled(): bool
    {
        return ! $this->isDraft() && $this->published_at->isFuture();
    }

    /**
     * Determine the publish status of the model instance.
     *
     * @return bool
     */
    public function status(): string
    {
        if ($this->isDraft()) {
            return 'draft';
        }

        if ($this->isPublished()) {
            return 'published';
        }

        if ($this->isScheduled()) {
            return 'scheduled';
        }
    }
}
