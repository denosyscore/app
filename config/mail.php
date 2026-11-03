<?php

declare(strict_types=1);

/**
 * Mail Configuration
 *
 * Configure the mail driver and transport settings.
 */
return [
    /*
    |--------------------------------------------------------------------------
    | Default Mailer
    |--------------------------------------------------------------------------
    |
    | Select "smtp" or "sendmail". An explicit Symfony DSN takes precedence.
    |
    */
    'default' => env('MAIL_MAILER', 'smtp'),
    'dsn' => env('MAIL_DSN'),

    /*
    |--------------------------------------------------------------------------
    | Global "From" Address
    |--------------------------------------------------------------------------
    |
    | The default "from" address for all outgoing emails.
    |
    */
    'from' => [
        'address' => env('MAIL_FROM_ADDRESS', 'noreply@example.com'),
        'name' => env('MAIL_FROM_NAME', env('APP_NAME', 'Denosys')),
    ],

    /*
    |--------------------------------------------------------------------------
    | Mailer Configurations
    |--------------------------------------------------------------------------
    |
    | Configure each mailer driver with its specific settings.
    |
    */
    'mailers' => [
        'smtp' => [
            'host' => env('MAIL_HOST', 'localhost'),
            'port' => env('MAIL_PORT', 587),
            'encryption' => env('MAIL_ENCRYPTION', 'tls'), // tls, ssl, or null
            'username' => env('MAIL_USERNAME'),
            'password' => env('MAIL_PASSWORD'),
        ],

        'sendmail' => [
            'path' => env('MAIL_SENDMAIL_PATH', '/usr/sbin/sendmail -bs'),
        ],

    ],
];
