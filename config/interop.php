<?php

return [

    'base_url'  => env('INTEROP_BASE_URL', ''),

    'auth' => [
        'token_url' => env('INTEROP_AUTH_URL'),
        'username'  => env('INTEROP_CLIENT_ID'),
        'password'  => env('INTEROP_CLIENT_SECRET'),
    ],
    'webhook_token' => env('ALLOCATE_CALLBACK_TOKEN')

];

