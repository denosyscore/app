<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use App\Models\User;
use Denosys\Auth\Identity\AuthenticatableInterface;
use Denosys\Database\Connection\ConnectionManager;
use Denosys\Database\Record\Record;
use Denosys\Database\Record\Records;
use Denosys\Database\Record\RecordStore;

if (!is_a(User::class, Record::class, true) || !is_a(User::class, AuthenticatableInterface::class, true)) {
    throw new RuntimeException('The starter User must be a Record and AuthenticatableInterface.');
}

$db = new ConnectionManager();
$db->addConnection('default', ['driver' => 'sqlite', 'database' => ':memory:']);
$db->setDefaultConnection('default');
$db->connection()->statement('CREATE TABLE users (id INTEGER PRIMARY KEY, name TEXT NOT NULL, email TEXT NOT NULL, password TEXT NOT NULL, remember_token TEXT NULL)');
Records::use(new RecordStore($db));

$user = new User();
$user->name = 'Ada';
$user->email = 'ada@example.test';
$user->password = password_hash('secret', PASSWORD_DEFAULT);
$user->save();
$user->setRememberToken('token');
$user->save();

$loaded = User::findOrFail($user->getAuthIdentifier());
if ($loaded->getRememberToken() !== 'token' || $loaded->getAuthClaims()['email'] !== 'ada@example.test') {
    throw new RuntimeException('The starter User did not round-trip.');
}

echo "Starter User record saves and loads.\n";
