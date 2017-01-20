<?php
/**
 * Plugin Name: Video
 * Version: 0.1.0
 */

/* Place custom code below this line. */

// Register the Video Post Type

//GET METABOX DATA
//global $content_home_meta;

 
function register_videos() {
 
    $labels = array(
        'name' => _x( 'Video', 'video' ),
        'singular_name' => _x( 'Video', 'video' ),
        'add_new' => _x( 'Add New Video', 'video' ),
        'add_new_item' => _x( 'Add New Video', 'video' ),
        'edit_item' => _x( 'Edit Video', 'videos' ),
        'new_item' => _x( 'New Video', 'videos' ),
        'view_item' => _x( 'View Video', 'videos' ),
        'search_items' => _x( 'Search Video', 'videos' ),
        'not_found' => _x( 'No Video(s) found', 'videos' ),
        'not_found_in_trash' => _x( 'No Video(s) found in Trash', 'videos' ),
        'parent_item_colon' => _x( 'Parent Video(s):', 'videos' ),
        'menu_name' => _x( 'Video', 'videos' ),
    );
 
    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'description' => 'Video Filtered By Awards Category',
        'supports' => array( 'title', 'thumbnail', 'page-attributes','editor'),
        'taxonomies' => array( 'videos_category' ),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-video-alt2',
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => true,
        'capability_type' => 'post'
    );
 
    register_post_type( 'videos', $args );
}
 
add_action( 'init', 'register_videos' );
function videos_taxonomy() {
    register_taxonomy(
        'videos_category',
        'videos',
        array(
            'hierarchical' => true,
            'label' => 'Video Category',
            'query_var' => true,
            'rewrite' => array(
                'slug' => 'video_category',
                'with_front' => false
            )
        )
    );
    register_taxonomy(
        'videos_subcategory',
        'videos',
        array(
            'hierarchical' => true,
            'label' => 'Video SubCategory',
            'query_var' => true,
            'rewrite' => array(
                'slug' => 'video_subcategory',
                'with_front' => false
            )
        )
    );
}
add_action( 'init', 'videos_taxonomy');

/*function custom_expert_title( $input ) {

    global $post_type;
    
    if( is_admin() && 'Enter title here' == $input && 'expert_rec_slider' == $post_type )
        return 'Enter Expert Name, Qualification';

    return $input;
}
add_filter('gettext','custom_expert_title');*/

function generate_videos_html($atts) {
	extract(shortcode_atts(array(
		'show_items'		=> '7',
		'ord_by'			=> 'date'
	), $atts));
	
	$random_id = wp_rand();
	$order_by = ($ord_by=='date') ? 'date' : $ord_by ;
	$order = ($ord_by=='date') ? 'desc' : 'asc' ;
	
	$args = array(
		'post_type' 		=> 'videos',
		'orderby' 			=> $order_by,
		'order'   			=> $order,
		'post_status' 		=> 'publish',
		'posts_per_page' 	=> -1,
		'caller_get_posts'	=> 1
	);
	
	$my_query = null;
	$output = '';
	$draw_items = '';
	
	if($show_items == 5){
		$draw_items = 2;
	}
	elseif ($show_items > 6){
		$draw_items = 1;
	}
	else{
		$draw_items = 12/$show_items;
	}
	$my_query = new WP_Query($args);
	if( $my_query->have_posts() ) {
		
		while ($my_query->have_posts()) : $my_query->the_post();
			$id = get_the_ID();
			//global $content_item_meta;
			$meta = get_post_meta($id, '_content_item_meta', true);
			$video_upload='';
			if(isset($meta["video_upload"])){
				$video_upload .= '<video width="400" controls><source src="'.$meta["video_upload"].'" type="video/mp4"></video>';
			}
			$output .= '<div class="col-xs-6 col-sm-' . $draw_items . '">';
			$output .= $video_upload;
			$output .= '</div>';//Closing of col-xs-6 col-sm-
			
		endwhile;
		
	}
	wp_reset_query();  // Restore global post data stomped by the_post().
	//$output = 'testing';
	return $output; //Return the html code to the do shortcode function
}
add_shortcode('videos', 'generate_videos_html');


/* Place custom code above this line. */
?>