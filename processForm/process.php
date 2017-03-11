<!DOCTYPE>
<html>
<head>

<title>Confirmation Page</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
</head>

<?php

	//echo "<pre>POST DATA ";
	//print_r($_POST);
	//echo "Get Data";
	//print_r($_GET);
	//echo "</pre>";
	
	
//require_once("library.php"); // include the library file
define('EMAIL_ADD', 'dmsservicesgoa@gmail.com'); // define any notification email
define('PAYPAL_EMAIL_ADD', 'haabsoft@gmail.com'); // facilitator email which will receive payments change this email to a live paypal account id when the site goes live
require_once("paypal_class.php");

// Include PHP Mailer class file
require_once "phpmailer/class.phpmailer.php";
$p 				= new paypal_class(); // paypal class
$p->admin_mail 	= EMAIL_ADD; // set notification email
$action 		= $_REQUEST["action"];
//$retry			= $_REQUEST["retry"];
//echo $action;
extract($_POST);
//exit;
/*$txt_name = $_POST['txt_name'];
$txt_p_email = $_POST['txt_p_email'];
$txt_landline_no = $_POST['txt_landline_no'];
$txt_mobile_no = $_POST['txt_mobile_no'];
$txt_state_city = $_POST['txt_state_city'];
$txt_arrival_date = $_POST['txt_arrival_date'];
$txt_departure_date = $_POST['txt_departure_date'];
$txt_instructions = $_POST['txt_instructions'];*/

$message = '';
$message_description = '';
$message_container_class = '';

$con = mysqli_connect("localhost","root","root","haabsoft");
	
