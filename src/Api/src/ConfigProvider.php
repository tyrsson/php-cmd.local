<?php

declare(strict_types=1);

namespace Api;

use PhpCmd\CmdBus\ConfigProvider as CmdBusConfigProvider;
use App\Storage;

/**
 * The configuration provider for the Api module
 *
 * @see https://docs.laminas.dev/laminas-component-installer/
 */
class ConfigProvider
{
    /**
     * Returns the configuration array
     *
     * To add a bit of a structure, each section is defined in a separate
     * method which returns an array with its configuration.
     */
    public function __invoke() : array
    {
        return [
            'dependencies' => $this->getDependencies(),
            CmdBusConfigProvider::class => $this->getCommandMap(),
        ];
    }

    /**
     * Returns the container dependencies
     */
    public function getDependencies() : array
    {
        return [
            'invokables' => [
            ],
            'factories'  => [
                Storage\Cmd\CreateUserHandler::class => Storage\Cmd\Container\CreateUserHandlerFactory::class,
            ],
        ];
    }

    public function getCommandMap() : array
    {
        return [
            CmdBusConfigProvider::COMMAND_MAP_KEY => [
                Storage\Cmd\CreateUserCmd::class => Storage\Cmd\CreateUserHandler::class,
            ],
        ];
    }
}
