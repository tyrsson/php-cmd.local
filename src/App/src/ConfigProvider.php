<?php

declare(strict_types=1);

namespace App;

use PhpCmd\CmdBus\ConfigProvider as CmdBusConfigProvider;
use PhpCmd\Event\PreHandleEvent;
use Webware\Event\ConfigKey;
use Webware\Event\ListenerPriority as Priority;

/**
 * The configuration provider for the App module
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
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencies(),
            'templates'    => $this->getTemplates(),
            CmdBusConfigProvider::class => $this->getCommandMap(),
            ConfigKey::Listeners->value => $this->getListeners(),
        ];
    }

    /**
     * Returns the container dependencies
     */
    public function getDependencies(): array
    {
        return [
            'invokables' => [
                Handler\PingHandler::class => Handler\PingHandler::class,
                CmdBus\HelloCommand::class => CmdBus\HelloCommand::class,
                CmdBus\HelloCommandHandler::class => CmdBus\HelloCommandHandler::class,
                Listener\PreCommandHandledListener::class => Listener\PreCommandHandledListener::class,
            ],
            'factories'  => [
                Handler\HomePageHandler::class => Handler\HomePageHandlerFactory::class,
            ],
        ];
    }

    public function getListeners(): array
    {
        return [
            [
                'listener' => Listener\PreCommandHandledListener::class,
                'event'    => PreHandleEvent::class,
                'priority' => Priority::High->value,
            ]
        ];
    }

    public function getCommandMap(): array
    {
        return [
            CmdBusConfigProvider::COMMAND_MAP_KEY => [
                CmdBus\HelloCommand::class => CmdBus\HelloCommandHandler::class,
            ],
        ];
    }

    /**
     * Returns the templates configuration
     */
    public function getTemplates(): array
    {
        return [
            'paths' => [
                'app'    => [__DIR__ . '/../templates/app'],
                'error'  => [__DIR__ . '/../templates/error'],
                'layout' => [__DIR__ . '/../templates/layout'],
            ],
        ];
    }
}