if (!empty($_POST) || !empty($_REQUEST)){
	
	switch($action){
	case "process":
	/*
	if( !isset($retry) &&  $retry == false){
		$sql_booking_query = "INSERT INTO JB_Booking ( Order_date, invoice, Package_name, package_description, Package_mode, package_type, No_of_pax, currency_code, Per_pax_price, Total_price, Status) VALUES (NOW(), $invoice, '$package_name', '$package_description', '$package_mode', '$package_type', '$no_of_pax', '$payment_option', '$per_pax_price','$total_pay','Under Process')";

		$con->query($sql_booking_query);
		/*
		printf ("New Record has id %d.\n", $con->insert_id);*/
/*
		$sql_traveller_query = "INSERT INTO JB_Traveller_Details (Booking_Id, Contact_name, Email_Id, Landline_no, Mobile_no,City, Booking_date, Departure_date, Instruction_query) VALUES ($con->insert_id,'$txt_name', '$txt_p_email','$txt_landline_no','$txt_mobile_no','$txt_state_city','$booking_date','$txt_departure_date','$txt_instructions')";

		$con->query($sql_traveller_query);
	}
	*/
			//echo "inhere";
			
			//print_r($con);
			//Add an entry in database for the post id created.
			if(!empty($_POST) && isset($_POST)){

				$sql_query = "INSERT INTO payments ( txnid, payment_amount, payment_status, commission_status, itemid, createdtime) VALUES (".$_POST['invoice'].",".$_POST['total_pay'].", 'Draft', false, ".$_POST['post_id'].", NOW())";
//echo $sql_query;
				$con->query($sql_query);
				$message_container_class = 'alert-success';
				$message = 'Thank you We are redirecting to Payment Gateway!';
				$message_description = '';
				//exit();
			}
			else{
				$message_container_class = 'alert-danger';
				$message = 'Oops!!! Something went wrong. Please go to Homepage';
			}
	
	//mysqli_close($con);
	$message_container_class = 'alert-success';
	$message = 'Thank you We are redirecting to Payment Gateway!';
	$message_description = '';
	
	// Direct to Payment Gateway Paypal or PAYU Money
	
	// Send to Paypal
	if($payment_option == "USD"){
		$this_script = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
			$p->add_field('sandbox', '1');
			$p->add_field('business', PAYPAL_EMAIL_ADD); // Call the facilitator eaccount
			$p->add_field('cmd', $_POST["cmd"]); // cmd should be _cart for cart checkout
			$p->add_field('upload', '1');
			$p->add_field('return', $this_script.'?action=success&txn='.$_POST['invoice']); // return URL after the transaction got over
			$p->add_field('cancel_return', $this_script.'?action=cancel&invoice=' . $invoice); // cancel URL if the trasaction was cancelled during half of the transaction
			$p->add_field('notify_url', $this_script.'?action=ipn'); // Notify URL which received IPN (Instant Payment Notification)
			$p->add_field('currency_code', $_POST["payment_option"]);
			$p->add_field('invoice', $_POST["invoice"]);
			//$p->add_field('item_name', $_POST["package_name"]);
			$p->add_field('item_number', $_POST["post_id"]);
			//$p->add_field('quantity_1', $_POST["no_of_pax"]);
			$p->add_field('amount', $_POST['total_pay']);
			//$p->add_field('first_name', $_POST["txt_name"]);
			//$p->add_field('last_name', $_POST["txt_name"]);
			//$p->add_field('address1', $_POST["txt_state_city"]);
			//$p->add_field('city', $_POST["txt_state_city"]);
			//$p->add_field('state', $_POST["txt_state_city"]);
			//$p->add_field('country', "India");
			//$p->add_field('zip', "403707");
			//$p->add_field('post_id', $_POST["post_id"]);
			$p->submit_paypal_post(); // POST it to paypal
			//$p->dump_fields(); // Show the posted values for a reference, comment this line before app goes live
	} 
	
	break;
	
	case "success":
		$message = '';
		$message_container_class = '';
			//echo "I am in success";
		//$SALT = "GQs7yium";
		//if(!empty($_POST)){
			
			//echo "<pre>";
			//print_r($_POST);
			//echo "</pre>";
			//exit;
			// Verify encryption using sha512 after transaction is done and received data
			
			/*$hashSequence = "key|txnid|total_pay|package_name|txt_name|txt_p_email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";*/
			
		    /*$hash_string .= $SALT;
		    //$hash_string .= $_POST['status'];
		    $hashSequence = "|status|udf10|udf9|udf8|udf7|udf6|udf5|udf4|udf3|udf2|udf1|email|firstname|productinfo|amount|txnid|key";
		    $hashVarsSeq = explode('|', $hashSequence);	
			foreach($hashVarsSeq as $hash_var) {
			  $hash_string .= '|';
		      $hash_string .= isset($_POST[$hash_var]) ? $_POST[$hash_var] : '';
		      
		    }*/
		    
		    //$hash_string = $hashSequence;

		    //$hash = strtolower(hash('sha512', $hash_string));
		    $payment_status_message = "";
		    $txnid = "";
		    $to_email = "";
		    $customer_name = "";
		    $invoice = "";
		    $productinfo = "";
		    $amount = "";
		    
		    if (isset($_POST['invoice']) && !empty($_POST['invoice'])) {
				// Store Paypal Variables
				$payment_status_message = "";
			    $txnid = $_POST['txn_id'];
			    $to_email = $_POST['payer_email'];
			    //$customer_name = $_POST['first_name'];
			    $invoice = $_POST['invoice'];
			    //$productinfo = $_POST['item_name'];
			    $amount = $_POST['payment_gross'];
			    $status = $_POST['payment_status'];
			    
			    //$payment_status_message  = "Payment ID - ". $_POST['mihpayid'] . " | ";
				$payment_status_message .= "Status - ". $_POST['payment_status'] . " | ";
				$payment_status_message .= "Txn ID - ". $_POST['txn_id'] . " | ";
				$payment_status_message .= "PG TYPE - ". $_POST['payment_type'] . " | ";
			}
			$txn = $_REQUEST['txn'];
			//echo $txn;
				
			//Based on the status update the payment table
			$update_payment = "UPDATE `payments` SET `payment_status` = 'publish' WHERE `txnid` = $txn";
			//echo $update_payment;
			$con->query($update_payment);
			
			//Update post status
			$booking_record = "SELECT * FROM `payments` WHERE `txnid` = $txn";
			
			$booking_result = mysqli_query($con, $booking_record);
			
			$booking_result = mysqli_fetch_array($booking_result, MYSQLI_ASSOC);
			//echo '<pre>';
			//print_r($booking_result);
			//echo '<pre>';
			$post_id = $booking_result['itemid'];
			
			$update_payment = "UPDATE `wp_posts` SET `post_status` = 'publish' WHERE `ID` = $post_id";
			//echo $update_payment;
			$con->query($update_payment);
			
			//exit;
			//update the booking status and also send email if required.
			/*
			$booking_record = "SELECT * FROM `JB_Booking` WHERE `txn_id` = '$txnid'";
			
			$booking_result=mysqli_query($con,$booking_record);
			
			$booking_result = mysqli_fetch_array($booking_result, MYSQLI_ASSOC);
			//echo '<pre>';
			//print_r($booking_result);
			//echo '/<pre>';
			$order_id = $booking_result['ID'];
			
			
			
			
			
			$traveller_record = "SELECT * FROM `JB_Traveller_Details` WHERE `Booking_Id` = $order_id";
			
			
			$result=mysqli_query($con,$traveller_record);
			
			$traveller_record = mysqli_fetch_array($result, MYSQLI_ASSOC);
			
			$customer_name = $traveller_record['Contact_name'];
			
			$subject = "Your Jungle Book Trip #$invoice is Booked: Goaecotourism.com";
			$txt = "<html><head></head>";
			$txt .= "<body style=\"\">";
			
			$txt .= "<p>Dear $customer_name </p>";
			$txt .= "<h3>Thank you for choosing to book with JUNGLE BOOK. </h3>";
			$txt .= "<p>Confirmed receipt of your booking as follows:</p>";
			$txt .= "<div style=\"margin:0 auto; width:100%\">";
			$txt .= "<table style=\"background: #fff; padding: 20px; border: 6px solid #ededed; width: 100%\" cellspacing=\"5\" cellpadding=\"5\" align=\"center\">";
			$txt .= "<tbody>";
			$txt .= "<tr>";
			$txt .= "<td colspan=\"4\" style=\"border-bottom: 2px solid #ccc;\"><strong>YOUR BOOKING DETAILS</strong> <td>";
			$txt .= "</tr>";
			
			$txt .= "<tr>";
			$txt .= "<td>Booking Reference No.</td>";
			$txt .= "<td>$invoice</td>";
			$txt .= "<td>Booking Status</td>";
			$txt .= "<td>Not Confirmed</td>";
			$txt .= "</tr>";
			
			$status = $_POST['status'];
			
			$txt .= "<tr>";
			$txt .= "<td>Transaction No.</td>";
			$txt .= "<td>$txnid</td>";
			$txt .= "<td>Payment Status</td>";
			$txt .= "<td>$status</td>";
			$txt .= "</tr>";
			
			$txt .= "<tr>";
			$txt .= "<td colspan=\"4\" style=\"border-bottom: 2px solid #ccc;\"><strong>YOUR TRIP DETAILS</strong> <td>";
			$txt .= "</tr>";
			
			$currency_code = $booking_result['currency_code'];
			
			$txt .= "<tr>";
			$txt .= "<td>Package Details</td>";
			$txt .= "<td>$productinfo</td>";
			$txt .= "<td>Amount Paid</td>";
			$txt .= "<td>$currency_code $amount</td>";
			$txt .= "</tr>";
			
			$txt .= "<tr>";
			$txt .= "<td>Journey/Arrival Date</td>";
			$txt .= "<td>".date('d M Y',strtotime($traveller_record['Booking_date']))."</td>";
			$txt .= "<td>Instructions/Query</td>";
			$txt .= "<td>".$traveller_record['Instruction_query']. "</td>";
			$txt .= "</tr>";
			
			$txt .= "<tr>";
			$txt .= "<td colspan=\"4\" style=\"border-bottom: 2px solid #ccc;\"><strong>YOUR CONTACT DETAILS</strong> <td>";
			$txt .= "</tr>";
			
			$txt .= "<tr>";
			$txt .= "<td>Name </td>";
			$txt .= "<td>$customer_name</td>";
			$txt .= "<td>Email </td>";
			$txt .= "<td>".$traveller_record['Email_id']."</td>";
			$txt .= "</tr>";
			
			$txt .= "<tr>";
			$txt .= "<td>Phone </td>";
			$txt .= "<td>".$traveller_record['Mobile_no']." / ".$traveller_record['Landline_no']."</td>";
			$txt .= "<td>Address </td>";
			$txt .= "<td>".$traveller_record['City']."</td>";
			$txt .= "</tr>";
			
			$txt .= "</tbody>";
			$txt .= "</table>";
			$txt .= "</div>";
			
			$txt .= "<br /><br /><br />Best Regards <br />";
			$txt .= "Team Jungle Book Goa";
			
			//$txt .= $update_jb_booking;
			
			$txt .= "<br /> <br /><small>( If you are receiving the message in Spam or Junk folder, please mark it as \"not spam\" and add senders id to contact list or safe list. )</small>";
			$txt .= "</body>";
			$txt .= "</html>";
			
			// To send HTML mail, the Content-type header must be set
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

			
			$headers .= "From: Jungle Book <admin@goaecotourism.com>" . "\r\n";
			//$headers .= "Cc: Jungle Book <enquiry@junglebookgoa.com>" . "\r\n";
			
			//echo 'mail started';

			mail($customer_name . '<'.$traveller_record['Email_Id'].'>', $subject, $txt, $headers);
			*/
			/*echo '<pre>';
			print_r($booking_result);
			echo '</pre>';
			
			echo '<pre>';
			print_r($traveller_record);
			echo '</pre>';*/
			
			/*$mail = new PHPMailer(true);
			
			try {
				$mail->AddAddress($traveller_record['Email_Id'], $traveller_record['Contact_name']);
				$mail->SetFrom('admin@goaecotourism.com', 'Jungle Book');
				$mail->Subject = $subject;
				
				$mail->MsgHTML($txt);
				$mail->Send();
			} catch (phpmailerException $e) {
			  echo $e->errorMessage(); //Pretty error messages from PHPMailer
			} catch (Exception $e) {
			  echo $e->getMessage(); //Boring error messages from anything else!
			} */
			
			//define("ENCRYPTION_KEY", "!@#$%^&*");
			//$string = $traveller_record['Email_Id'] . $booking_result['Total_price'];
			
			//$encrypted = encrypt($string, ENCRYPTION_KEY);
			
			//$decrypted = decrypt($encrypted, ENCRYPTION_KEY);
			
			
			
			header('Location: http://localhost/haabsoft/success.php');
			
			$message_container_class = 'alert-success';
			$message = 'Success!!  Payment Transaction Done Successfully';
			//$message .= $update_jb_booking;
			
		/*} else{
			$message_container_class = 'alert-danger';
			$message =  'Oops!!! Something went wrong!';
		}*/
		
		
	break;
	
	case "failed":
		$message = '';
		$message_container_class = '';
		//$SALT = "GQs7yium";
		//if(!empty($_POST)){
			
		    $payment_status_message = "";
		    $txnid = "";
		    $to_email = "";
		    $customer_name = "";
		    $invoice = "";
		    $productinfo = "";
		    $amount = "";
		    
		    if (isset($_POST['invoice']) && !empty($_POST['invoice'])) {
				// Store Paypal Variables
				$payment_status_message = "";
			    $txnid = $_POST['txn_id'];
			    $to_email = $_POST['payer_email'];
			    //$customer_name = $_POST['first_name'];
			    $invoice = $_POST['invoice'];
			    $productinfo = $_POST['item_name'];
			    $amount = $_POST['payment_gross'];
			    $status = $_POST['payment_status'];
			    
			    $payment_status_message  = "Payment ID - ". $_POST['mihpayid'] . " | ";
				$payment_status_message .= "Status - ". $_POST['payment_status'] . " | ";
				$payment_status_message .= "Txn ID - ". $_POST['txn_id'] . " | ";
				$payment_status_message .= "PG TYPE - ". $_POST['payment_type'] . " | ";
			}
			//$txn=$_REQUEST['txn'];
			
			$txn = $_REQUEST['txn'];
			
			//Based on the status update the payment table
			$update_payment = "UPDATE `payments` SET `payment_status` = 'draft' WHERE `txnid` = '$txn'";
			
			$con->query($update_payment);
			
			
			
			/*
			$booking_record = "SELECT * FROM `JB_Booking` WHERE `txn_id` = '$txnid'";
			
			$booking_result=mysqli_query($con,$booking_record);
			
			$booking_result = mysqli_fetch_array($booking_result, MYSQLI_ASSOC);
			//echo '<pre>';
			//print_r($booking_result);
			//echo '/<pre>';
			$order_id = $booking_result['ID'];
			
			$traveller_record = "SELECT * FROM `JB_Traveller_Details` WHERE `Booking_Id` = $order_id";
			$result=mysqli_query($con,$traveller_record);
			
			$traveller_record = mysqli_fetch_array($result, MYSQLI_ASSOC);
			
			//Send Failed transaction Email 
			$subject = "Your Jungle Book Trip is Failed due to failure in payment: Goaecotourism.com";
			$txt .= "Dear " . $traveller_record['Contact_name'];
			$txt .= "\r\n\r\n Your payment has been rejected by your bank. You can retry your booking by clicking the below link.";
			$txt .= "http://" . $_SERVER['SERVER_NAME'] . "/processForm/retryBooking.php?id=".$booking_result['ID']."nonceKey=".$booking_result['txn_id'];
			$txt .= "\r\n\r\nBest Regards\r\n\r\n";
			$txt .= "Team Jungle Book Goa";
			
			mail($traveller_record['Contact_name'] . '<'.$traveller_record['Email_Id'].'>', $subject, $txt);
			
			define("ENCRYPTION_KEY", "!@#$%^&*");
			$string = $traveller_record['Email_Id'] . $booking_result['Total_price'];
			
			$encrypted = encrypt($string, ENCRYPTION_KEY);
			
			$decrypted = decrypt($encrypted, ENCRYPTION_KEY);
			
			*/
			header('Location: http://localhost/haabsoft/failed.php');
			/*} else{
			$message_container_class = 'alert-danger';
			$message =  'Oops!!! Something went wrong!';
		}*/
	break;
	
	case "cancel": // case cancel to show user the transaction was cancelled
		
			
			
		$txn = $_REQUEST['txn'];
			
		//Based on the status update the payment table
		$update_payment = "UPDATE `payments` SET `payment_status` = 'draft' WHERE `txnid` = '$txn'";

		$con->query($update_payment);	
			
		//$con->query("UPDATE JB_Booking SET `Status` = 'canceled' WHERE `invoice` = " . $_REQUEST["invoice"]);
		$message_container_class = 'alert-danger';
		$message = 'Oops!!! Transaction Cancelled.';
		
		// Send Email Saying Cancelled By User
		/*$to = "shekhardj01@gmail.com";
		$subject = "Your Booking for Jungle Book is cancelled or Incomplete";
		$txt = "Your Booking is incomplete. \n You can Complete your order by visiting this link http://goaecotourism.com/";
		$headers = "From: Jungle Book <webmaster@goaecotourism.com>" . "\r\n";

		mail($to,$subject,$txt,$headers);
		
		header('Location: http://goaecotourism.com/failed.html'); */
		
	break;
	
	/*case "ipn": // IPN case to receive payment information. this case will not displayed in browser. This is server to server communication. PayPal will send the transactions each and every details to this case in secured POST menthod by server to server. 
		$trasaction_id  = $_POST["txn_id"];
		$payment_status = strtolower($_POST["payment_status"]);
		$invoice		= $_POST["invoice"];
		$log_array		= print_r($_POST, TRUE);
		$log_query		= "SELECT * FROM `paypal_log` WHERE `txn_id` = '$trasaction_id'";
		$log_check 		= mysql_query($log_query);
		if(mysql_num_rows($log_check) <= 0){
			mysql_query("INSERT INTO `paypal_log` (`txn_id`, `log`, `posted_date`) VALUES ('$trasaction_id', '$log_array', NOW())");
		}else{
			mysql_query("UPDATE `paypal_log` SET `log` = '$log_array' WHERE `txn_id` = '$trasaction_id'");
		} // Save and update the logs array
		$paypal_log_fetch 	= mysql_fetch_array(mysql_query($log_query));
		$paypal_log_id		= $paypal_log_fetch["id"];
		if ($p->validate_ipn()){ // validate the IPN, do the others stuffs here as per your app logic
			mysql_query("UPDATE `purchases` SET `trasaction_id` = '$trasaction_id ', `log_id` = '$paypal_log_id', `payment_status` = '$payment_status' WHERE `invoice` = '$invoice'");
			$subject = 'Instant Payment Notification - Recieved Payment';
			$p->send_report($subject); // Send the notification about the transaction
		}else{
			$subject = 'Instant Payment Notification - Payment Fail';
			$p->send_report($subject); // failed notification
		}
	break;*/
	}
	
 } else{
	$message_container_class = 'alert-danger';
	$message = 'Oops!!! Something went wrong. Please go to Homepage';
}

	

