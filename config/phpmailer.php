<?php

return [
    'smtp' => [
        'host'       => env('PHPMAILER_HOST'),
        'port'       => env('PHPMAILER_PORT', 587),
        'encryption' => env('PHPMAILER_ENCRYPTION', 'tls'), // tls|ssl|none
        'username'   => env('PHPMAILER_USERNAME'),
        'password'   => env('PHPMAILER_PASSWORD'),
    ],

    // fallback only (if message['from'] not provided)
    'from' => [
        'address' => env('PHPMAILER_FROM_ADDRESS', 'no-reply@example.com'),
        'name'    => env('PHPMAILER_FROM_NAME', 'Allocate'),
    ],

    // fallback only (if message['reply_to'] not provided)
    'reply_to' => [
        'address' => env('PHPMAILER_REPLY_TO_ADDRESS'),
        'name'    => env('PHPMAILER_REPLY_TO_NAME'),
    ],
];