<?php


namespace App\Service\Parser;


use App\Service\ApiHelper\RequestInfo;

/**
 * Interface ParserInterface
 * @package App\Service\Parser
 */
interface ParserInterface
{
    /**
     * Parse data from API
     *
     * @return void
     */
    public function parse();

    /**
     * Parameters for generating request to API
     *
     * @param RequestInfo $requestInfo
     * @param array $options
     * @return $this
     */
    public function setParameters(RequestInfo $requestInfo, array $options);
}