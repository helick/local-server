<?php

namespace Helick\LocalServer\Subcommands;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;

final class StartSubcommand extends Subcommand
{
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

        $process = new Process('docker-compose up -d', 'vendor/helick/local-server/docker', [
            'COMPOSE_PROJECT_NAME' => basename(getcwd()),
            'VOLUME'               => getcwd(),
            'PATH'                 => getenv('PATH'),
        ]);
        $process->setTimeout(0);
        $failed = $process->run(function ($_, $buffer) {
            echo $buffer;
        });

        if ($failed) {
            return;
        }

        $output->writeln('Started.');
        $output->writeln('To access site please visit: http://' . basename(getcwd()) . '.localtest.me/');
        $output->writeln('To access phpmyadmin please visit: http://phpmyadmin.' . basename(getcwd()) . '.localtest.me/');
        $output->writeln('To access elasticsearch please visit: http://elasticsearch.' . basename(getcwd()) . '.localtest.me/');
    }
}
