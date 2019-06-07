<?php

namespace Helick\LocalServer\Subcommands;

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;

final class DestroySubcommand
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
        $service = $input->getArgument('options')[0];

        $compose = new Process('docker-compose logs -f ' . $service, 'vendor/helick/local-server/docker', [
            'HELICK_PROJECT_NAME' => basename(getcwd()),
            'VOLUME'              => getcwd(),
        ]);
        $compose->setTimeout(0);
        $compose->run(function ($_, $buffer) {
            echo $buffer;
        });
    }
}
