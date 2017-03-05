<?php 
/**
 * The main template file.
 *
 */
	get_header();
?>
<?php 
	global $content_item_meta;
	
	$args = array(
	'post_type' => 'videos',
	// must use meta_query as an array with WP 3.1+ (instead of meta_key or meta_value)
	'meta_query' => array(
			'relation' => 'OR',
	        array(
                'key' => $content_item_meta->get_the_name('video_category'),
                'value'=> $_GET['ctgry']
	        ),
	        array(
                'key' => $content_item_meta->get_the_name('video_subcategory'),
                'value'=> $_GET['sctgry']
	        ),
	        array(
                'key' => $content_item_meta->get_the_name('country'),
                'value'=> $_GET['cntry']
	        ),
	        array(
                'key' => $content_item_meta->get_the_name('state'),
                'value'=> $_GET['stat']
	        ),
	        array(
                'key' => $content_item_meta->get_the_name('city'),
                'value'=> $_GET['cty']
	        ),
	        array(
                'key' => $content_item_meta->get_the_name('pin_code'),
                'value'=> $_GET['pncde']
	        ),
	        array(
                'key' => $content_item_meta->get_the_name('keywords'),
                'value'=> $_GET['kywrds']
	        )
	)
	);
	
	$the_query = new WP_Query( $args );
?>
<?php 

	$l = et_page_config();

	$content_layout = etheme_get_option('blog_layout');

	$full_width = false;

	if($content_layout == 'mosaic') {
		$full_width = etheme_get_option('blog_full_width');
	}

	if($content_layout == 'mosaic') {
		$content_layout = 'grid';
	}
?>


<?php do_action( 'et_page_heading' ); ?>

<div class="<?php echo (!$full_width) ? 'container' : 'blog-full-width'; ?>">
	<div class="page-content sidebar-position-<?php esc_attr_e( $l['sidebar'] ); ?> sidebar-mobile-<?php esc_attr_e( $l['sidebar-mobile'] ); ?>">
		<div class="row">
			<div class="content <?php esc_attr_e( $l['content-class'] ); ?>">
		
				<div class="<?php if ($content_layout == 'grid'): ?>blog-masonry row<?php endif ?>">
				
					<h3 class="search-title">Search Results</h3>
					<?php if($the_query->have_posts()): 
						while($the_query->have_posts()) : $the_query->the_post(); ?>

							<?php get_template_part('content', $content_layout); ?>

						<?php endwhile; ?>
					<?php else: ?>

						<h1><?php _e('No posts were found!', ET_DOMAIN) ?></h1>

					<?php endif; ?>
				</div>

				<div class="articles-nav">
					<div class="left"><?php next_posts_link(__('&larr; Older Posts', ET_DOMAIN)); ?></div>
					<div class="right"><?php previous_posts_link(__('Newer Posts &rarr;', ET_DOMAIN)); ?></div>
					<div class="clear"></div>
				</div>

			</div>

			<?php get_sidebar(); ?>
		</div>
	</div>
</div>

<?php
	get_footer();
?>