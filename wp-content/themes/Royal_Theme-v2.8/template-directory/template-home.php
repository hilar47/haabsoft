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
<div class="container home">
		<div class="row">
		<?php
		global $content_page_meta;
		$meta = get_post_meta($post->ID, $content_page_meta->get_the_id(), true);
		?>
			<div class="col-xs-12 m-t-15">
				<h2 class="text-center"><?php echo (isset($meta['section_title']) && !empty($meta['section_title']) ? $meta['section_title'] : '');?></h2>
										<hr class="divider break">
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
		
		<!-- Row Backgrounds -->
				<div class="wpb_wrapper videos">
										<?php /*?><h2><?php echo (isset($meta['video_section_title']) && !empty($meta['video_section_title']) ? $meta['video_section_title'] : '');?></h2>
										<hr class="divider break">
										<p style="font-size: 18px;"><?php echo (isset($meta['video_section_description']) && !empty($meta['video_section_description']) ? $meta['video_section_description'] : '');?></p><?php */?>
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
										    <h3><?php if(isset($tax_term->name) && !empty($tax_term->name)) { echo $tax_term->name; } ?></h3>
										    	<div class="row">
										    	<?php
										      while ($my_query->have_posts()) : $my_query->the_post(); 
										      	global $content_item_meta;
										      	$video_meta = get_post_meta($post->ID, $content_item_meta->get_the_id(), true);
										            ?>
										        
										        <div class="col-xs-12 col-sm-4 m-b-20">
										        	<video class="img-responsive" controls><source src="<?php if(isset($video_meta['video_upload']) && !empty($video_meta['video_upload'])) { echo $video_meta['video_upload']; } ?>" type="video/mp4"></video>
													<div class="video-disc">
														<h5>Lorem ipsum dolor sit amet, consectetur</h5>
													<p>Uploaded by : Rohit Raul</p>
													</div>
										        	
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