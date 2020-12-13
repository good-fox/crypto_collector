<?php


namespace App\Command;


use App\Service\ApiHelper\RequestInfo;
use App\Service\Parser\LiveMarketParser;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class LiveMarketCommand
 * @package App\Command
 */
class LiveMarketCommand extends AbstractCommand
{
    public const NAME = 'crypto:market:live';

    /**
     * LiveMarketCommand constructor.
     * @param ManagerRegistry $managerRegistry
     * @param LiveMarketParser $parser
     */
    public function __construct(
        ManagerRegistry $managerRegistry,
        LiveMarketParser $parser
    ) {
        parent::__construct($managerRegistry, $parser);
    }

    protected function configure()
    {
        $this
            ->setName(self::NAME)
            ->setDescription('Parse data to live market price')
            ->addArgument('market', InputArgument::OPTIONAL, 'market symbol, example: btcuah', 'btcuah')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $market = $input->getArgument('market');

        while (true) {
            $this
                ->parser
                ->setParameters(RequestInfo::create(
                    [
                        'market' => $market
                    ]
                ),
                    [
                        'market' => $market
                    ]
                )
                ->parse();

            $output->writeln('Time: ' . date('d-m-y h:i:s') . ' --> ' . time());
            sleep(1);
        }

        return self::SUCCESS;
    }
}