<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="./css/datepicker3.css">
	<meta name="viewport" content="width=device-width, initial-scale=1" >
	<title>Payment Failed - Haabsoft</title>
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
	
			<?php
			
			
			/**
			 * Returns decrypted original string
			 */
			
			?>
				
			<div class="container ">
				<div class="bs-callout bs-callout-warning">
				<?php 
				//echo urldecode($encrypted);
				//if($encrypted == urldecode($_GET['key'])){ ?> 
				<h2 class="page-header" style="margin:20px 0 20px !important"><img alt="Haabsoft logo" src="http://localhost/haabsoft/wp-content/uploads/2017/01/haabsoft-logo.png" width="135" height="76" />HaabSoft. </h2>
				
				
				<h4>Sorry there was an error while processing your request please retry doing the payment procedure after some time. <a href="http://localhost/haabsoft"> Click to goto homepage</a></h4>
				
				<?php //} else { echo '<h4>Error: 404</h4>'; } ?>
				</div>
			</div>
	</body>
</html>