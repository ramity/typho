<?php

namespace StockBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * StockSeries
 *
 * @ORM\Table(name="stock_series")
 * @ORM\Entity(repositoryClass="StockBundle\Repository\StockSeriesRepository")
 */
class StockSeries
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="time", type="datetime", unique=true)
     */
    private $time;

    /**
     * @var string
     *
     * @ORM\Column(name="open", type="decimal", precision=10, scale=0)
     */
    private $open;

    /**
     * @var string
     *
     * @ORM\Column(name="high", type="decimal", precision=10, scale=0)
     */
    private $high;

    /**
     * @var string
     *
     * @ORM\Column(name="low", type="decimal", precision=10, scale=0)
     */
    private $low;

    /**
     * @var string
     *
     * @ORM\Column(name="close", type="decimal", precision=10, scale=0)
     */
    private $close;

    /**
     * @var int
     *
     * @ORM\Column(name="volume", type="integer")
     */
    private $volume;

    /**
     * @ORM\ManyToOne(targetEntity="Stock", inversedBy="stockSeries")
     * @ORM\JoinColumn(name="stock_id", referencedColumnName="id")
     */
    private $stock;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set time
     *
     * @param \DateTime $time
     *
     * @return StockSeries
     */
    public function setTime($time)
    {
        $this->time = $time;

        return $this;
    }

    /**
     * Get time
     *
     * @return \DateTime
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Set open
     *
     * @param string $open
     *
     * @return StockSeries
     */
    public function setOpen($open)
    {
        $this->open = $open;

        return $this;
    }

    /**
     * Get open
     *
     * @return string
     */
    public function getOpen()
    {
        return $this->open;
    }

    /**
     * Set high
     *
     * @param string $high
     *
     * @return StockSeries
     */
    public function setHigh($high)
    {
        $this->high = $high;

        return $this;
    }

    /**
     * Get high
     *
     * @return string
     */
    public function getHigh()
    {
        return $this->high;
    }

    /**
     * Set low
     *
     * @param string $low
     *
     * @return StockSeries
     */
    public function setLow($low)
    {
        $this->low = $low;

        return $this;
    }

    /**
     * Get low
     *
     * @return string
     */
    public function getLow()
    {
        return $this->low;
    }

    /**
     * Set close
     *
     * @param string $close
     *
     * @return StockSeries
     */
    public function setClose($close)
    {
        $this->close = $close;

        return $this;
    }

    /**
     * Get close
     *
     * @return string
     */
    public function getClose()
    {
        return $this->close;
    }

    /**
     * Set volume
     *
     * @param integer $volume
     *
     * @return StockSeries
     */
    public function setVolume($volume)
    {
        $this->volume = $volume;

        return $this;
    }

    /**
     * Get volume
     *
     * @return int
     */
    public function getVolume()
    {
        return $this->volume;
    }

    public function setStock($stock)
    {
      $this->stock = $stock;
      return $this;
    }

    public function getStock()
    {
      return $this->stock;
    }
}
