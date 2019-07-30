<?php

namespace Helick\LocalServer\Subcommands;

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;

final class StartSubcommand
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
        $output->writeln('Starting...');

        $compose = new Process('docker-compose up -d', 'vendor/helick/local-server/docker', [
            'COMPOSE_PROJECT_NAME' => basename(getcwd()),
            'VOLUME'               => getcwd(),
            'PATH'                 => getenv('PATH'),
        ]);
        $compose->setTimeout(0);
        $failed = $compose->run(function ($_, $buffer) {
            echo $buffer;
        });

        if ($failed) {
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
