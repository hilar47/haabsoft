<?php
/**
*	Template for standart Posts
*/

    $postClass = 'blog-post';
    $postId = get_the_ID();
    $lightbox = etheme_get_option('blog_lightbox');
    $blog_slider = etheme_get_option('blog_slider');
    $post_format = get_post_format();
    
    $post_content = get_the_content('<span class="btn big filled pull-right read-more">'.__('Read More', ETHEME_DOMAIN).'</span>');
    preg_match('/\[gallery.*ids=.(.*).\]/', $post_content, $ids);
    $attach_ids = array();
    $filtered_content = '';
    if(!empty($ids)) {
	    $attach_ids = explode(",", $ids[1]);
	    $content =  str_replace($ids[0], "", $post_content);
	    $filtered_content = apply_filters( 'the_content', $content);
    }

    $slider_id = rand(100,10000);
    $postClass .= ' content-'.etheme_get_option('blog_layout');
?>

<article <?php post_class($postClass); ?> id="post-<?php the_ID(); ?>" >
	
	<div class="row">
		<?php if($post_format == 'quote' || $post_format == 'video'): ?>
	    
	            <?php the_excerpt(); ?>
	        	<a href="<?php the_permalink(); ?>" class="more-link"><span class="btn big filled pull-right read-more"><?php _e('Read More', ET_DOMAIN); ?></span></a>
	        
		<?php elseif($post_format == 'gallery'): ?>
	            <?php if(count($attach_ids) > 0): ?>
	                <div class="post-gallery-slider slider_id-<?php echo $slider_id; ?>">
	                    <?php foreach($attach_ids as $attach_id): ?>
	                        <div>
	                            <?php echo wp_get_attachment_image($attach_id, 'large'); ?>
	                        </div>
	                    <?php endforeach; ?>
	                </div>
	    
	                <script type="text/javascript">
	                    jQuery('.slider_id-<?php echo $slider_id; ?>').owlCarousel({
	                        items:1,
	                        navigation: true,
	                        lazyLoad: false,
	                        rewindNav: false,
	                        addClassActive: true,
	                        singleItem : true,
	                        autoHeight : true,
	                        itemsCustom: [1600, 1]
	                    });
	                </script>
	            <?php endif; ?>
	    
		<?php elseif(has_post_thumbnail()): ?>
			<div class="wp-picture">
				<?php the_post_thumbnail('large'); ?>
				<div class="zoom">
					<div class="btn_group">
						<a href="<?php echo etheme_get_image(); ?>" class="btn btn-black xmedium-btn" rel="pphoto"><span><?php _e('View large', ETHEME_DOMAIN); ?></span></a>
						<a href="<?php the_permalink(); ?>" class="btn btn-black xmedium-btn"><span><?php _e('More details', ETHEME_DOMAIN); ?></span></a>
					</div>
					<i class="bg"></i>
				</div>
			</div>
		<?php endif; ?>
	    
		<?php if($post_format != 'quote'): ?>
			<?php
			global $content_item_meta;
	      	$video_result = get_post_meta($postId, $content_item_meta->postId, true);
	      	// echo "<pre>";
	      	// print_r($video_result);
	      	// echo "</pre>";
	      	
			?>
        	<div class="col-sm-3">
        		<div class="video-search" data-id="<?php echo $postId;?>">
                    <img src="<?php echo content_url();?>/themes/Royal_Theme-v2.8/images/play-icon.png" class="play-icon" />
        			<video><source src='<?php echo (isset($video_result['video_upload'][0]) && !empty($video_result['video_upload'][0]) ? $video_result['video_upload'][0] : ''); ?>' type='video/mp4'></video>
        		</div>
        	</div>
        	
        	<div class="col-sm-9">
        		<h2 class="entry-title" data-id="<?php echo $postId;?>"><?php the_title(); ?></h2>
        		<h6 class="category-text"><span>Category:</span> <?php echo $video_result['video_category'][0]; ?></h6>
        		<h6 class="caption-text"><?php echo (isset($video_result['caption_line'][0]) && !empty($video_result['caption_line'][0]) ? $video_result['caption_line'][0] : ''); ?></h6>
        		<?php if(etheme_get_option('blog_byline') && etheme_get_option('blog_layout') != 'timeline'): ?>
	            <div class="posted-by">
	                    <?php //_e('Posted on', ETHEME_DOMAIN) ?>
	                    <?php //the_time(get_option('date_format')); ?> 
	                    <?php //_e('at', ETHEME_DOMAIN) ?> 
	                    <?php //the_time(get_option('time_format')); ?>
	                    <?php _e('Uploaded by:', ETHEME_DOMAIN);?> <span class="vcard"> <span class="fn"><?php the_author_posts_link(); ?></span></span>
	                    <?php // Display Comments 
	
	                            if(comments_open() && !post_password_required()) {
	                                    echo ' / ';
	                                    comments_popup_link('0', '1 Comment', '% Comments', 'post-comments-count');
	                            }
	
	                     ?>
	            </div>
	        <?php elseif(etheme_get_option('blog_byline') && etheme_get_option('blog_layout') == 'timeline'): ?>
	            <div class="meta-post">
	                    <?php _e('Posted by', ETHEME_DOMAIN);?> <?php the_author_posts_link(); ?>
	                    <?php // Display Comments 
	
	                            if(comments_open() && !post_password_required()) {
	                                    echo ' / ';
	                                    comments_popup_link('0', '1 Comment', '% Comments', 'post-comments-count');
	                            }
	
	                     ?>
	            </div>
	        <?php endif; ?>
        	</div>
	        
	        <!-- Modal -->
			  <div class="modal fade video-popup" id="myModal_<?php echo $postId;?>" role="dialog">
			    <div class="modal-dialog"> 
			    
			      <!-- Modal content-->
			      <div class="modal-content">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
			       
			        <div class="modal-body">
			          <video controls class="width100"><source src='<?php echo (isset($video_result['video_upload'][0]) && !empty($video_result['video_upload'][0]) ? $video_result['video_upload'][0] : ''); ?>' type='video/mp4'></video>
			          <h4 class="entry-title"><?php the_title(); ?></h4>
	        			<p><?php echo (isset($video_result['caption_line'][0]) && !empty($video_result['caption_line'][0]) ? $video_result['caption_line'][0] : ''); ?></p>
                        <h5 class="modal-title">Video Information</h5>
                       	<div class="row">
                        <div class="media col-sm-3">
                            <div class="media-left">
                              <i class="fa fa-link" aria-hidden="true"></i>
                            </div>
                            <div class="media-body">
                              <p><?php echo (isset($video_result['website'][0]) && !empty($video_result['website'][0]) ? $video_result['website'][0] : ''); ?>	</p>
                            </div>
                        </div>
                        <div class="media col-sm-3">
                            <div class="media-left">
                             <i class="fa fa-envelope-o" aria-hidden="true"></i>
                            </div>
                            <div class="media-body">
                              <p><?php echo (isset($video_result['email'][0]) && !empty($video_result['email'][0]) ? $video_result['email'][0] : ''); ?></p>
                            </div>
                        </div>
                        <div class="media col-sm-3">
                            <div class="media-left">
                              <i class="fa fa-phone-square" aria-hidden="true"></i>
                            </div>
                            <div class="media-body">
                              <p><?php echo (isset($video_result['landline'][0]) && !empty($video_result['landline'][0]) ? $video_result['landline'][0] : ''); ?></p>
                            </div>
                        </div>
                        <div class="media col-sm-3">
                            <div class="media-left">
                              <i class="fa fa-mobile" aria-hidden="true"></i>
                            </div>
                            <div class="media-body">
                              <p><?php echo (isset($video_result['phone'][0]) && !empty($video_result['phone'][0]) ? $video_result['phone'][0] : ''); ?></p>
                            </div>
                        </div>
                        <div class="media col-sm-3">
                            <div class="media-left">
                              <i class="fa fa-whatsapp" aria-hidden="true"></i>
                            </div>
                            <div class="media-body">
                              <p><?php echo (isset($video_result['watsapp_no'][0]) && !empty($video_result['watsapp_no'][0]) ? $video_result['watsapp_no'][0] : ''); ?></p>
                            </div>
                        </div>
                        <div class="media col-sm-3">
                            <div class="media-left">
                              <i class="fa fa-location-arrow" aria-hidden="true"></i>
                            </div>
                            <div class="media-body">
                              <p><?php echo (isset($video_result['address1'][0]) && !empty($video_result['address1'][0]) ? $video_result['address1'][0] : ''); ?><br /><?php echo (isset($video_result['city'][0]) && !empty($video_result['city'][0]) ? $video_result['city'][0] : ''); ?>&nbsp;<?php echo (isset($video_result['country'][0]) && !empty($video_result['country'][0]) ? $video_result['country'][0] : ''); ?><br /><?php echo (isset($video_result['pin_code'][0]) && !empty($video_result['pin_code'][0]) ? $video_result['pin_code'][0] : ''); ?></p>
                            </div>
                        </div>
                        <div class="media col-sm-3">
                            <div class="media-left">
                              <i class="fa fa-map-marker" aria-hidden="true"></i>
                            </div>
                            <div class="media-body">
                              <p>Google link</p>
                            </div>
                        </div>
                        <div class="media col-sm-3">
                            <div class="media-left">
                              <i class="fa fa-facebook-square" aria-hidden="true"></i>
                            </div>
                            <div class="media-body">
                              <p>Facebook</p>
                            </div>
                        </div>
                        <div class="media col-sm-3">
                            <div class="media-left">
                              <i class="fa fa-youtube-square" aria-hidden="true"></i>
                            </div>
                            <div class="media-body">
                              <p>Youtube</p>
                            </div>
                        </div>
                        <div class="media col-sm-3">
                            <div class="media-left">
                              <i class="fa fa-twitter-square" aria-hidden="true"></i>
                            </div>
                            <div class="media-body">
                              <p>Twitter</p>
                            </div>
                        </div>
                    </div>
                    <h5 class="modal-title">Video Information</h5>
                       	<div class="row comment">
                        	<div class="col-sm-12">	
                                <div class="media">
                                <div class="media-left col-sm-1">
                                  <img src="<?php echo site_url() . '/wp-content/themes/Royal_Theme-v2.8/images/custom-assets/comment-avtar.png'; ?>"  alt="comment-avter" />
                                </div>
                                <div class="media-body col-sm-11">
                                    <input type="textarea" class="form-control" name="" value="">
                                    <button type="button" class="btn btn-default-alt pull-right m-t-15" data-dismiss="modal">send</button>
                                </div>
                            </div>
                                <div class="media">
                                <div class="media-left col-sm-1">
                                   <img src="<?php echo site_url() . '/wp-content/themes/Royal_Theme-v2.8/images/custom-assets/comment-avtar.png'; ?>"  alt="comment-avter" />
                                </div>
                                <div class="media-body col-sm-11">
                                    <h5 class="media-heading">John Doe</h5>
                                    <p>Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum...</p>
                                </div>
                            </div>	
                            </div>
                        </div>
			    </div>
			       <?php /*?> <div class="modal-footer">
			          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			        </div><?php */?>
			      </div>
			      
			    </div>
			  </div>
	    <?php endif; ?>
	
	   <?php /*?> <?php if($post_format != 'quote' && $post_format != 'video' && $post_format != 'gallery'): ?>
	        <div class="content-article entry-content">
	        		<?php the_excerpt(); ?>
	        		<a href="<?php the_permalink(); ?>" class="more-link"><span class="btn big filled pull-right read-more"><?php _e('Read More', ET_DOMAIN); ?></span></a>
	        </div>
	    <?php elseif($post_format == 'gallery'): ?>
	        <div class="content-article entry-content">
	            <?php echo $filtered_content; ?>
	        </div>
	    <?php endif; ?><?php */?>
    </div>
    <?php if(etheme_get_option('blog_byline') && etheme_get_option('blog_layout') == 'timeline'): ?>
        <div class="meta-post-timeline">
            <?php the_time(get_option('date_format')); ?> / 
            <?php the_time(get_option('time_format')); ?>
        </div>
    <?php endif; ?>
</article>