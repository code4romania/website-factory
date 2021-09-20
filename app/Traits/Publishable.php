<?php

declare(strict_types=1);

namespace App\Traits;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

trait Publishable
{
    public function initializePublishable(): void
    {
        $this->fillable[] = 'publish_start_at';
        $this->fillable[] = 'publish_end_at';

        $this->casts['publish_start_at'] = 'datetime';
        $this->casts['publish_end_at'] = 'datetime';
    }

    public function scopePublished(Builder $query): Builder
    {
        $now = Carbon::now();

        return $query
            ->where(
                fn (Builder $q) => $q
                    ->where('publish_start_at', '<=', $now)
                    ->whereNotNull('publish_start_at')
            )
            ->where(
                fn (Builder $q) => $q
                    ->where('publish_end_at', '>', $now)
                    ->orWhereNull('publish_end_at')
            );
    }

    public function scopeOnlyDraft(Builder $query): Builder
    {
        return $query
            ->where('publish_start_at', '>', Carbon::now())
            ->orWhereNull('publish_start_at');
    }

    public function isPublished(): bool
    {
        return optional($this->publish_start_at)->isPast() &&
            ! optional($this->publish_end_at)->isPast();
    }

    public function isDraft(): bool
    {
        return ! $this->isPublished();
    }
}
