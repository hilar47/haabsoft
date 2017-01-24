<?php

//DEFINE VARIABLE TO STORE THE METABOX
$dir_path = get_stylesheet_directory().'/metaboxes/';
$content_page_meta = new WPAlchemy_MetaBox(array
(
	'id' => '_content_page_meta',
	'types' => array('page'),
	'template' => $dir_path . 'PAGE-meta.php',
));


