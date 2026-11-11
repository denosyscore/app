<?php

declare(strict_types=1);

/*
 * The skeleton is the starting point for every new project, so it must not
 * carry settings or wording from any application built on it.
 *
 * The denylist holds SHA-256 hashes of lower-case words that identify known
 * consumers, so this repository never names them. Every word in tracked text
 * files is hashed and compared; a match fails with its file and line only.
 */

const DENYLIST = [
    '5a35cec6cb671af8d4fec4d5cb000cab7cccef0e866b57f6a5841400afe02e81',
    '32c4ea828dda2274e1ae9d4cb37e6d6dfb5ae27149f94a0f7e544a6782ea8e3a',
    '84a9ceb1ee3a8b0dc509dded516483d1c4d976c13260ffcedf508cfc32b52fbe',
];

$root = dirname(__DIR__);
$failures = [];

function env(string $key, mixed $default = null): mixed
{
    return $default;
}

function storage_path(string $path = ''): string
{
    return '/project/storage' . ($path === '' ? '' : '/' . $path);
}

function public_path(string $path = ''): string
{
    return '/project/public' . ($path === '' ? '' : '/' . $path);
}

$app = require $root . '/config/app.php';
$allowedAppKeys = ['name', 'key', 'url', 'env', 'debug', 'timezone', 'version'];
foreach (array_diff(array_keys($app), $allowedAppKeys) as $key) {
    $failures[] = "config/app.php defines application-specific key [{$key}]";
}

$disks = (require $root . '/config/filesystems.php')['disks'];
foreach (array_diff(array_keys($disks), ['local', 'public', 's3']) as $disk) {
    $failures[] = "config/filesystems.php defines application-specific disk [{$disk}]";
}

$files = [];
exec('git -C ' . escapeshellarg($root) . ' ls-files -z', $output, $status);
if ($status !== 0) {
    throw new RuntimeException('Unable to list tracked files.');
}
foreach (explode("\0", implode("\n", $output)) as $file) {
    if ($file !== '' && is_file($root . '/' . $file)) {
        $files[] = $file;
    }
}

$denylist = array_flip(DENYLIST);
foreach ($files as $file) {
    $contents = (string) file_get_contents($root . '/' . $file);
    if (str_contains($contents, "\0")) {
        continue;
    }

    foreach (preg_split('/\R/', $file . "\n" . $contents) ?: [] as $index => $line) {
        preg_match_all('/[a-z0-9]+/i', $line, $words);
        foreach ($words[0] as $word) {
            if (isset($denylist[hash('sha256', strtolower($word))])) {
                $failures[] = $index === 0
                    ? "{$file}: path contains a consumer-specific word"
                    : "{$file}:{$index} contains a consumer-specific word";
                break;
            }
        }
    }
}

if ($failures !== []) {
    fwrite(STDERR, implode("\n", array_unique($failures)) . "\n");
    exit(1);
}

echo "Skeleton is application-neutral.\n";
