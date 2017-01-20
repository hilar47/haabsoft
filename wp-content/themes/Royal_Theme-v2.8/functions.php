<?php
global $etheme_theme_data;
$etheme_theme_data = wp_get_theme( get_stylesheet_directory() . '/style.css' );
require_once( get_template_directory() . '/framework/init.php' );


/* Custom Post - Videos */
// Register custom post types
add_action('init', 'my_custom_types');
function my_custom_types() {
//PERSON CUSTOM POST TYPE
register_post_type( 'videos',
	array(
		//LABELS FOR USE IN THE ADMIN
		'labels' => array(
		'name' => __( 'Videos' ),
		'singular_name' => __( 'Video' ),
		'add_new_item' => __( 'Add New Video' )
	),
	'exclude_from_search' => false,
	'public' => true,
	'has_archive' => true,
	'supports' => array('title','editor', 'thumbnail', 'excerpt', 'revisions', 'page-attributes'),
	'rewrite' => array('slug' => 'person'),
	)
);

//PERSON CUSTOM TAXONOMY VIDEO LABELS FOR USE IN THE ADMIN
$labels = array(
'name' => _x( 'Video Categories', 'taxonomy general name' ),
'singular_name' => _x( 'Video Category', 'taxonomy singular name' ),
'search_items' => __( 'Search Video Categories' ),
'all_items' => __( 'All Video Categories' ),
'parent_item' => __( 'Parent Video Category' ),
'parent_item_colon' => __( 'Parent Video Category:' ),
'edit_item' => __( 'Edit Video Category' ),
'update_item' => __( 'Update Video Category' ),
'add_new_item' => __( 'Add New Video Category' ),
'new_item_name' => __( 'New Video Category Name' ),
'menu_name' => __( 'Video Categories' ),
);

//OPTIONS FOR THE TAXONOMY
$args = array(
'hierarchical' => true,
'labels' => $labels,
'show_ui' => true,
'show_admin_column' => true,
'query_var' => true,
'rewrite' => array( 'slug' => 'video_category' ),
);

//REGISTER THE TAXONOMY WITH WORDPRESS
register_taxonomy( 'video_category', array( 'person' ), $args );
}