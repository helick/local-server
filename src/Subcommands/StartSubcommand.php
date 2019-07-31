<?php

namespace Helick\LocalServer\Subcommands;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class StartSubcommand extends Subcommand
{
    /**
     * The process' command string.
     *
     * @var string
     */
    const COMMAND = 'docker-compose up -d';

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
        $output->writeln('Starting...');

        $process = $this->runProcess(static::COMMAND);

        if (!$process->isSuccessful()) {
            return;
        }

        $output->writeln('Started.');
        $output->writeln('');
        $output->writeln(sprintf(
            'To access site please visit: http://%s.localtest.me/',
            basename(getcwd())
        ));
        $output->writeln(sprintf(
            'To access phpmyadmin please visit: http://phpmyadmin.%s.localtest.me/',
            basename(getcwd())
        ));
        $output->writeln(sprintf(
            'To access elasticsearch please visit: http://elasticsearch.%s.localtest.me/',
            basename(getcwd())
        ));
    }
}
