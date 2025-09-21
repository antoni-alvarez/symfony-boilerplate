<?php

declare(strict_types=1);

namespace App\Adapter\Framework\Command;

use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Throwable;

#[AsCommand(
    name: 'app:test',
    description: 'Example test command',
)]
final class TestCommand extends Command
{
    public function __construct(
        private readonly LoggerInterface $logger,
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        try {
            $io->info('Testing output');
            $this->logger->info('[TestCommand] Testing log');
        } catch (Throwable $t) {
            $io->error('Error in test command: ' . $t->getMessage());
            $this->logger->error('[TestCommand] Error in test command');

            return Command::FAILURE;
        }

        $io->success('Test finished successfully.');

        return Command::SUCCESS;
    }
}
