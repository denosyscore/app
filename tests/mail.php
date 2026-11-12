<?php

declare(strict_types=1);

require dirname(__DIR__) . '/vendor/autoload.php';

$_ENV['MAIL_DSN'] = 'null://null';
putenv('MAIL_DSN=null://null');

$app = require dirname(__DIR__) . '/bootstrap/app.php';

$app->getHttpKernel()->bootstrap();

$container = Denosys\Application::getContainer();
if (!$container->get(Symfony\Component\Mailer\MailerInterface::class) instanceof Symfony\Component\Mailer\MailerInterface) {
    throw new RuntimeException('The starter application did not bind a mailer.');
}

if ((string) $container->get(Symfony\Component\Mailer\Transport\TransportInterface::class) !== 'null://') {
    throw new RuntimeException('The starter mail config did not select the explicit DSN.');
}

$config = $container->get(Denosys\Config\Repository::class);
$mailers = $config->get('mail.mailers');
if (!is_array($mailers) || array_keys($mailers) !== ['smtp', 'sendmail']) {
    throw new RuntimeException('The starter mail config advertises unsupported transports.');
}

echo "Starter mailer resolves from supported configuration.\n";
