<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'receipt' => [
        'default_height' => env('RECEIPT_HEIGHT', '5000pt'),
        'width_mm' => env('RECEIPT_WIDTH_MM', default: 72),
        'margin_x_mm' => env('RECEIPT_MARGIN_X_MM', 2),
    ],

    'cloud' => [
        'base_url' => env('CLOUD_URL'),
        'endpoints' => [
            'floors' => '/api/sync/floor',
            'orders' => '/api/sync/order',
            'items' => '/api/sync/item',
            'payments' => '/api/sync/payment',
        ],
    ],

];
