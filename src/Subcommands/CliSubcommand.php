<?php

namespace Helick\LocalServer\Subcommands;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;

final class CliSubcommand extends Subcommand
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
        $options = $input->getArgument('options');

        $hasUrlOption = false;
        foreach ($options as $option) {
            if (strpos($option, '--url=') === 0) {
                $hasUrlOption = true;
                break;
            }
        }

        if (!$hasUrlOption) {
            $options[] = '--url=http://' . basename(getcwd()) . '.localtest.me/';
        }

        $process = new Process(
            sprintf('docker-compose exec -T -u nobody php /code/vendor/bin/wp %s', implode(' ', $options)),
            'vendor/helick/local-server/docker',
            [
                'COMPOSE_PROJECT_NAME' => basename(getcwd()),
                'VOLUME'               => getcwd(),
                'PATH'                 => getenv('PATH'),
            ]
        );
        $process->run(function ($_, $buffer) {
            echo $buffer;
        });
    }
}
