<?php

namespace Helick\LocalServer\Subcommands;

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;

abstract class Subcommand
{
    /**
     * The subcommand working directory.
     *
     * @var string
     */
    const CWD = 'vendor/helick/local-server/docker';

    /**
     * The application instance.
     *
     * @var Application
     */
    protected $application;

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
    abstract public function __invoke(InputInterface $input, OutputInterface $output): void;

    /**
     * @param string $command
     *
     * @return Process
     */
    protected function runProcess(string $command): Process
    {
        $process = new Process(
            $command,
            static::CWD,
            $this->compileEnvironmentVariables()
        );

        $process->setTimeout(0);

        $process->run(function ($_, $buffer) {
            echo $buffer;
        });

        return $process;
    }

    /**
     * @return array
     */
    protected function compileEnvironmentVariables(): array
    {
        return [
            'COMPOSE_PROJECT_NAME' => basename(getcwd()),
            'VOLUME'               => getcwd(),
            'PATH'                 => getenv('PATH'),

            // Windows-specific
            'TEMP'                 => getenv('TEMP'),
            'SystemRoot'           => getenv('SystemRoot'),
        ];
    }
}
