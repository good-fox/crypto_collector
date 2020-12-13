<?php


namespace App\Service\ApiHelper;


/**
 * Class RequestInfo
 * @package App\Service\ApiHelper
 */
class RequestInfo
{
    /**
     * @var array
     */
    protected $requestInfo;

    /**
     * @var string
     */
    protected $method;

    /**
     * @var string|null
     */
    protected $url;

    /**
     * RequestInfo constructor.
     * @param array $requestInfo
     * @param string|null $url
     * @param string $method
     */
    public function __construct(
        array $requestInfo = [],
        ?string $url = null,
        string $method = 'GET'
    ) {
        $this->requestInfo = $requestInfo;
        $this->url = $url;
        $this->method = $method;
    }

    /**
     * @param array $requestInfo
     * @param string|null $url
     * @param string $method
     * @return RequestInfo
     */
    public static function create(array $requestInfo, ?string $url = null, string $method = 'GET'): RequestInfo
    {
        return new self($requestInfo, $url, $method);
    }

    /**
     * @return array
     */
    public function getRequestInfo(): array
    {
        return $this->requestInfo;
    }

    /**
     * @param string $baseUrl
     * @param string $path
     * @param string|null $key
     * @return $this
     */
    public function createUrl(string $baseUrl, string $path, ?string $key = null): self
    {
        $data = $this->requestInfo;

        $path = str_replace(array_keys($data), $data, $path);
        $url = $baseUrl . $path;

        $this->url = $url;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * @param string|null $method
     * @return $this
     */
    public function setMethod(?string $method): self
    {
        $this->method = $method ?? 'GET';

        return $this;
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }
}