<?php

declare(strict_types=1);

use Denosys\Application;
use Denosys\Http\Exceptions\ExceptionHandler;

// The framework's default providers (Application::defaultProviders()) are
// always registered; list only the application's own here. Remove a default
// with ->without(...).
return Application::configure(basePath: dirname(__DIR__))
    ->withProviders([
        App\Providers\AppServiceProvider::class,
    ])
    ->withRoutes(web: __DIR__ . '/../routes/web.php')
    ->withExceptions(function (ExceptionHandler $exception) {
        // Register custom exception mappings here.
    })
    ->create();
