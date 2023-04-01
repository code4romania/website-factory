<?php

declare(strict_types=1);

return [

    401 => [
        'title' => 'Neautorizat',
        'message' => 'Ne pare rău, nu ești autorizat să accesezi această pagină.',
    ],
    403 => [
        'title' => 'Interzis',
        'message' => 'Ne pare rău, nu ai dreptul să accesezi această pagină.',
    ],
    404 => [
        'title' => 'Nu am găsit pagina',
        'message' => 'Ne pare rău, nu am găsit pagina pe care o cauți.',
    ],
    419 => [
        'title' => 'Sesiune expirată',
        'message' => 'Ne pare rău, sesiunea ta a expirat. Te rugăm să încerci din nou.',
    ],
    429 => [
        'title' => 'Prea multe request-uri',
        'message' => 'Ne pare rău, faci prea multe request-uri către serverele noastre.',
    ],
    500 => [
        'title' => 'Eroare internă a serverelor',
        'message' => 'Oops, ceva nu a mers bine pe serverele noastre.',
    ],
    503 => [
        'title' => 'Serviciu indisponibil',
        'message' => 'Ne pare rău, lucrăm la întreținerea site-ului. Te rugăm să încerci mai târziu.',
    ],

];
