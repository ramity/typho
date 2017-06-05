<?php

namespace StockBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;


class MainController extends Controller
{
  /**
   * @Route("/", name="main_index")
   * @Method("GET")
   */
  public function indexAction()
  {
    $em = $this->getDoctrine()->getManager();

    $api = $this->get('ApiController');

    //$stockData = $api->getStockData("TIME_SERIES_INTRADAY", "GOOG", "1min");
    $trendData = $api->getTrendData("2012-06-04+2017-06-04", "WEEK", "en-US", "GOOG");

    //print_r($stockData);
    print_r($trendData);

    return $this->render('main/index.html.twig', array());
  }
}
