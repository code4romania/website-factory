<?php

declare(strict_types=1);

namespace App\Traits;

use Spatie\ResponseCache\Facades\ResponseCache;

trait ClearsResponseCache
{
    public static function bootClearsResponseCache()
    {
        self::created(fn () => ResponseCache::clear());
        self::updated(fn () => ResponseCache::clear());
        self::deleted(fn () => ResponseCache::clear());
    }
}
