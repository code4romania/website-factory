<?php

declare(strict_types=1);

use App\Services\Features;

return [

    'edition' => Features::edition('develop'),

    'settings' => [
        // This will be populated from the database
    ],
];
