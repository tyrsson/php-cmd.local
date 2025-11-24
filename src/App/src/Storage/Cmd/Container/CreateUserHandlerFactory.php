<?php

declare(strict_types=1);

namespace App\Storage\Cmd\Container;

use App\Storage\Cmd\CreateUserHandler;
use PhpDb\Adapter\AdapterInterface;
use Psr\Container\ContainerInterface;
use Psr\EventDispatcher\EventDispatcherInterface;

final class CreateUserHandlerFactory
{
    public function __invoke(ContainerInterface $container): CreateUserHandler
    {
        $adapter = $container->get('SqliteReadAdapter');
        try {
            //$adapter = $container->get(AdapterInterface::class);
        } catch (\Throwable $th) {
            throw $th;
        }
        return new CreateUserHandler(
            dbAdapter: $adapter,
            eventDispatcher: $container->get(EventDispatcherInterface::class)
        );
    }
}
