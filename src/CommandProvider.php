<?php

namespace Helick\LocalServer;

use Composer\Plugin\Capability\CommandProvider as ComposerCommandProvider;

final class CommandProvider implements ComposerCommandProvider
{
    /**
     * @inheritDoc
     */
    public function getCommands()
    {
        return [
            new Command,
        ];
    }
}
