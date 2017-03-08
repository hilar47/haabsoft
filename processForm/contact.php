<?php 

// Include Functions
//include("functions.php");

//global $wpdb;

//$args = array(
//  'p'         => $_GET['post_id'], // ID of a page, post, or custom type
//  'post_type' => 'any'
//);
//$my_posts = new WP_Query($args);



$error = 0;
if ( empty($_GET) ){
	$error = 1;
}
//echo "<pre>";
//print_r($my_posts);
//echo "</pre>";
	
?>

<html>
<head>
<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">-->

<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/datepicker3.css">
<meta name="viewport" content="width=device-width, initial-scale=1" >
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />

<!-- Javascript -->
<script type='text/javascript' src="//cdnjs.cloudflare.com/ajax/libs/modernizr/2.7.1/modernizr.min.js"></script>

<script type='text/javascript' src="js/css3-mediaqueries.js"></script>
<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
  <script type='text/javascript' src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <script type='text/javascript' src="//cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.js"></script>
<![endif]-->

<title>Pay For Video - Haabsoft</title>
<style>
	input.error{
		border: 1px solid red;
	}
	.error{
		color:red;
		
	}
	label.error{
		font-size: 11px;
	}
	.bs-callout-warning {
		border-left-color: #f0ad4e !important;
	}
	.bs-callout {
		padding: 20px;
		margin: 20px 0;
		border: 1px solid #eee;
		border-left-width: 5px;
		border-radius: 3px;
	}
	
</style>
</head>
	<body>
		<div class="container ">
			<div class="bs-callout bs-callout-warning">
			<?php if ($error == 1){
				echo $message = '<div class="alert alert-danger"> Oops!!! Something went wrong. Please go to Homepage</div>';
				
				} else { ?>
				<h2 class="page-header" style="margin:20px 0 20px !important"><img alt="Jungle Book logo" src="http://localhost/haabsoft/wp-content/uploads/2017/01/haabsoft-logo.png" style="width: 64px;"/>Payment</h2>
				<div class="alert alert-success" role="alert">
					<b>Please Note</b>
					<ul>
						<li>You will be redirected to our pyment gateway once you have clicked paynow button</li>
						<li>Please click paynow button to redirect to our payment gateway and complete our payment</li>
					</ul>
				</div>

				<form id="PackageFormProcess" class="form-horizontal" role="form" method="post" action="process.php">
				<div class="row">
				<?php   
					    //echo '<input type="hidden" name="package_name" value="">';
					    //echo '<input type="hidden" name="package_description" value="">';
					    //echo '<input type="hidden" name="package_id" value="">';
					    //echo '<input type="hidden" name="package_type" value="">';
					    //echo '<input type="hidden" name="package_mode" value="">';
					    //echo '<input type="hidden" name="no_of_pax" value="">';
					    echo '<input type="hidden" name="post_id" value="'.$_GET['post_id'].'">';
					    echo '<input type="hidden" name="payment_option" value="USD">';
					    echo '<input type="hidden" class="total_pay" name="total_pay" value="0.01">';


					?>
					<input type="hidden" name="action" value="process" />
				    <input type="hidden" name="cmd" value="_xclick" /> <?php // use _cart for cart checkout ?>
				    <input type="hidden" name="currency_code" value="USD" />
				    <input type="hidden" name="invoice" value="<?php echo date("His").rand(1234, 9632); ?>" />
				    
				</div>
					<div class="row">
						<div class="text-center">
							<input type="submit" name="submit" class="btn btn-warning" value="Pay Now"> <img class="ajax-loader" id="ajax-loader" src="http://goaecotourism.com/wp-content/plugins/contact-form-7/images/ajax-loader.gif" alt="Sending ..." style="visibility: hidden;"><br /><br />
							<p><a onClick="window.history.back()" style="cursor:pointer;">(Cancel the transaction and go back to Videos)</a></p>
						</div>
					</div>
					
				</form>
			</div>
		</div>
		<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
		<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<link rel="stylesheet" href="/resources/demos/style.css">

<!-- Date Time Picker -->
<!--<link rel="stylesheet" type="text/css" href="xdtimepicker/jquery.datetimepicker.css"/ >-->
<!-- <script src="xdtimepicker/jquery.js"></script>-->
<!--<script src="xdtimepicker/build/jquery.datetimepicker.full.min.js"></script>-->


	<!--<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>-->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
		<!--<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.0/jquery.validate.js"></script>-->
		<!--<script src="./js/bootstrap-datepicker.js"></script>-->
		
		<?php } ?>
	</body>
</html>