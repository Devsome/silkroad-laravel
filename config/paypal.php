<?php

return [
    /*
     * Define the mode paypal should be
     * Can be sandbox or live
     */
    'mode' => env('PAYPAL_MODE', 'sandbox'),

    /*
     * Paypal in sandbox mode
     */
    'sandbox' => [
        'clientId' => env('PAYPAL_SANDBOX_API_CLIENT_ID', ''),
        'secret' => env('PAYPAL_SANDBOX_API_SECRET', ''),
    ],

    /*
     * Paypal in live usage
     */
    'live' => [
        'clientId' => env('PAYPAL_LIVE_API_CLIENT_ID', ''),
        'secret' => env('PAYPAL_LIVE_API_SECRET', ''),
    ],
];
