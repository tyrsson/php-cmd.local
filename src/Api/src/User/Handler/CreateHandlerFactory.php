<?php

declare(strict_types=1);

namespace Api\User\Handler;

use PhpCmd\CmdBus\CmdBusInterface;
use Psr\Container\ContainerInterface;

class CreateHandlerFactory
{
    public function __invoke(ContainerInterface $container) : CreateHandler
    {
        return new CreateHandler($container->get(CmdBusInterface::class));
    }
}
