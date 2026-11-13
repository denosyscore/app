<?php

declare(strict_types=1);

return [
    'name' => env('APP_NAME', 'DenoSys Framework'),
    'key' => env('APP_KEY'),
    // Keys that still decrypt after a rotation (comma-separated); remove once
    // nothing encrypted with them remains.
    'previous_keys' => env('APP_PREVIOUS_KEYS', ''),
    'url' => env('APP_URL', 'http://localhost'),
    'env' => env('APP_ENV', 'production'),
    'debug' => env('APP_DEBUG', false),
    'timezone' => env('APP_TIMEZONE', 'UTC'),
    'version' => env('APP_VERSION', '1.0.0'),
];
