<?php


namespace App\Service\Parser;


use App\Service\ApiHelper\RequestInfo;
use App\Service\ApiHelper\RequestMaker;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Persistence\ObjectRepository;

/**
 * Class AbstractParser
 * @package App\Service\Parser
 */
abstract class AbstractParser implements ParserInterface
{
    /**
     * Endpoint to parse data is API
     *
     * @var string
     */
    protected $endpoint;

    /**
     * @var ManagerRegistry
     */
    protected $managerRegistry;

    /**
     * @var RequestInfo
     */
    protected $requestInfo;

    /**
     * @var string
     */
    protected $baseUrl;

    /**
     * @var array
     */
    protected $endpoints;

    /**
     * @var array
     */
    protected $options;

    /**
     * AbstractParser constructor.
     * @param ManagerRegistry $managerRegistry
     * @param string $kunaBaseUrl
     * @param array $kunaEndpoints
     */
    public function __construct(
        ManagerRegistry $managerRegistry,
        string $kunaBaseUrl,
        array $kunaEndpoints
    ) {
        $this->managerRegistry = $managerRegistry;
        $this->baseUrl = $kunaBaseUrl;
        $this->endpoints = $kunaEndpoints;
    }

    public abstract function parse();

    /**
     * @param RequestInfo $requestInfo
     * @param array $options
     * @return $this
     */
    public function setParameters(RequestInfo $requestInfo, array $options): self
    {
        $this->requestInfo = $requestInfo;
        $this->options = $options;

        return $this;
    }

    /**
     * @return RequestInfo|null
     */
    protected function updateRequestInfo(): ?RequestInfo
    {
        $endpoint = $this->endpoints[$this->endpoint] ?? null;
        if (!$endpoint) {
            return null;
        }

        return $this
            ->requestInfo
            ->createUrl($this->baseUrl, $endpoint['path'])
            ->setMethod($endpoint['method']);
    }

    /**
     * @return array
     */
    protected function getDataFromAPI(): array
    {
        if (!$requestInfo = $this->updateRequestInfo()) {
            return [];
        }

        return RequestMaker::gatData($requestInfo);
    }

    /**
     * @param string $key
     * @return mixed|null
     */
    protected function getOption(string $key)
    {
        return $this->options[$key] ?? null;
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