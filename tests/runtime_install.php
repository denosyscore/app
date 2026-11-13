<?php

declare(strict_types=1);

require dirname(__DIR__) . '/vendor/autoload.php';

if (PHP_VERSION_ID < 80401) {
    throw new RuntimeException('The skeleton requires PHP 8.4.1 or newer.');
}

$frameworkVersion = Composer\InstalledVersions::getVersion('denosyscore/framework');
if (
    $frameworkVersion === null
    || version_compare($frameworkVersion, '0.20.0', '<')
    || version_compare($frameworkVersion, '0.21.0', '>=')
) {
    throw new RuntimeException('The skeleton must resolve framework 0.20.0 or newer in the 0.20 series.');
}

echo "Current framework runtime installed.\n";
