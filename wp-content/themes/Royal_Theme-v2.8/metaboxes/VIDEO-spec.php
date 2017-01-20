<?php

//DEFINE VARIABLE TO STORE THE METABOX
$dir_path = get_stylesheet_directory().'/metaboxes/';
$content_item_meta = new WPAlchemy_MetaBox(array
(
	'id' => '_content_item_meta',
	'types' => array('videos'),
	'template' => $dir_path . 'VIDEO-meta.php',
));


