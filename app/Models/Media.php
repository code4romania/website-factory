<?php

declare(strict_types=1);

namespace App\Models;

use Plank\Mediable\Media as BaseMedia;

class Media extends BaseMedia
{
    protected $with = [
        'variants',
    ];
}
