<?php

namespace Helick\LocalServer\Subcommands;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class DestroySubcommand extends Subcommand
{
    /**
     * The process' command string.
     *
     * @var string
     */
    const COMMAND = 'docker-compose down -v';

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
        $output->writeln('Destroying...');

        $this->runProcess(static::COMMAND);

        $output->writeln('Destroyed.');
    }
}
