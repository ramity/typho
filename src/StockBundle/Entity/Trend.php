<?php

namespace StockBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Trend
 *
 * @ORM\Table(name="trend")
 * @ORM\Entity(repositoryClass="StockBundle\Repository\TrendRepository")
 */
class Trend
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
     * @ORM\Column(name="input", type="string", length=255, unique=true)
     */
    private $input;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updateTime", type="datetime")
     */
    private $updateTime;

    /**
     * @ORM\OneToMany(targetEntity="TrendSeries", mappedBy="trend")
     */
    private $trendSeries;

    /**
     * @ORM\ManyToMany(targetEntity="Stock", mappedBy="trends")
     */
    private $stocks;

    public function __construct()
    {
      $this->trendSeries = new ArrayCollection();
      $this->stocks = new ArrayCollection();
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
     * Set input
     *
     * @param string $input
     *
     * @return Trend
     */
    public function setInput($input)
    {
        $this->input = $input;

        return $this;
    }

    /**
     * Get input
     *
     * @return string
     */
    public function getInput()
    {
        return $this->input;
    }

    /**
     * Set updateTime
     *
     * @param \DateTime $updateTime
     *
     * @return Trend
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
     * Set trendSeries
     *
     * @param string $trendSeries
     *
     * @return Trend
     */
    public function setTrendSeries($trendSeries)
    {
        $this->trendSeries = $trendSeries;

        return $this;
    }

    /**
     * Get trendSeries
     *
     * @return string
     */
    public function getTrendSeries()
    {
        return $this->trendSeries;
    }
}
