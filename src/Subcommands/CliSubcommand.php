<?php

namespace Helick\LocalServer\Subcommands;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class CliSubcommand extends Subcommand
{
    /**
     * The process' command string.
     *
     * @var string
     */
    const COMMAND = 'docker-compose exec -T -u nobody php vendor/bin/wp %s';

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

        if (!$this->hasUrlOption($options)) {
            $options[] = sprintf('--url=http://%s.localtest.me/', basename(getcwd()));
        }

        $this->runProcess(sprintf(static::COMMAND, implode(' ', $options)));
    }

    /**
     * @param array $options
     *
     * @return bool
     */
    protected function hasUrlOption(array $options): bool
    {
        foreach ($options as $option) {
            if (strpos($option, '--url=') === 0) {
                return true;
            }
        }

        return false;
    }
}
