<?php 
/*
Template Name: Home
*/
get_header();
//$get_country_name = json_decode(file_get_contents("http://freegeoip.net/json/"));
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
    <?php /*?><img src="<?php echo content_url();?>/themes/Royal_Theme-v2.8/images/banner-bg.jpg" /><?php */?>
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
						            	<div class="row" id="videoSection"></div>
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