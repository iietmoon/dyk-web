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
        'key' => env('POSTMARK_API_KEY'),
    ],

    'resend' => [
        'key' => env('RESEND_API_KEY'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    'paddle' => [
        'api_key' => env('PADDLE_API_KEY'),
        'client_token' => env('PADDLE_CLIENT_TOKEN'),
        'environment' => env('PADDLE_ENVIRONMENT', 'sandbox'), // 'sandbox' or 'production'
        'default_country' => env('PADDLE_DEFAULT_COUNTRY', 'US'), // ISO 3166-1 alpha-2, e.g. US, GB; leave empty to not prefill
        'success_deep_link_scheme' => env('APP_DEEP_LINK_SCHEME', ''), // e.g. "didyouknow" → didyouknow://payment/success?transaction_id=...
    ],

    /*
    |--------------------------------------------------------------------------
    | Agent / n8n API
    |--------------------------------------------------------------------------
    | Bearer token for agent automation (e.g. n8n). No database; validated against this value.
    */
    'agent' => [
        'access_token' => env('AGENT_ACCESS_TOKEN'),
    ],

];
