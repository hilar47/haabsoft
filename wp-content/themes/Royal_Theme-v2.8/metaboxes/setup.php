<?php

include_once WP_CONTENT_DIR . '/wpalchemy/MediaAccess.php';
$wpalchemy_media_access = new WPAlchemy_MediaAccess();
/*include_once WP_CONTENT_DIR . '/wpalchemy/MetaBox.php';
include_once WP_CONTENT_DIR . '/wpalchemy/MediaAccess.php';
$wpalchemy_media_access = new WPAlchemy_MediaAccess();

// global styles for the meta boxes
if (is_admin()) add_action('admin_enqueue_scripts', 'metabox_style');

function metabox_style() {
	wp_enqueue_style('wpalchemy-metabox', get_stylesheet_directory_uri() . '/metaboxes/meta.css');
}*/

// include the class in your theme or plugin
include_once WP_CONTENT_DIR . '/wpalchemy/MetaBox.php';
// include css to help style our custom meta boxes
add_action( 'init', 'my_metabox_styles' );
function my_metabox_styles(){
	
	if ( is_admin() ) { 
		wp_enqueue_style( 'wpalchemy-metabox', get_stylesheet_directory_uri() . '/metaboxes/meta.css' );
	}
}
$dir_path = get_stylesheet_directory().'/metaboxes/';
$content_item_meta = new WPAlchemy_MetaBox(array
(
'id' => '_content_item_meta',
'title' => 'My Custom Meta',
	'types' => array('videos'),
'template' => $dir_path . 'VIDEO-meta.php',
));

/* eof */