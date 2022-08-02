<?php

declare(strict_types=1);

namespace App\Traits;

use Spatie\ResponseCache\Facades\ResponseCache;

trait ClearsResponseCache
{
    public static function bootClearsResponseCache()
    {
        self::created(fn () => self::clearCache());
        self::updated(fn () => self::clearCache());
        self::deleted(fn () => self::clearCache());
    }

    private static function clearCache(): void
    {
        ResponseCache::clear();

        $cacheDir = '/tmp/fastcgi/cache';
        if (file_exists($cacheDir)) {
            exec("rm -rf $cacheDir/*");
        }
    }
}
