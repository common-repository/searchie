<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
* functions for the widgets api
**/

/**
*
* get the widgets
* @param array $args {
*		Array of arguments.
* }
* @return array | object
*/
function sio_get_api_widgets( $args = [] ) {
	$ret = new SIO_API_Widgets;
	$widgets = $ret->get( $args );
	return $widgets;
}

function sio_get_data_widgets( $args = [] ) {
	$data_source = sio_get_widget_datasource();
	if ( $data_source == 'live' ) {
		$ret = new SIO_API_Widgets;
		$widgets = $ret->get( $args );
		return $widgets['body']->data ?? [];
	} elseif ( $data_source == 'local' ) {
		return sio_get_local_widgets();
	}
}

function sio_store_widgets( $arr_files = [] ) {
	SIO_MetaOption::get_instance()->widgets_data([
		'action' => 'u',
		'value' => $arr_files
	]);
}

function sio_get_local_widgets() {
	$get_data = SIO_MetaOption::get_instance()->widgets_data([
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
