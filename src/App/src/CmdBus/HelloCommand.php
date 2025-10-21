<?php

declare(strict_types=1);

namespace App\CmdBus;

use Laminas\DevelopmentMode\Command;
use PhpCmd\CmdBus\Command\CommandResultInterface;
use PhpCmd\CmdBus\Command\NamedCommandInterface;
use PhpCmd\CmdBus\Command\NamedCommandTrait;

final class HelloCommand implements NamedCommandInterface
{
    use NamedCommandTrait;

    private CommandResultInterface $result;

    public function __construct() {
        $this->name = 'hello.command';
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setResult(CommandResultInterface $result): void
    {
        // Implementation for setting the result if needed
        $this->result = $result;
    }

    public function getResult(): ?CommandResultInterface
    {
        // Implementation for getting the result if needed
        return $this->result;
    }
}
