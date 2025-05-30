<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Midtrans Configuration
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for Midtrans payment gateway.
    | You can set your server key, client key, and other configurations here.
    |
    */

    'server_key' => env('MIDTRANS_SERVER_KEY', 'your-server-key-here'),
    // 'client_key' => env('MIDTRANS_CLIENT_KEY', 'your-client-key-here'),
    'is_production' => env('MIDTRANS_IS_PRODUCTION'),
    'is_sanitized' => env('MIDTRANS_IS_SANITIZED'),
    'is_3ds' => env('MIDTRANS_IS_3DS'),
    // Additional configurations can be added here
];
// You can also add more configurations like payment methods, notification URLs, etc.
