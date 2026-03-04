<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Secret Key
    |--------------------------------------------------------------------------
    |
    | This secret key provided by Stripe, used to
    | authenticate your api requests.
    |
    */

    'secret_key' => env('STRIPE_SECRET_KEY'),

    /*
    |--------------------------------------------------------------------------
    | Mode
    |--------------------------------------------------------------------------
    |
    | The mode of the checkout session.
    |
    */

    'mode' => 'payment',

    /*
    |--------------------------------------------------------------------------
    | Currency
    |--------------------------------------------------------------------------
    |
    | The currency represents the currency in which the payment will be
    | processed. Stripe supports only currencies with a valid iso 4217
    | currency code.
    |
    */

    'currency' => 'usd',

    'shipping_rate' => [

        /*
        |--------------------------------------------------------------------------
        | Type of Shipping Rate
        |--------------------------------------------------------------------------
        |
        | The default shipping rate type.
        |
        */

        'type' => 'fixed_amount',

        /*
        |--------------------------------------------------------------------------
        | Display Name
        |--------------------------------------------------------------------------
        |
        | Default display name in Stripe checkout.
        |
        */

        'display_name' => 'Final cost for your order.',

    ],
];
