<?php
$con=mysqli_connect("localhost","goaecoto_website","gJy85P)4[S","goaecoto_website");
$id=$_GET['id'];
$nonceKey=$_GET['nonceKey'];

$getBooking = "SELECT * FROM `JB_Traveller_Details` WHERE `Booking_Id` = $id";
			
			$result = mysqli_query($con, $getBooking);
			
			$getBooking = mysqli_fetch_array($result, MYSQLI_ASSOC);
			
			$processPaymentLink = 'http://'.$_SERVER['HTTP_HOST'].'processForm/process.php?action=process&retry=1';
			echo "<body onLoad=\"document.forms['payu_form'].submit();\">\n";
		//echo "<body>\n";
		echo "<center><h2>Please wait, your order is being processed and you";
		echo " will be redirected to the Payment Partner.</h2></center>\n";
		echo "<form method=\"post\" name=\"payu_form\" ";
		echo "action=\"$processPaymentLink\">\n";
		
			echo "<input type=\"hidden\" name=\"key\" value=\"$merchant_key\"/>\n";
			echo "<input type=\"hidden\" name=\"hash\" value=\"$hash\"/>\n";
			echo "<input type=\"hidden\" name=\"txnid\" value=\"$txnid\"/>\n";
			echo "<input type=\"hidden\" name=\"amount\" value=\"$total_pay\"/>\n";
			echo "<input type=\"hidden\" name=\"firstname\" value=\"$txt_name\"/>\n";
			echo "<input type=\"hidden\" name=\"email\" value=\"$txt_p_email\"/>\n";
			echo "<input type=\"hidden\" name=\"phone\" value=\"$txt_mobile_no\"/>\n";
			echo "<input type=\"hidden\" name=\"productinfo\" value=\"$package_name\"/>\n";
			echo "<input type=\"hidden\" name=\"surl\" value=\"$success_url\"/>\n";
			echo "<input type=\"hidden\" name=\"furl\" value=\"$failure_url\"/>\n";
			echo "<input type=\"hidden\" name=\"service_provider\" value=\"payu_paisa\"/>\n";
			echo "<input type=\"hidden\" name=\"curl\" value=\"$cancel_url\"/>\n";
			echo "<input type=\"hidden\" name=\"udf1\" value=\"$invoice\"/>\n";
		
		echo "<center><br/><br/>If you are not automatically redirected to ";
		echo "paypal within 5 seconds...<br/><br/>\n";
		echo "<input type=\"submit\" value=\"Click Here\"></center>\n";
		
		echo "</form>\n";
		echo "</body></html>\n";
?>