<?php

namespace Helick\LocalServer\Subcommands;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class StatusSubcommand extends Subcommand
{
    /**
     * The process' command string.
     *
     * @var string
     */
    const COMMAND = 'docker-compose ps';

    /**
     * Invoke the subcommand.
     *
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return void
     */
    public function __invoke(InputInterface $input, OutputInterface $output): void
    {
        $this->runProcess(static::COMMAND);
    }
}
