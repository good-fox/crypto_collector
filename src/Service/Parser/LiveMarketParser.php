<?php


namespace App\Service\Parser;


use App\Entity\BtcToUsdEntity;

/**
 * Class LiveMarketParser
 * @package App\Service\Parser
 */
class LiveMarketParser extends AbstractParser
{
    /**
     * Endpoint to parse data is API
     */
    protected $endpoint = 'live_market';

    /**
     * Method to pars data live market
     */
    public function parse()
    {
        $data = $this->getDataFromAPI()[0];

        $entity = new BtcToUsdEntity();
        $entity
            ->setPrice($data[7])
            ->setTime(time());

        $manager = $this->getManager();
        $manager->persist($entity);
        $manager->flush();
    }
}