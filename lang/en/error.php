<?php

declare(strict_types=1);

return [

    401 => [
        'title'   => 'Unauthorized',
        'message' => 'Sorry, you are not authorized to access this page.',
    ],
    403 => [
        'title'   => 'Forbidden',
        'message' => 'Sorry, you are forbidden from accessing this page.',
    ],
    404 => [
        'title'   => 'Not found',
        'message' => 'Sorry, the page you are looking for could not be found.',
    ],
    419 => [
        'title'   => 'Expired session',
        'message' => 'Sorry, your session has expired. Please refresh and try again.',
    ],
    429 => [
        'title'   => 'Too Many Requests',
        'message' => 'Sorry, you are making too many requests to our servers.',
    ],
    500 => [
        'title'   => 'Internal Server Error',
        'message' => 'Whoops, something went wrong on our servers.',
    ],
    503 => [
        'title'   => 'Service Unavailable',
        'message' => 'Sorry, we are doing some maintenance. Please check back soon.',
    ],

];
