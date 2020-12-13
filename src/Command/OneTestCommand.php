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

        return self::SUCCESS;
    }
}