/*printf ("New Record has id %d.\n", $con->insert_id);*/

//echo "done";
     
?>
<body>
	<div class="container" style="margin-top: 25px;">
	<div class="col-sm-6 col-md-12 clear-fix" style="border:1px;">

		<div class="alert <?php echo $message_container_class; ?>"><center><h3><?php echo  $message; ?></h3></center></div>
		
		<?php //mail('test@goaecotourism.com', 'Test Email From Jungle Book', 'Hell Sir, Testing email today: ' . date('l jS \of F Y h:i:s A')); 
		//echo 'email sent';
		?>					

			
	</div>
</div>	
	
</body>
</html>
		<?php
/**
			 * Returns an encrypted & utf8-encoded
			 */
			/*function encrypt($pure_string, $encryption_key) {
			    $iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
			    $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
			    $encrypted_string = mcrypt_encrypt(MCRYPT_BLOWFISH, $encryption_key, utf8_encode($pure_string), MCRYPT_MODE_ECB, $iv);
			    return $encrypted_string;
			}*/
			
			/**
			 * Returns decrypted original string
			 */
			/*function decrypt($encrypted_string, $encryption_key) {
			    $iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
			    $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
			    $decrypted_string = mcrypt_decrypt(MCRYPT_BLOWFISH, $encryption_key, $encrypted_string, MCRYPT_MODE_ECB, $iv);
			    return $decrypted_string;
			}*/
		?>