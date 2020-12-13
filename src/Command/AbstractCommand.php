<?php


namespace App\Command;


use App\Service\Parser\ParserInterface;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Persistence\ObjectRepository;
use Symfony\Component\Console\Command\Command;

/**
 * Class AbstractCommand
 * @package App\Command
 */
abstract class AbstractCommand extends Command
{
    /**
     * @var ManagerRegistry
     */
    protected $managerRegistry;

    /**
     * @var ParserInterface|null
     */
    protected $parser;

    /**
     * AbstractCommand constructor.
     * @param ManagerRegistry $managerRegistry
     * @param ParserInterface|null $parser
     */
    public function __construct(
        ManagerRegistry $managerRegistry,
        ParserInterface $parser = null
    ) {
        parent::__construct();
        $this->managerRegistry = $managerRegistry;
        $this->parser = $parser;
    }

    /**
     * @return ObjectManager
     */
    protected function getManager(): ObjectManager
    {
        return $this->managerRegistry->getManager();
    }

    /**
     * @param string $repositoryClass
     * @return ObjectRepository
     */
    protected function getRepository(string $repositoryClass): ObjectRepository
    {
        return $this->managerRegistry->getRepository($repositoryClass);
    }
}