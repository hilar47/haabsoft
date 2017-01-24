<?php

//DEFINE VARIABLE TO STORE THE METABOX
$dir_path = get_stylesheet_directory().'/metaboxes/';
//$title = '';
//print_r($post);
//echo "common man";


$content_media_meta = new WPAlchemy_MetaBox(array
(
	//'title' => $title,
	'id' => '_content_media_meta',		//UNIQUE ID FOR THIS META BOX
	'types' => array('social_networking'), 		//LIMIT TO ONLY SHOW ON person CUSTOM POST TYPE
	'template' => $dir_path . 'PAGE-meta.php',	//WHERE THE METABOX TEMPLATE IS FOR THIS METABOX
));


