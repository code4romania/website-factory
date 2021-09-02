<?php

declare(strict_types=1);

return [

    'skip-route-function' => true,

    'except' => [
        'debugbar.*',
        'dusk.*',
        'horizon.*',
        'ignition.*',
        'telescope',
    ],

];
