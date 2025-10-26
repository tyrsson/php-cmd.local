<?php

declare(strict_types=1);

namespace App\Storage\Entity;

use App\Auth\UserInterface;
use App\Storage\EntityInterface;

final class User implements UserInterface, EntityInterface
{
    public function __construct(
        private readonly string|int|null $id,
        private readonly string $identity,
        private readonly ?array $roles,
        private readonly ?array $details
    ) {
    }

    public function getId(): string|int|null
    {
        return $this->id;
    }

    public function getIdentity(): string
    {
        return $this->identity;
    }

    public function withIdentity(string $identity): self
    {
        return new self(
            id: $this->id,
            identity: $identity,
            roles: $this->roles,
            details: $this->details
        );
    }

    public function getRoles(): iterable
    {
        return $this->roles;
    }

    public function withRoles(array $roles): self
    {
        return new self(
            id: $this->id,
            identity: $this->identity,
            roles: $roles,
            details: $this->details
        );
    }

    public function getDetail(string $name, $default = null)
    {
        return $this->details[$name] ?? $default;
    }

    public function withDetail(string $name, $value): self
    {
        $newDetails        = $this->details;
        $newDetails[$name] = $value;

        return new self(
            id: $this->id,
            identity: $this->identity,
            roles: $this->roles,
            details: $newDetails
        );
    }

    public function getDetails(): array
    {
        return $this->details;
    }

    public function withDetails(array $details): self
    {
        return new self(
            id: $this->id,
            identity: $this->identity,
            roles: $this->roles,
            details: $details
        );
    }

    public function toArray(): array
    {
        return [
            'id'       => $this->id,
            'identity' => $this->identity,
            'roles'    => $this->roles,
            'details'  => $this->details,
        ];
    }
}
