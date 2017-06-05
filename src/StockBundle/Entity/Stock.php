<?php

namespace StockBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Stock
 *
 * @ORM\Table(name="stock")
 * @ORM\Entity(repositoryClass="StockBundle\Repository\StockRepository")
 */
class Stock
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
     * @var string
     *
     * @ORM\Column(name="symbol", type="string", length=255, unique=true)
     */
    private $symbol;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updateTime", type="datetime")
     */
    private $updateTime;

    /**
     * @ORM\OneToMany(targetEntity="StockSeries", mappedBy="stock")
     */
    private $stockSeries;

    /**
     * @ORM\ManyToMany(targetEntity="Trend", inversedBy="stocks")
     * @ORM\JoinTable(name="stock_trends")
     */
    private $trends;

    public function __construct()
    {
      $this->stockSeries = new ArrayCollection();
      $this->trends = new ArrayCollection();
    }

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
     * Set symbol
     *
     * @param string $symbol
     *
     * @return Stock
     */
    public function setSymbol($symbol)
    {
        $this->symbol = $symbol;

        return $this;
    }

    /**
     * Get symbol
     *
     * @return string
     */
    public function getSymbol()
    {
        return $this->symbol;
    }

    /**
     * Set updateTime
     *
     * @param \DateTime $updateTime
     *
     * @return Stock
     */
    public function setUpdateTime($updateTime)
    {
        $this->updateTime = $updateTime;

        return $this;
    }

    /**
     * Get updateTime
     *
     * @return \DateTime
     */
    public function getUpdateTime()
    {
        return $this->updateTime;
    }

    /**
     * Set stockSeries
     *
     * @param string $stockSeries
     *
     * @return Stock
     */
    public function setStockSeries($stockSeries)
    {
        $this->stockSeries = $stockSeries;

        return $this;
    }

    /**
     * Get stockSeries
     *
     * @return string
     */
    public function getStockSeries()
    {
        return $this->stockSeries;
    }

    /**
     * Set trends
     *
     * @param string $trends
     *
     * @return Stock
     */
    public function setTrends($trends)
    {
        $this->trends = $trends;

        return $this;
    }

    /**
     * Get trends
     *
     * @return string
     */
    public function getTrends()
    {
        return $this->trends;
    }
}
