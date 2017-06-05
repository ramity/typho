<?php

namespace StockBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * TrendSeries
 *
 * @ORM\Table(name="trend_series")
 * @ORM\Entity(repositoryClass="StockBundle\Repository\TrendSeriesRepository")
 */
class TrendSeries
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
     * @var int
     *
     * @ORM\Column(name="searchPercent", type="integer")
     */
    private $searchPercent;

    /**
     * @ORM\ManyToOne(targetEntity="Trend", inversedBy="trendSeries")
     * @ORM\JoinColumn(name="trend_id", referencedColumnName="id")
     */
    private $trend;

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
     * @return TrendSeries
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
     * Set searchPercent
     *
     * @param integer $searchPercent
     *
     * @return TrendSeries
     */
    public function setSearchPercent($searchPercent)
    {
        $this->searchPercent = $searchPercent;

        return $this;
    }

    /**
     * Get searchPercent
     *
     * @return int
     */
    public function getSearchPercent()
    {
        return $this->searchPercent;
    }

    public function setTrend($trend)
    {
      $this->trend = $trend;
      return $this;
    }

    public function getTrend()
    {
      return $this->trend;
    }
}
