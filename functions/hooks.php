<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

add_action('admin_head', 'sio_head_admin_css');

function sio_head_admin_css() {
	$url = sio_get_plugin_dir_url();
	$asset_img_media_placeholder = $url . '/assets/img/video-placeholder.png';
  echo '<style>
    .sio-editor-iframe-container{
			background-image:url('.$asset_img_media_placeholder.');
			-webkit-background-size: contain;
	    -moz-background-size: contain;
	    -o-background-size: contain;
	    background-size: contain;
		}
  </style>';
}
