<?php
namespace App\Command;

use App\Service\OpnSenseStatusService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


class SagelinkUpdateFirmwareVsCommand extends Command
{
    private $opnStatus;

    public function __construct(OpnSenseStatusService $opnSense
    )
    {
        parent::__construct();
        $this->opnStatus = $opnSense;

    }

    protected function configure(): void
    {
        $this->setName('sagelink:firmware:update');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Writing Data');
        $this->opnStatus->updateFirmwareVersion();
        $output->writeln('Finished');

        return 0;
    }
}