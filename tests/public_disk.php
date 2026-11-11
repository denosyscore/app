<?php

declare(strict_types=1);

$fixtureRoot = sys_get_temp_dir() . '/denosys-public-disk-' . bin2hex(random_bytes(8));

function env(string $key, mixed $default = null): mixed
{
    return $key === 'APP_URL' ? 'https://example.test' : $default;
}

function storage_path(string $path = ''): string
{
    return $GLOBALS['fixtureRoot'] . '/storage' . ($path === '' ? '' : '/' . $path);
}

function public_path(string $path = ''): string
{
    return $GLOBALS['fixtureRoot'] . '/public' . ($path === '' ? '' : '/' . $path);
}

$config = require __DIR__ . '/../config/filesystems.php';
$public = $config['disks']['public'];
$urlPath = parse_url($public['url'], PHP_URL_PATH);
if (!is_string($urlPath) || $public['root'] !== public_path(ltrim($urlPath, '/'))) {
    throw new RuntimeException('The public disk URL does not map to its web-served root.');
}

if (str_starts_with($config['disks']['local']['root'], public_path())) {
    throw new RuntimeException('The local disk is inside the web-served root.');
}

$avatarDirectory = $public['root'] . '/avatars';
if (!mkdir($avatarDirectory, 0700, true) && !is_dir($avatarDirectory)) {
    throw new RuntimeException('Unable to create the public disk fixture.');
}

try {
    $avatar = $avatarDirectory . '/example.png';
    file_put_contents($avatar, 'fixture');
    if (file_get_contents(public_path(ltrim($urlPath, '/')) . '/avatars/example.png') !== 'fixture') {
        throw new RuntimeException('A public disk file is not reachable at its URL path.');
    }
} finally {
    unlink($avatarDirectory . '/example.png');
    rmdir($avatarDirectory);
    rmdir($public['root']);
    rmdir(public_path());
    rmdir($fixtureRoot);
}

echo "Public disk URL maps to the web-served root.\n";
