<?php

namespace Helick\LocalServer\Subcommands;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;

final class StatusSubcommand extends Subcommand
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
        $process = new Process('docker-compose ps', 'vendor/helick/local-server/docker', [
            'COMPOSE_PROJECT_NAME' => basename(getcwd()),
            'VOLUME'               => getcwd(),
        ]);
        $process->setTimeout(0);
        $process->run(function ($_, $buffer) {
            echo $buffer;
        });
    }
}
