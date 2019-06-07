<?php

namespace Helick\LocalServer;

use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Plugin\Capability\CommandProvider as ComposerCommandProvider;
use Composer\Plugin\Capable;
use Composer\Plugin\PluginInterface;

final class Plugin implements PluginInterface, Capable
{
    /**
     * @inheritDoc
     */
    public function activate(Composer $composer, IOInterface $io)
    {
        //
    }

    /**
     * @inheritDoc
     */
    public function getCapabilities()
    {
        return [
            ComposerCommandProvider::class => CommandProvider::class,
        ];
    }
}
