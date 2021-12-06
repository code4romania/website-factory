<?php

declare(strict_types=1);

namespace App\Services;

use Exception;

class SupportsTrait
{
    private static array $traitMap = [
        'blocks'       => \App\Traits\HasBlocks::class,
        'filterable'   => \App\Traits\Filterable::class,
        'layout'       => \App\Traits\HasLayout::class,
        'media'        => \App\Traits\HasMedia::class,
        'publishable'  => \App\Traits\Publishable::class,
        'softDeletes'  => \Illuminate\Database\Eloquent\SoftDeletes::class,
        'sortable'     => \App\Traits\Sortable::class,
        'slug'         => \App\Traits\HasSlug::class,
        'translatable' => \App\Traits\Translatable::class,
        'uuid'         => \App\Traits\HasUuid::class,
    ];

    public static function __callStatic(string $method, array $args): bool
    {
        if (! \array_key_exists($method, self::$traitMap)) {
            throw new Exception("Couldn't find corresponding trait for $method.");
        }

        return \in_array(self::$traitMap[$method], \class_uses_recursive($args[0]));
    }
}
