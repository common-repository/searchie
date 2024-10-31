<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
* functions for the widgets api
**/

/**
*
* get the playlist
* @param array $args {
*		Array of arguments.
* }
* @return array | object
*/
function sio_get_api_playlist( $args = [] ) {
	$ret = new SIO_API_Playlists;
	$widgets = $ret->get( $args );
	return $widgets;
}

function sio_get_data_playlist( $args = [] ) {
	$data_source = sio_get_widget_datasource();
	if ( $data_source == 'live' ) {
		$ret = new SIO_API_Playlists;
		$widgets = $ret->get( $args );
		return $widgets['body']->data;
	} elseif ( $data_source == 'local' ) {
		return sio_get_local_playlist();
	}
}

function sio_store_playlist( $arr_files = [] ) {
	SIO_MetaOption::get_instance()->playlists_data([
		'action' => 'u',
		'value' => $arr_files
	]);
}

function sio_get_local_playlist() {
	$get_data = SIO_MetaOption::get_instance()->playlists_data([
		'action' => 'r',
		'single' => 'true'
	]);

	$get_data_array = [];
	if ( $get_data ) {
		foreach( $get_data as $key => $val ) {
			if ( is_array( $val ) ) {
				foreach( $val  as $val_array ) {
					$get_data_array[] = $val_array;
				}
			} else {
				$get_data_array[] = $val;
			}
		}
	}

	return $get_data_array;
}
