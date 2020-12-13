<?php


namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * Class BtcToUsdEntity
 * @package App\Entity
 * @ORM\Entity()
 * @ORM\Table(name="btc_usd")
 */
class BtcToUsdEntity
{
    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var float
     *
     * @ORM\Column(type="float")
     */
    protected $price;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    protected $time;

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     * @return $this
     */
    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return int
     */
    public function getTime(): int
    {
        return $this->time;
    }

    /**
     * @param int $time
     * @return $this
     */
    public function setTime(int $time): self
    {
        $this->time = $time;

        return $this;
    }
}