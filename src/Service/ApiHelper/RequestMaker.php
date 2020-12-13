<?php


namespace App\Service\ApiHelper;


use Symfony\Component\HttpClient\CurlHttpClient;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

/**
 * Class RequestMaker
 * @package App\Service\ApiHelper
 */
class RequestMaker
{
    public static function gatData(RequestInfo $requestInfo)
    {
        return self::request($requestInfo);
    }

    /**
     * @param RequestInfo $requestInfo
     * @return array
     *
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public static function request(RequestInfo $requestInfo): array
    {
        $client = new CurlHttpClient();

        return
            $client
                ->request(
                    $requestInfo->getMethod(),
                    $requestInfo->getUrl()
                )
                ->toArray();
    }
}