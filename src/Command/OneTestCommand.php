<?php


namespace App\Command;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class OneTestCommand
 * @package App\Command
 */
class OneTestCommand extends Command
{
    public const NAME = 'command:test';

    /**
     * @var string
     */
    protected $name;

    /**
     * OneTestCommand constructor.
     * @param string $nameUser
     */
    public function __construct($nameUser = 'vadym')
    {
        parent::__construct();
        $this->name = $nameUser;
    }

    protected function configure()
    {
        $this
            ->setName(self::NAME)
            ->setDescription('test command')
            ->addArgument('text', InputArgument::OPTIONAL, 'text', '')
        ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $text = $input->getArgument('text');
        if ($text) {
            $print = 'Text ' . $text;
        } else {
            $print = 'NO TEXT';
        }

        $output->writeln($print);
        $output->writeln('User: ' . $this->name);

        return self::SUCCESS;
    }
}