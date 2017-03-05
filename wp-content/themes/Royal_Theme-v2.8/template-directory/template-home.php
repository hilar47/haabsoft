<?php 
/*
Template Name: Home
*/
get_header();
$get_country_name = json_decode(file_get_contents("http://freegeoip.net/json/"));
?>
	<?php /*?><?php echo do_shortcode('[rev_slider alias="poster"]');?><?php */?>
    <!--<div class="homepage-hero-module">
		<div class="video-container">
			<div class="filter"></div>
			<video autoplay loop class="fillWidth">
				<source src="wp-content/themes/Royal_Theme-v2.8/videos/cover.mp4" type="video/mp4" />Your browser does not support the video tag. I suggest you upgrade your browser.
				<source src="wp-content/themes/Royal_Theme-v2.8/videos/cover.webm" type="video/webm" />Your browser does not support the video tag. I suggest you upgrade your browser.
			</video>
			<div class="poster hidden">
				<img src="wp-content/themes/Royal_Theme-v2.8/videos/cover.jpg" alt="">
			</div>
		</div>
	</div>-->
<div class="banner-home">
    <!--<img src="<?php echo content_url();?>/themes/Royal_Theme-v2.8/images/banner-bg.jpg" />-->
    <h1>HAABSOFT VIDEOS</h1>
    <h3>WATCH OUR VIDEOS COLLECTION</h3>
</div>

<div class="container home">
		<div class="row">
		<?php
		global $content_page_meta;
		$meta = get_post_meta($post->ID, $content_page_meta->get_the_id(), true);
		?>
			<div class="col-xs-12 m-t-40 how-we-work">
				<h2 class="text-center"><?php echo (isset($meta['section_title']) && !empty($meta['section_title']) ? $meta['section_title'] : '');?></h2>
										<!--<hr class="divider break">-->
										<?php /*?><p style="font-size: 18px;"><?php echo (isset($meta['section_description']) && !empty($meta['section_description']) ? $meta['section_description'] : '');?></p><?php */?>
					<?php
				if(isset($meta['reference_callout']) && !empty($meta['reference_callout'])) {
					foreach($meta['reference_callout'] as $vid_res) {
				?>					
				<div class="col-xs-12 col-sm-4 text-center">
						<img class="img-icon" alt="null" src="<?php echo (isset($vid_res['section_image']) && !empty($vid_res['section_image']) ? $vid_res['section_image'] : '');?>">
						<h3 class="m-tb-15"><?php echo (isset($vid_res['link_text']) && !empty($vid_res['link_text']) ? $vid_res['link_text'] : '');?></h3>
						<p><?php echo (isset($vid_res['description']) && !empty($vid_res['description']) ? $vid_res['description'] : '');?></p>	
			    </div>
				<?php } } ?>
			</div>
		</div>
		<!-- end row-fluid -->
</div>

<!-- Videos -->
		<div class="wpb_wrapper videos">
            <h3>FEATURED VIDEOS</h3>
            <div class="container">
                <?php
										//echo $_POST['countryKey'];
										//for a given post type, return all
										// $post_type = 'videos';
										// $tax = 'videos_category';
										// $tax_terms = get_terms($tax);
										// if ($tax_terms) {
										  // foreach ($tax_terms  as $tax_term) {
										    $args=array(
										      'post_type' => 'videos',
										      'post_status' => 'publish',
										      'posts_per_page' => -1,
										      'caller_get_posts'=> 1,
										      'meta_query' => array(
													array(
										                'key' => $content_item_meta->get_the_name('country'),
										                'value'=> $get_country_name->country_name
											        )
												)
										    );

										    $my_query = null;
										    $my_query = new WP_Query($args);
										    if( $my_query->have_posts() ) { ?>
										    
										    	<div class="row">
										    	<?php
										      while ($my_query->have_posts()) : $my_query->the_post(); 
										      	global $content_item_meta;
										      	$video_meta = get_post_meta($post->ID);
										    ?>
										        
										        <div class="col-xs-12 col-sm-4 m-b-20 video-holder">
										        	<video class="img-responsive" controls><source src="<?php if(isset($video_meta['video_upload'][0]) && !empty($video_meta['video_upload'][0])) { echo $video_meta['video_upload'][0]; } ?>" type="video/mp4"></video>
													<div class="video-disc">
                                                        <h5><?php the_title(); ?></h5>
														<h6><?php if(isset($video_meta['caption_line'][0]) && !empty($video_meta['caption_line'][0])) { echo $video_meta['caption_line'][0]; } ?></h6>
													<p>Uploaded by: <span><?php $recent_author = get_user_by( 'ID', $post->post_author ); echo $author_display_name = $recent_author->display_name; ?></span></p>
													</div>
										        	
										        </div>
										        <?php
										           
										      endwhile;
										      ?>
										      </div>
										      <?php
										    }
										    wp_reset_query();
										  //}
										//}
										?>
                </div>
            </div>


							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- end row-fluid -->
	</div>
</div>
<?php 
get_footer();
?>