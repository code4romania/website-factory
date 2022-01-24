<?php

declare(strict_types=1);

use App\Services\Features;

return [

    'edition' => Features::edition(env('WEBSITE_FACTORY_EDITION', 'ong')),

    'settings' => [
        // This will be populated from the database
    ],
];
