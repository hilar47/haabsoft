<?php

$dollarValue=convert_currency('1000', 'USD', 'INR');
echo 'Actual Rate '.$dollarValue."";
echo 'Round Figure '.$con_dollor = round($dollarValue,2);

function convert_currency($amount, $from, $to)
{
  $url = 'http://finance.yahoo.com/d/quotes.csv?e=.csv&f=sl1d1t1&s='. $from . $to .'=X';
  $handle = @fopen($url, 'r');
  if ($handle) 
  {
      $result = fgets($handle, 4096);
      fclose($handle);
  }
  $allData = explode(',',$result); 
  $dollarValue = $allData[1];
        
  return $dollarValue;
}