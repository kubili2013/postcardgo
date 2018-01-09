<?php
/**
 * PayPal Setting & API Credentials
 * Created by Raza Mehdi <srmk@outlook.com>.
 */

return [
    'mode'    => env('PAYPAL_MODE', 'sandbox'), // Can only be 'sandbox' Or 'live'. If empty or invalid, 'live' will be used.
    'sandbox' => [
        'client_id'    => env('PAYPAL_SANDBOX_API_CLIENT_ID', ''),
        'secret'      => env('PAYPAL_SANDBOX_API_SECRET', ''),
    ],
    'live' => [
        'client_id'    => env('PAYPAL_LIVE_API_CLIENT_ID', ''),
        'secret'      => env('PAYPAL_LIVE_API_SECRET', ''),
    ],
    'payment_action' => 'sale', // Can only be 'Sale', 'Authorization' or 'Order'
    'currency'       => 'USD',
    'returnurl'       => env('PAYPAL_RETURN_URL', ''),
    'cancelurl'       => env('PAYPAL_CANCEL_URL', ''),
];
