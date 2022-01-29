<?php

declare(strict_types=1);

use App\Services\Features;

return [

    'edition' => Features::edition(env('WEBSITE_FACTORY_EDITION', 'ong')),

    'settings' => [
        // This will be populated from the database
    ],

    'social_platforms' => [
        'facebook' => [
            'label'  => 'Facebook',
            'prefix' => 'https://www.facebook.com/',
            'icon'   => 'ri-facebook-fill',
        ],
        'linkedin' => [
            'label'  => 'LinkedIn',
            'prefix' => 'https://www.linkedin.com/in/',
            'icon'   => 'ri-linkedin-fill',
        ],
        'instagram' => [
            'label'  => 'Instagram',
            'prefix' => 'https://www.instagram.com/',
            'icon'   => 'ri-instagram-line',
        ],
        'twitter' => [
            'label'  => 'Twitter',
            'prefix' => 'https://twitter.com/',
            'icon'   => 'ri-twitter-fill',
        ],
        'github' => [
            'label'  => 'GitHub',
            'prefix' => 'https://github.com/',
            'icon'   => 'ri-github-fill',
        ],
    ],

];
