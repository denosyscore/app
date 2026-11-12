<?php

declare(strict_types=1);

require dirname(__DIR__) . '/vendor/autoload.php';

if (PHP_VERSION_ID < 80401) {
    throw new RuntimeException('The skeleton requires PHP 8.4.1 or newer.');
}

$frameworkVersion = Composer\InstalledVersions::getVersion('denosyscore/framework');
if (
    $frameworkVersion === null
    || version_compare($frameworkVersion, '0.11.1', '<')
    || version_compare($frameworkVersion, '0.12.0', '>=')
) {
    throw new RuntimeException('The skeleton must resolve framework 0.11.1 or newer in the 0.11 series.');
}

echo "Current framework runtime installed.\n";
