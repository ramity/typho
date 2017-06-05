<?php

namespace StockBundle\Service;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ApiController extends Controller
{
  private $alphavantageKey;
  private $caBundlePath;

  public function __construct($options)
  {
    $this->alphavantageKey = $options['alphavantage_key'];
    $this->caBundlePath = $options['ca_bundle_path'];
  }

  public function getStockData($function, $symbol, $interval, $alphavantageKey = null)
  {
    if($apiKey == null)
    {
      $alphavantageKey = $this->alphavantageKey;
    }

    $url = "http://www.alphavantage.co/query?function=$function&symbol=$symbol&interval=$interval&apikey=$alphavantageKey";
    $obj = json_decode(file_get_contents($url), true);
    return $obj;
  }

  public function getTrendData($time, $resolution, $locale, $searchTerm)
  {
    $url = 'trends.google.com/trends/api/widgetdata/multiline?req=%7B"time":"2012-06-04+2017-06-04","resolution":"WEEK","locale":"en-US","comparisonItem":%5B%7B"geo":%7B%7D,"complexKeywordsRestriction":%7B"keyword":%5B%7B"type":"BROAD","value":"GOOG"%7D%5D%7D%7D%5D,"requestOptions":%7B"property":"","backend":"IZG","category":0%7D%7D&token=APP6_UEAAAAAWTWSbhzJGzoG8AYylbNYNESp9bhncsr3&tz=300';
    $agent="Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36";

    $header=[];
    $header[] = "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8";
    $header[] = "Connection: keep-alive";
    $header[] = "Keep-Alive: 300";

    //$time = "2012-06-04+2017-06-04";
    //$resolution = "WEEK";
    //$locale = "en-US";
    //$searchTerm = "GOOG";

    $url = "https://trends.google.com/trends/api/widgetdata/multiline?req=%7B\"time\":\"$time\",\"resolution\":\"$resolution\",\"locale\":\"$locale\",\"comparisonItem\":%5B%7B\"geo\":%7B%7D,\"complexKeywordsRestriction\":%7B\"keyword\":%5B%7B\"type\":\"BROAD\",\"value\":\"$searchTerm\"%7D%5D%7D%7D%5D,\"requestOptions\":%7B\"property\":\"\",\"backend\":\"IZG\",\"category\":0%7D%7D&token=APP6_UEAAAAAWTWSbhzJGzoG8AYylbNYNESp9bhncsr3&tz=300";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_VERBOSE, true);
    curl_setopt($ch, CURLOPT_USERAGENT, $agent);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_AUTOREFERER, false);
    curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
    curl_setOpt($ch, CURLOPT_CAINFO, $this->caBundlePath);

    $output = curl_exec($ch);

    print_r($output);

    $update = substr($output, 6);
    $obj = json_decode($update);

    echo "<pre>";
    print_r($obj);
    echo "</pre>";

    //print_r(curl_getinfo($ch, CURLINFO_HTTP_CODE));

    curl_close($ch);

    return $obj;
  }
}
