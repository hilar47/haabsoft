<?php

$custom_checkbox_mb = new WPAlchemy_MetaBox(array
(
	'id' => '_custom_checkbox_meta',
	'title' => 'Add Images',
    'types' => array('casestudies'),
	'template' => get_stylesheet_directory() . '/metaboxes/checkbox-meta.php',
));

/* eof */