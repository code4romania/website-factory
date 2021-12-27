<?php

declare(strict_types=1);

return [

    /*
    |--------------------------------------------------------------------------
    | Default Gateway
    |--------------------------------------------------------------------------
    |
    | Here you can specify the gateway that the facade should use by default.
    |
    */
    'gateway' => env('OMNIPAY_GATEWAY'),

    /*
    |--------------------------------------------------------------------------
    | Default settings
    |--------------------------------------------------------------------------
    |
    | Here you can specify default settings for gateways.
    |
    */
    'defaults' => [
        'testMode' => env('OMNIPAY_TESTMODE', false),
    ],

    /*
    |--------------------------------------------------------------------------
    | Gateway specific settings
    |--------------------------------------------------------------------------
    |
    | Here you can specify gateway specific settings.
    |
    */
    'gateways' => [
        '\Paytic\Omnipay\Euplatesc\Gateway' => [
            'mid' => env('OMNIPAY_EUPLATESC_MID'),
            'key' => env('OMNIPAY_EUPLATESC_KEY'),
        ],
        '\Paytic\Omnipay\Mobilpay\Gateway' => [
            'signature'   => env('OMNIPAY_MOBILPAY_SIGNATURE'),
            'certificate' => env('OMNIPAY_MOBILPAY_CERTIFICATE'),
            'privateKey'  => env('OMNIPAY_MOBILPAY_PRIVATE_KEY'),
            'username'    => env('OMNIPAY_MOBILPAY_USERNAME'),
            'password'    => env('OMNIPAY_MOBILPAY_PASSWORD'),
        ],
    ],

];
