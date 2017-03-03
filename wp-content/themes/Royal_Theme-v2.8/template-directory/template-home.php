<?php 
/*
Template Name: Home
*/
get_header();
$get_country_name = json_decode(file_get_contents("http://freegeoip.net/json/"));
?>
<div>
	<?php echo do_shortcode('[rev_slider alias="poster"]');?>
</div>
<div class="container content-page">
	<div class="page-content sidebar-position-without sidebar-mobile-bottom">
		<div class="row">
		<?php
		global $content_page_meta;
		$meta = get_post_meta($post->ID, $content_page_meta->get_the_id(), true);
		?>
			<div class="content col-md-12">
				<div class="vc_row wpb_row vc_row-fluid vc_custom_1420453632189">
					<div class="wpb_column vc_column_container vc_col-sm-12">
						<div class="vc_column-inner ">
							<div class="wpb_wrapper">
								<div class="wpb_text_column wpb_content_element  text-center">
									<div class="wpb_wrapper">
										<h2><?php echo (isset($meta['section_title']) && !empty($meta['section_title']) ? $meta['section_title'] : '');?></h2>
										<hr class="divider break">
										<p style="font-size: 18px;"><?php echo (isset($meta['section_description']) && !empty($meta['section_description']) ? $meta['section_description'] : '');?></p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- Row Backgrounds -->
				<div class="vc_row wpb_row vc_row-fluid vc_custom_1404208271159">
				<?php
				if(isset($meta['reference_callout']) && !empty($meta['reference_callout'])) {
					foreach($meta['reference_callout'] as $vid_res) {
				?>
					<div class="wpb_column vc_column_container vc_col-sm-4">
						<div class="vc_column-inner ">
							<div class="wpb_wrapper">
								<div class="aio-icon-component    style_1">
									<div id="Info-box-wrap-1762" class="aio-icon-box left-icon" style="">
										<div class="aio-icon-left">
											<div class="ult-just-icon-wrapper  ">
												<div class="align-icon" style="text-align:center;">
													<div class="aio-icon-img " style="font-size:80px;display:inline-block;">
														<img class="img-icon" alt="null" src="<?php echo (isset($vid_res['section_image']) && !empty($vid_res['section_image']) ? $vid_res['section_image'] : '');?>">
													</div>
												</div>
											</div>
										</div>
										<div class="aio-ibd-block">
											<div class="aio-icon-header">
												<h3 class="aio-icon-title ult-responsive" data-ultimate-target="#Info-box-wrap-1762 .aio-icon-title" data-responsive-json-new="{&quot;font-size&quot;:&quot;&quot;,&quot;line-height&quot;:&quot;&quot;}" style=""><?php echo (isset($vid_res['link_text']) && !empty($vid_res['link_text']) ? $vid_res['link_text'] : '');?></h3>
											</div>
											<!-- header -->
											<div class="aio-icon-description ult-responsive" data-ultimate-target="#Info-box-wrap-1762 .aio-icon-description" data-responsive-json-new="{&quot;font-size&quot;:&quot;&quot;,&quot;line-height&quot;:&quot;&quot;}" style=""><?php echo (isset($vid_res['description']) && !empty($vid_res['description']) ? $vid_res['description'] : '');?></div>
											<!-- description -->
										</div>
										<!-- aio-ibd-block -->
									</div>
									<!-- aio-icon-box -->
								</div>
								<!-- aio-icon-component -->
							</div>
						</div>
					</div>
				<?php } } ?>
				</div>
				<!-- Row Backgrounds -->
				<div class="vc_row wpb_row vc_row-fluid bordered vc_custom_1420550263405">
					<div class="wpb_column vc_column_container vc_col-sm-12">
						<div class="vc_column-inner ">
							<div class="wpb_wrapper">
								<div class="wpb_text_column wpb_content_element  text-center">
									<div class="wpb_wrapper">
										<h2><?php echo (isset($meta['video_section_title']) && !empty($meta['video_section_title']) ? $meta['video_section_title'] : '');?></h2>
										<hr class="divider break">
										<p style="font-size: 18px;"><?php echo (isset($meta['video_section_description']) && !empty($meta['video_section_description']) ? $meta['video_section_description'] : '');?></p>
										<?php
										//echo $_POST['countryKey'];
										//for a given post type, return all
										$post_type = 'videos';
										$tax = 'videos_category';
										$tax_terms = get_terms($tax);
										if ($tax_terms) {
										  foreach ($tax_terms  as $tax_term) {
										    $args=array(
										      'post_type' => $post_type,
										      "$tax" => $tax_term->slug,
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
										    	<h3><?php if(isset($tax_term->name) && !empty($tax_term->name)) { echo $tax_term->name; } ?></h3>
										    	<?php
										      while ($my_query->have_posts()) : $my_query->the_post(); 
										      	global $content_item_meta;
										      	$video_meta = get_post_meta($post->ID, $content_item_meta->get_the_id(), true);
										            ?>
										        
										        <div class="col-md-4">
										        	<video width="400" controls style="padding: 1px 29px 0 0;"><source src="<?php if(isset($video_meta['video_upload']) && !empty($video_meta['video_upload'])) { echo $video_meta['video_upload']; } ?>" type="video/mp4"></video>
										        </div>
										        <?php
										           
										      endwhile;
										      ?>
										      </div>
										      <?php
										    }
										    wp_reset_query();
										  }
										}
										?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- Row Backgrounds -->
				<p></p>
				<div class="post-navigation">
				</div>
				<p class="edit-link"><a class="post-edit-link" href="<?php echo site_url();?>wp-admin/post.php?post=22879&amp;action=edit">Edit this</a> <a href="<?php echo site_url();?>/wp-admin/post.php?vc_action=vc_inline&amp;post_id=22879&amp;post_type=page" id="vc_load-inline-editor" class="vc_inline-link">Edit with Visual Composer</a></p>
			</div>
		</div>
		<!-- end row-fluid -->
	</div>
</div>
<?php 
get_footer();
?>