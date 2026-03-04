<?php

return [

    'after_paying' => [

        /*
        |--------------------------------------------------------------------------
        | Returning From Stripe
        |--------------------------------------------------------------------------
        |
        | Names of the routes used when returning from Stripe after paying.
        | Signed URLs will be generated for secure handling of both successful
        | and canceled payments.
        |
        */

        'route_names' => [

            'cancel_url' => 'orders.order-payments.cancel',
            'success_url' => 'orders.order-payments.success',
        ],

    ],
];
