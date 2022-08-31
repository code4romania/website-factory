<?php

declare(strict_types=1);

namespace App\Traits;

use Spatie\ResponseCache\Facades\ResponseCache;

trait ClearsResponseCache
{
    public static function bootClearsResponseCache()
    {
        self::created(fn () => self::clearResponseCache());
        self::updated(fn () => self::clearResponseCache());
        self::deleted(fn () => self::clearResponseCache());
    }

    private static function clearResponseCache(): void
    {
        ResponseCache::clear();

        $cacheDir = '/tmp/fastcgi/cache';
        if (file_exists($cacheDir)) {
            exec("rm -rf $cacheDir/*");
        }
    }
}
