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

    public static function bootPublishable(): void
    {
        static::addGlobalScope('published', function (Builder $query) {
            $query->onlyPublished();
        });
    }

    public function scopeWithDrafted(Builder $query): Builder
    {
        return $query->withoutGlobalScope('published');
    }

    public function scopeOnlyDrafted(Builder $query): Builder
    {
        return $query
            ->withDrafted()
            ->whereNull('published_at');
    }

    public function scopeOnlyScheduled(Builder $query): Builder
    {
        return $query
            ->withDrafted()
            ->whereNotNull('published_at')
            ->where('published_at', '>', Carbon::now());
    }

    public function scopeOnlyPublished(Builder $query): Builder
    {
        return $query
            ->whereNotNull('published_at')
            ->where('published_at', '<=', Carbon::now());
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
     * @return string
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
