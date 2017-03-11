<?php 
		//echo "Here";
		$from_Currency = $_POST['from'];
		$to_Currency = $_POST['to'];
		$amount = $_POST['amt'];
		//echo "<br/>From Currency :- ".$from_Currency;
		//echo "<br/>To Currency :- ".$to_Currency;
		//echo "<br/>Amount :- ".$amount;
		$amount = urlencode($amount);
		$from_Currency = urlencode($from_Currency);
		$to_Currency = urlencode($to_Currency);
		//$get = file_get_contents("https://www.google.com/finance/converter?a=$amount&from=$from_Currency&to=$to_Currency");


$url = "https://www.google.com/finance/converter?a=$amount&from=$from_Currency&to=$to_Currency";
$ch = curl_init();
curl_setopt ($ch, CURLOPT_URL, $url);
curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 5);
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
$contents = curl_exec($ch);
if (curl_errno($ch)) {
  echo curl_error($ch);
  echo "\n<br />";
  $contents = '';
} else {
  curl_close($ch);
}

if (!is_string($contents) || !strlen($contents)) {
echo "Failed to get contents.";
$contents = '';
}

$get = $contents;


		$get = explode("<span class=bld>",$get);
		$get = explode("</span>",$get[1]);  
		$converted_amount = preg_replace("/[^0-9\.]/", null, $get[0]);
		//echo "<br/> Converted amount :- ".$converted_amount;
		echo json_encode(round($converted_amount));
	
?>