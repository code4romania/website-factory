<?php

declare(strict_types=1);

return [

    /*
    |--------------------------------------------------------------------------
    | Application Locales
    |--------------------------------------------------------------------------
    |
    | Contains an array with the applications available locales.
    |
    */
    'locales' => [
        'ro' => [
            'enabled' => true,
            'name'    => 'Română',
            'code'    => 'ro_RO',
            'ts_lang' => 'romanian',
        ],
        'en' => [
            'enabled' => true,
            'name'    => 'English',
            'code'    => 'en_GB',
            'ts_lang' => 'english',
        ],
        'hu' => [
            'enabled' => false,
            'name'    => 'Magyar',
            'code'    => 'hu_HU',
            'ts_lang' => 'hungarian',
        ],
        'fr' => [
            'enabled' => false,
            'name'    => 'Français',
            'code'    => 'fr_FR',
            'ts_lang' => 'french',
        ],
        'de' => [
            'enabled' => false,
            'name'    => 'Deutsch',
            'code'    => 'de_DE',
            'ts_lang' => 'german',
        ],
    ],

    /*
     * If a translation has not been set for a given locale and the fallback locale,
     * any other locale will be chosen instead.
     */
    'fallback_any' => true,

];
