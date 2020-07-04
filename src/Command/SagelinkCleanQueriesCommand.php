<?php
namespace App\Command;

use App\Service\CleanClientQueryService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


class SagelinkCleanQueriesCommand extends Command
{
    private $cleanUp;

    public function __construct(CleanClientQueryService $cleanUp
    )
    {
        parent::__construct();
        $this->cleanUp = $cleanUp;

    }

    protected function configure(): void
    {
        $this->setName('sagelink:cleanup:queries');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Start Clean');
        $this->cleanUp->CleanQueries();
        $output->writeln('Finished Clean');

        return 0;
    }
}