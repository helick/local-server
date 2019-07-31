<?php

namespace Helick\LocalServer;

use Composer\Command\BaseCommand;
use InvalidArgumentException;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class Command extends BaseCommand
{
    /**
     * Registered subcommands.
     *
     * @var array
     */
    private $subcommands = [
        'build'   => Subcommands\BuildSubcommand::class,
        'start'   => Subcommands\StartSubcommand::class,
        'stop'    => Subcommands\StopSubcommand::class,
        'destroy' => Subcommands\DestroySubcommand::class,
        'status'  => Subcommands\StatusSubcommand::class,
        'logs'    => Subcommands\LogsSubcommand::class,
        'cli'     => Subcommands\CliSubcommand::class,
    ];

    /**
     * @inheritDoc
     */
    protected function configure()
    {
        $this->setName('local-server')
             ->setDescription('Run the local server.')
             ->setDefinition([
                 new InputArgument('subcommand', InputArgument::REQUIRED, 'start, stop, destroy, status, logs, cli'),
                 new InputArgument('options', InputArgument::IS_ARRAY),
             ])
             ->setHelp(
                 <<<EOT
Run the local server.

Build the local server:
    build
Start the local server:
    start
Stop the local server:
    stop
Destroy the local server:
    destroy
View the local server status:
    status
View the local server logs:
    logs <service>      <service> can be nginx, php, mysql, elasticsearch
Run WP CLI command:
    cli -- <command>    eg: cli -- post list
EOT
             );
    }

    /**
     * @inheritDoc
     */
    public function isProxyCommand()
    {
        return true;
    }

    /**
     * @inheritDoc
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $subcommand = $input->getArgument('subcommand');

        if (!isset($this->subcommands[$subcommand])) {
            throw new InvalidArgumentException('Invalid subcommand given: ' . $subcommand);
        }

        $subcommandClass    = $this->subcommands[$subcommand];
        $subcommandInstance = new $subcommandClass($this->getApplication());

        $subcommandInstance($input, $output);
    }
}
