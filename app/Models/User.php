<?php

declare(strict_types=1);

namespace App\Models;

use Denosys\Auth\Identity\AuthenticatableInterface;
use Denosys\Database\Record\Attributes\Table;
use Denosys\Database\Record\Persists;
use Denosys\Database\Record\Record;

/**
 * The starter user. Public properties are columns; keep secrets out of
 * responses by building response data explicitly.
 */
#[Table('users')]
final class User implements Record, AuthenticatableInterface
{
    use Persists;

    public ?int $id = null;
    public string $name;
    public string $email;
    public string $password;
    public ?string $rememberToken = null;

    public function getAuthIdentifier(): string|int
    {
        return $this->id ?? 0;
    }

    public function getAuthIdentifierName(): string
    {
        return 'id';
    }

    public function getAuthPassword(): string
    {
        return $this->password;
    }

    public function getRememberToken(): ?string
    {
        return $this->rememberToken;
    }

    public function setRememberToken(string $token): void
    {
        $this->rememberToken = $token;
    }

    public function getRememberTokenName(): string
    {
        return 'remember_token';
    }

    /** @return array<string, mixed> */
    public function getAuthClaims(): array
    {
        return ['id' => $this->getAuthIdentifier(), 'email' => $this->email, 'name' => $this->name];
    }
}
