<?php

namespace Helick\LocalServer\Subcommands;

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

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

        $hasStdin  = !posix_isatty(STDIN);
        $hasStdout = !posix_isatty(STDOUT);

        $command = sprintf(
            'cd %s; COMPOSE_PROJECT_NAME=%s VOLUME=%s docker-compose exec %s -u nobody php wp %s',
            'vendor/helick/local-server/docker',
            basename(getcwd()),
            getcwd(),
            $hasStdin || $hasStdout ? '-T' : '',
            implode(' ', $options)
        );

        passthru($command, $output);
    }
}
