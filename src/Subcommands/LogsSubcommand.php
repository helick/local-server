<?php

namespace Helick\LocalServer\Subcommands;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class LogsSubcommand extends Subcommand
{
    /**
     * The process' command string.
     *
     * @var string
     */
    const COMMAND = 'docker-compose logs -f %s';

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
        $service = $input->getArgument('options')[0];

        $this->runProcess(sprintf(static::COMMAND, $service));
    }
}
