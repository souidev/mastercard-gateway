<?php

return [
    'gateway_url' => env('MASTERCARD_GATEWAY_URL', 'https://test-tnpost.mtf.gateway.mastercard.com/api/rest'),
    'merchant_id' => env('MASTERCARD_MERCHANT_ID'),
    'api_username' => env('MASTERCARD_API_USERNAME'),
    'password' => env('MASTERCARD_PASSWORD'),
    'version' => env('MASTERCARD_VERSION', '100'),
    'debug' => env('MASTERCARD_DEBUG', false),
    'proxy' => [
        'server' => env('MASTERCARD_PROXY_SERVER'),
        'auth' => env('MASTERCARD_PROXY_AUTH'),
    ],
    'ssl' => [
        'ca' => env('MASTERCARD_SSL_CA_PATH'),
    ],
];
