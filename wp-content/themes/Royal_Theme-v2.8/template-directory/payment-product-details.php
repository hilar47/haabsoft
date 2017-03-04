<?php 
/*
Template Name: payment-product-details
*/
?>

<?php
//Include DB configuration file
//include 'config.php';
//$url = "http://localhost/haabsoft/";
//echo "SIte Url ".site_url();

$project = explode('/', $_SERVER['PHP_SELF']);
$actual_link = 'http://'.$_SERVER['HTTP_HOST'].'/'.$project[1].'/';

?>

<?php

// PayPal settings
$paypal_email = 'hilarssandbox@gmail.com';
$return_url = site_url().'/payment-product-details';
$cancel_url = $actual_link.'payment-cancelled.html';
$notify_url = site_url().'/payment-product-details';
    

$item_name = (isset($_POST['first_name']) && !empty($_POST['first_name']) ? $_POST['first_name'] : '');
$item_amount = (isset($_POST['price']) && !empty($_POST['price']) ? $_POST['price'] : '');

// Include Functions
include("functions.php");

// Check if paypal request or response
if (!isset($_POST["txn_id"]) && !isset($_POST["txn_type"])){
    $querystring = '';
    
    // Firstly Append paypal account to querystring
    $querystring .= "?business=".urlencode($paypal_email)."&";
    
    // Append amount& currency (£) to quersytring so it cannot be edited in html
    
    //The item name and amount can be brought in dynamically by querying the $_POST['item_number'] variable.
    $querystring .= "item_name=".urlencode($item_name)."&";
    $querystring .= "amount=".urlencode($item_amount)."&";
    
    //loop for posted values and append to querystring
    foreach($_POST as $key => $value){
        $value = urlencode(stripslashes($value));
        $querystring .= "$key=$value&";
    }
    
    // Append paypal return addresses
    $querystring .= "return=".urlencode(stripslashes($return_url))."&";
    $querystring .= "cancel_return=".urlencode(stripslashes($cancel_url))."&";
    $querystring .= "notify_url=".urlencode($notify_url);
    
    // Append querystring with custom field
    //$querystring .= "&custom=".USERID;
    // echo "String".$querystring;
    // exit();
    // Redirect to paypal IPN
    header('location:https://www.sandbox.paypal.com/cgi-bin/webscr'.$querystring);
    exit();
} else {
    $dbHost = 'localhost';
    $dbUsername = 'root';
    $dbPassword = '';
    $dbName = 'haabsoft';
    //Database Connection
    $link = mysql_connect($dbHost, $dbUsername, $dbPassword);
    mysql_select_db($dbName);
    
    // Response from Paypal

    // read the post from PayPal system and add 'cmd'
    $req = 'cmd=_notify-validate';
    foreach ($_POST as $key => $value) {
        $value = urlencode(stripslashes($value));
        $value = preg_replace('/(.*[^%^0^D])(%0A)(.*)/i','${1}%0D%0A${3}',$value);// IPN fix
        $req .= "&$key=$value";
    }
    
    // assign posted variables to local variables
    $data['item_name']          = (isset($_POST['item_name']) && !empty($_POST['item_name']) ? $_POST['item_name'] : '' );
    $data['item_number']        = (isset($_POST['item_number']) && !empty($_POST['item_number']) ? $_POST['item_number'] : '' );;
    $data['payment_status']     = (isset($_POST['payment_status']) && !empty($_POST['payment_status']) ? $_POST['payment_status'] : '' );
    $data['payment_amount']     = (isset($_POST['mc_gross']) && !empty($_POST['mc_gross']) ? $_POST['mc_gross'] : '' );
    $data['payment_currency']   = (isset($_POST['mc_currency']) && !empty($_POST['mc_currency']) ? $_POST['mc_currency'] : '' );
    $data['txn_id']             = (isset($_POST['txn_id']) && !empty($_POST['txn_id']) ? $_POST['txn_id'] : '' );
    $data['receiver_email']     = (isset($_POST['receiver_email']) && !empty($_POST['receiver_email']) ? $_POST['receiver_email'] : '' );
    $data['payer_email']        = (isset($_POST['payer_email']) && !empty($_POST['payer_email']) ? $_POST['payer_email'] : '' );
    $data['custom']             = (isset($_POST['custom']) && !empty($_POST['custom']) ? $_POST['custom'] : '' );

    // post back to PayPal system to validate
    // $header = "POST /cgi-bin/webscr HTTP/1.0\r\n";
    // $header .= "Content-Type: application/x-www-form-urlencoded\r\n";
    // $header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
    
    // $fp = fsockopen ('ssl://www.sandbox.paypal.com', 443, $errno, $errstr, 30);


    //----------------------------
    // echo "string";
    // exit();
    $paypalURL = "https://www.sandbox.paypal.com/cgi-bin/webscr";
    $ch = curl_init($paypalURL);
    if ($ch == FALSE) {
        return FALSE;
    }
    
    curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
    curl_setopt($ch, CURLOPT_SSLVERSION, 6);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
    curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);

    // Set TCP timeout to 30 seconds
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close', 'User-Agent: company-name'));
    $res = curl_exec($ch);
    // echo "<pre>---";
    // print_r($res);
    // echo "</pre>";
    // exit();
    /*
     * Inspect IPN validation result and act accordingly
     * Split response headers and payload, a better way for strcmp
     */ 
    $tokens = explode("\r\n\r\n", trim($res));
    $res = trim(end($tokens));





    
    // if (!$fp) {
    //     // HTTP ERROR
        
    // } else {
    //if (strcmp($res, "VERIFIED") == 0 || strcasecmp($res, "VERIFIED") == 0) {

        //fputs($fp, $header . $req);
        //while (!feof($fp)) {
            //echo "here";
            //$res = fgets ($fp, 1024);

            if (strcmp($res, "VERIFIED") == 0) {
                
                // echo "yes";
                // exit();
                // Used for debugging
                // mail('user@domain.com', 'PAYPAL POST - VERIFIED RESPONSE', print_r($post, true));
                        
                // Validate payment (Check unique txnid & correct price)
                $valid_txnid = check_txnid($data['txn_id']);
                $valid_price = check_price($data['payment_amount'], $data['item_number']);
                // PAYMENT VALIDATED & VERIFIED!
                if ($valid_txnid && $valid_price) {
                    
                    $orderid = updatePayments($data);

                    if ($orderid) {
                        // echo "Item id : ".$data['item_number'];
                        // exit();
                        // $query1 = array(
                        //     'ID' => $data['item_number'],
                        //     'post_status' => 'publish',
                        // );
                        // echo "here in update";
                        // print_r($query1);
                        global $wpdb;
                        $update_post = $wpdb->query($wpdb->prepare("UPDATE ".$wpdb->prefix."posts set post_status ='publish' where ID = ".$data['item_number']));
                        
            
                        //exit();
                        // $post_id = wp_update_post( $query1, true );
                        // echo "here".$post_id;
                        // exit();
                        if ( is_wp_error( $update_post ) ) {
                                 echo $post_id->get_error_message();
                        }
                        else {
                            $url = site_url()."/wp-admin/post.php?post=".$data['item_number']."&action=edit";
                            
                             wp_redirect($url);
                             exit();
                        }
                        
                        exit();
                        echo "Payment has been made & successfully inserted into the Database";
                    } else {
                        echo "Error inserting into DB";
                        // E-mail admin or alert user
                        // mail('user@domain.com', 'PAYPAL POST - INSERT INTO DB WENT WRONG', print_r($data, true));
                    }
                } else {
                    echo "Payment made but data has been changed";
                    // E-mail admin or alert user
                }
            
            } else if (strcmp ($res, "INVALID") == 0) {
                echo "no";
                exit();
                echo "PAYMENT INVALID & INVESTIGATE MANUALY!";
                exit();
                // E-mail admin or alert user
                
                // Used for debugging
                //@mail("user@domain.com", "PAYPAL DEBUGGING", "Invalid Response<br />data = <pre>".print_r($post, true)."</pre>");
            }
        //}
        // echo "last";
        // exit();
    // fclose ($fp);
    //}
}

?>