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
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    'sms' =>  [
        'base_uri'  => "https://2factor.in/API/V1/",
        'secret'  =>  '3d23caae-474d-11eb-8153-0200cd936042',
    ],
    'ipstack' =>  [
        'base_uri'  => "http://api.ipstack.com/",
        'secret'  =>  '0e6ab3c38a43c6460820a2992cda5454',
    ],

    'exchange'=>[
        'crypto_uri' => "https://api.binance.com/api/v1/",
        'fiat_uri'=>"https://api.coinbase.com/v2/"

    ],

    'telegram-bot-api' => [
        'token' => env('TELEGRAM_BOT_TOKEN', '1862394442:AAF8NH6QsQHc4D2VI3urxtZdhkPtw2mFwDk')
    ],

];
