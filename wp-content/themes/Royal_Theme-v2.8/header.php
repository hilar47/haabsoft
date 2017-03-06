<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <?php global $etheme_responsive, $woocommerce; ?>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
    
    <meta name="viewport" content="<?php if($etheme_responsive): ?>width=device-width, initial-scale=1, maximum-scale=2.0<?php else: ?>width=1200<?php endif; ?>"/>
   	<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE10" >
   	
	<link rel="shortcut icon" href="<?php echo et_get_favicon(); ?>" />
	<title><?php wp_title( '|', true, 'right' );?></title>
		<?php
			if ( is_singular() && get_option( 'thread_comments' ) )
				wp_enqueue_script( 'comment-reply' );

			wp_head();
		?>

  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="https://use.fontawesome.com/994b84cd61.js"></script>
	<script type="text/javascript">
		 jQuery(document).ready(function () {
	        function getLocation() {
	            if (navigator.geolocation) {
	                navigator.geolocation.getCurrentPosition(showPosition);
	            } else { 
	                //x.innerHTML = "Geolocation is not supported by this browser.";
	            }
	        }

	        function showPosition(position) {
	            var lati = position.coords.latitude;
	            var longi = position.coords.longitude;
	            jQuery('#cntryId').attr("data-lati",lati);
	            jQuery('#cntryId').attr("data-longi",longi);
	            var la = '15.3640718';//jQuery('#cntryId').data("lati");
	            var lo = '73.9295156';//jQuery('#cntryId').data("longi");
	            jQuery.ajax({ url:'http://maps.googleapis.com/maps/api/geocode/json?latlng='+la+','+lo+'&sensor=true',
	                 success: function(data){
	                    for (var i = 0; i < data.results[4].address_components.length; i++) { 
	                        for (var j = 0; j < data.results[4].address_components[i].types.length; j++) { 
	                            if(data.results[4].address_components[i].types[j] == 'country') { 
	                                var country_code = data.results[4].address_components[i].long_name;
	                                localStorage.setItem('country', country_code); 
	                                var storedData = localStorage.getItem('country');
	                                if (storedData != '') {
	                                    jQuery('#cntryId').val(storedData);
	                                }
	                            } 
	                        } 
	                    }
	                    //console.log(data);
	                    //alert(data.results[0].formatted_address);
	                     /*or you could iterate the components for only the city and state*/
	                 }
	            });
	        }
	        console.log(getLocation());
    })
	</script>
</head>

<body <?php body_class(); ?>>

<?php do_action( 'et_after_body' ); ?>

<div id="st-container" class="st-container">

	<nav class="st-menu mobile-menu-block">
		<div class="nav-wrapper">
			<div class="st-menu-content">
				<div class="mobile-nav">
					<div class="close-mobile-nav close-block mobile-nav-heading"><i class="fa fa-bars"></i> <?php _e('Navigation', ETHEME_DOMAIN); ?></div>
					
					<?php et_get_mobile_menu();	?>
					
					<?php if (etheme_get_option('top_links')): ?>
						<div class="mobile-nav-heading"><i class="fa fa-user"></i><?php _e('Account', ETHEME_DOMAIN); ?></div>
						<?php etheme_top_links(array('popups' => false)); ?>
					<?php endif; ?>	
					
					<?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('mobile-sidebar')): ?>
						
					<?php endif; ?>	
				</div>
			</div>
		</div>
		
	</nav>
	
	<div class="st-pusher" style="background-color:#fff;">
	<div class="st-content">
	<div class="st-content-inner">
	<div class="page-wrapper fixNav-enabled">
	
		<?php $ht = ''; $ht = apply_filters('custom_header_filter',$ht); ?>
		<?php $hstrucutre = etheme_get_header_structure($ht); ?>

		<?php if (etheme_get_option('fixed_nav')): ?>
			<div class="fixed-header-area fixed-header-type-<?php echo esc_attr($ht); ?>">
				<div class="fixed-header">
					<div class="container">
					
						<div id="st-trigger-effects" class="column">
							<button data-effect="mobile-menu-block" class="menu-icon"></button>
						</div>
						    
						<div class="header-logo">
							<?php etheme_logo(true); ?>
						</div>

						<div class="collapse navbar-collapse">
								
							<?php 
								et_get_main_menu(); 
								et_get_main_menu('main-menu-right');
							?>
							
						</div><!-- /.navbar-collapse -->
						
						<div class="navbar-header navbar-right">
							<div class="navbar-right">
					            <?php if(class_exists('Woocommerce') && !etheme_get_option('just_catalog') && etheme_get_option('cart_widget')): ?>
				                    <?php etheme_top_cart(); ?>
					            <?php endif ;?>
						            
								<?php if(etheme_get_option('search_form')): ?>
									<?php etheme_search_form(); ?>
								<?php endif; ?>

							</div>
						</div>
						
						<div class="modal-buttons">
							<?php if (class_exists('Woocommerce') && etheme_get_option('top_links')): ?>
	                        	<a href="#cartModal" class="popup-btn shopping-cart-link hidden-lg">&nbsp;</a>
							<?php endif ?>
							<?php if (is_user_logged_in() && etheme_get_option('top_links')): ?>
								<a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" class="my-account-link hidden-lg">&nbsp;</a>
							<?php elseif(etheme_get_option('top_links')): ?>
								<a href="#loginModal" class="popup-btn my-account-link hidden-lg">&nbsp;</a>
							<?php endif ?>
							
							<?php if(etheme_get_option('search_form')): ?>
								<?php etheme_search_form(); ?>
							<?php endif; ?>
						</div>
							
					</div>
				</div>
			</div>
		<?php endif ?>
		
		<?php get_template_part('headers/header-structure', $hstrucutre); ?>