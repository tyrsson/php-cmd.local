<?php

declare(strict_types=1);

namespace App\Storage\Cmd\Container;

use App\Storage\Cmd\CreateUserHandler;
use PhpDb\Adapter\AdapterInterface;
use Psr\Container\ContainerInterface;

final class CreateUserHandlerFactory
{
    public function __invoke(ContainerInterface $container): CreateUserHandler
    {
        return new CreateUserHandler(
            dbAdapter: $container->get(AdapterInterface::class)
        );
    }
}
