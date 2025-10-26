<?php

declare(strict_types=1);

namespace App\Storage\Cmd;

use App\Auth\UserInterface;
use PhpCmd\CmdBus\Command\NamedCommandInterface;
use PhpCmd\CmdBus\Command\NamedCommandTrait;

final readonly class CreateUserCmd implements NamedCommandInterface, UserInterface
{
    use NamedCommandTrait;

    public function __construct(
        private string $identity,
        private array $roles   = [],
        private array $details = []
    ) {
    }

    public function getIdentity(): string
    {
        return $this->identity;
    }

    public function getRoles(): iterable
    {
        return $this->roles;
    }

    public function getDetail(string $name, $default = null): mixed
    {
        return $this->details[$name] ?? $default;
    }

    public function getDetails(): array
    {
        return $this->details;
    }
}
