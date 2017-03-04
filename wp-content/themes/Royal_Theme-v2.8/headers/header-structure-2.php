<?php 
    if(function_exists('woocommerce_get_page_id')) $page_for_shop = woocommerce_get_page_id( 'shop' );
    $page_id = get_the_ID();
    if(class_exists('WooCommerce') && ( is_shop() || is_product_category() || is_product_tag() )) {
    	$page_id = $page_for_shop;
    }
	$ht = $class = ''; 
	$ht = apply_filters('custom_header_filter',$ht);  
	$hstrucutre = etheme_get_header_structure($ht); 
	$page_slider = etheme_get_custom_field('page_slider', $page_id);

	if (is_home() && get_option('page_for_posts') !='') {
		$page_slider = etheme_get_custom_field('page_slider', get_option('page_for_posts'));
	}
	
	if($page_slider != '' && $page_slider != 'no_slider' && ($ht == 2 || $ht == 3 || $ht == 5)) {
		$class = 'slider-overlap';
	}
	if(etheme_get_option('header_transparent')) {
		$class .= ' header-transparent';
	}

?>

<div class="header-wrapper header-type-<?php echo $ht.' '.$class; ?>">
	<?php get_template_part('headers/parts/top-bar', $hstrucutre); ?>
	<header class="header main-header">
		<div class="container">	
			<div class="navbar" role="navigation">
				<div class="container-fluid">
					<div id="st-trigger-effects" class="column">
						<button data-effect="mobile-menu-block" class="menu-icon"></button>
					</div>
					<!--<div class="tbs blog-description"><span><?php echo etheme_get_option('header_custom_block'); ?></span></div>-->
					
					<div class="header-logo">
						<?php etheme_logo(); ?>
					</div>
					
					<div class="clearfix visible-md visible-sm visible-xs"></div>

					<div class="navbar-header navbar-right width70">
						<div class="navbar-right width100">
				           <?php /*?> <?php if(class_exists('Woocommerce') && !etheme_get_option('just_catalog') && etheme_get_option('cart_widget')): ?>
			                    <?php etheme_top_cart(); ?>
				            <?php endif ;?>
							<?php if(etheme_get_option('search_form')): ?>
								<?php etheme_search_form(); ?>
							<?php endif; ?><?php */?>
							<form action="<?php echo site_url();?>" id="searchform" class="hide-input" method="get"> 
								<div class="input-group">
									<span class="input-group-addon" id="search-icon"><i class="fa fa-search"></i></span>
									<input name="kywrds" id="kywrds" class="form-control pull-left search-bar" placeholder="Search for new videos" type="text">
								</div>
								<input name="post_type" value="videos" type="hidden">
								<input type="hidden" name="cntry" id="cntryId" value="" />
								<button type="submit" class="btn medium-btn btn-black pull-right">Search</button>
							</form>
						</div>
					</div>
				</div><!-- /.container-fluid -->
			</div>
		</div>	
		<div class="menu-wrapper">
			<div class="container">
				<div class="collapse navbar-collapse">
					<?php et_get_main_menu(); ?>
				</div>
			</div><!-- /.navbar-collapse -->
		</div>
	</header>
</div>