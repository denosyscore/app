<?php

declare(strict_types=1);

$publicDirectory = dirname(__DIR__) . '/public';
$storageDirectory = $publicDirectory . '/storage';
$image = $storageDirectory . '/router-test.png';
$script = $storageDirectory . '/router-test.php';
file_put_contents($image, 'image fixture');
file_put_contents($script, '<?php echo "executed";');

try {
    $_SERVER['REQUEST_URI'] = '/storage/router-test.png';
    http_response_code(200);
    if (include dirname(__DIR__) . '/dev-server.php') {
        throw new RuntimeException('The router did not allow a public image.');
    }

    foreach (['/storage/router-test.php', '/storage/router-test.phtml', '/.env'] as $path) {
        $_SERVER['REQUEST_URI'] = $path;
        http_response_code(200);
        if ((include dirname(__DIR__) . '/dev-server.php') !== true || http_response_code() !== 404) {
            throw new RuntimeException('The router allowed an executable or hidden path.');
        }
    }
} finally {
    unlink($image);
    unlink($script);
}

echo "Development router blocks executable public paths.\n";
