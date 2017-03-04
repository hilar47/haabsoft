<?php 
/*
Template Name: pay-form
*/
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Paypal Integration Test</title>
</head>
<body>
	<form class="paypal" action="<?php echo site_url();?>/payment-product-details" method="post" id="paypal_form">
		<input type="hidden" name="cmd" value="_xclick" />
		<input type="hidden" name="no_note" value="1" />
		<input type="hidden" name="lc" value="UK" />
		<input type="hidden" name="currency_code" value="USD" />
		<input type="hidden" name="price" value="<?php echo (isset($_GET['price']) && !empty($_GET['price']) ? $_GET['price'] : '');?>" />
		<input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHostedGuest" />
		<input type="hidden" name="first_name" value="<?php echo (isset($_GET['post_name']) && !empty($_GET['post_name']) ? $_GET['post_name'] : '');?>"  />
		<input type="hidden" name="payer_email" value="<?php echo (isset($_GET['payer_email']) && !empty($_GET['payer_email']) ? $_GET['payer_email'] : '');?>"  />
		<input type="hidden" name="item_number" value="<?php echo (isset($_GET['id']) && !empty($_GET['id']) ? $_GET['id'] : '');?>" / >
		<input type="submit" name="submit" value="Submit Payment"/>
	</form>
</body>
</html>
