<?php

declare(strict_types=1);

namespace App\CmdBus;

use InvalidArgumentException;
use PhpCmd\CmdBus\CommandInterface;
use PhpCmd\CmdBus\CommandHandlerInterface;

final class HelloCommandHandler implements CommandHandlerInterface
{
    public function handle(CommandInterface $command): mixed
    {
        if (! $command instanceof HelloCommand) {
            throw new InvalidArgumentException('Invalid command');
        }
        $name = $command->getName();
        return "Hello, {$name}!";
    }
}
