<?php

namespace Helick\LocalServer\Subcommands;

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;

final class CliSubcommand
{
    /**
     * The application instance.
     *
     * @var Application
     */
    private $application;

    /**
     * Create a subcommand instance.
     *
     * @param Application $application
     *
     * @return void
     */
    public function __construct(Application $application)
    {
        $this->application = $application;
    }

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

        $compose = new Process(
            sprintf('docker-compose exec -T -u nobody php /code/vendor/bin/wp %s', implode(' ', $options)),
            'vendor/helick/local-server/docker',
            [
                'COMPOSE_PROJECT_NAME' => basename(getcwd()),
                'VOLUME'               => getcwd(),
                'PATH'                 => getenv('PATH'),
            ]
        );
        $compose->run(function ($_, $buffer) {
            echo $buffer;
        });
    }
}
