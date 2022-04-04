<?php

declare(strict_types=1);

return [

    'label' => 'Setare|Setări',

    'action' => [
        'update' => 'Salvează setări',
    ],

    'event' => [
        'updated' => 'Setările au fost actualizate.',
    ],

    'section' => [
        'site' => 'Site',
        'donations' => 'Donații',
    ],

    'site' => [
        'title'       => 'Titlu site',
        'description' => 'Descriere site',
        'logo'        => 'Logo',

        'colors' => [
            'primary' => 'Culoare principală',
        ],

        'notice' => [
            'color' => 'Culoare',
            'text'  => 'Text',
        ],
    ],

    'donations' => [
        'euplatesc' => [
            'mid' => 'Cod comerciant',
            'key' => 'Cheie',
        ],
        'mobilpay' => [
            'signature'   => 'Cod comerciant',
            'certificate' => 'Cheie publică',
            'private_key' => 'Cheie privată',
        ],
    ],

];
