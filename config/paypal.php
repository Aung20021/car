<?php

return [
    'client_id' => env('PAYPAL_CLIENT_ID', ''),
    'secret' => env('PAYPAL_CLIENT_SECRET', ''), // Corrected key
    'settings' => [
        'mode' => env('PAYPAL_MODE', 'sandbox'), // sandbox or live
        'http.ConnectionTimeOut' => 30,
        'log.LogEnabled' => true,
        'log.FileName' => storage_path() . '/logs/paypal.log',
        'log.LogLevel' => 'DEBUG', // DEBUG, INFO, WARN, or ERROR
    ],
    'currency' => env('PAYPAL_CURRENCY', 'USD'),

];
