<?php

declare(strict_types=1);

$publicRoot = realpath(__DIR__ . '/public');
$requestPath = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
if (!is_string($requestPath) || $publicRoot === false) {
    http_response_code(400);

    return true;
}

$requestPath = rawurldecode($requestPath);
if (
    preg_match('~(?:^|/)\.~', $requestPath) === 1
    || ($requestPath !== '/index.php' && preg_match('~\.(?:php\d*|phtml|phar)(?:/|$)~i', $requestPath) === 1)
) {
    http_response_code(404);

    return true;
}

$requestedFile = realpath($publicRoot . $requestPath);
if (
    $requestedFile !== false
    && str_starts_with($requestedFile, $publicRoot . DIRECTORY_SEPARATOR)
    && is_file($requestedFile)
) {
    return false;
}

require __DIR__ . '/public/index.php';
