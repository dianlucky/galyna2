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

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'resend' => [
        'key' => env('RESEND_KEY'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    // Konfigurasi Midtrans
    'midtrans' => [
        'serverKey'     => env('MIDTRANS_SERVER_KEY'),
        'clientKey'     => env('MIDTRANS_CLIENT_KEY'),
        'isProduction'  => env('MIDTRANS_IS_PRODUCTION', false),
    ],

    // Konfigurasi RajaOngkir
    'rajaongkir' => [
        'api_key' => env('RAJAONGKIR_API_KEY'),
        'origin_city_id' => env('RAJAONGKIR_ORIGIN_CITY_ID'),
        'api_base_url' => env('RAJAONGKIR_API_BASE_URL', 'https://api.rajaongkir.com/starter/'), // Default Starter
        'api_base_url_pro' => env('RAJAONGKIR_API_BASE_URL_PRO', 'https://api.rajaongkir.com/pro/'), // Default Pro
    ],

];
