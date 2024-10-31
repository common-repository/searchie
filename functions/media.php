<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
* functions for the media api
**/

/**
*
* get the media
* @param array $args {
*		Array of arguments.
* }
* @return array | object
*/
function sio_get_media( $args = [] ) {

  $file = new SIO_API_Files;
  return $file->get( $args );

}

function sio_store_media_files( $arr_files = [] ) {
	SIO_MetaOption::get_instance()->files_data([
		'action' => 'u',
		'value' => $arr_files
	]);
}

function sio_get_local_media() {
	$get_data = SIO_MetaOption::get_instance()->files_data([
		'action' => 'r',
		'single' => 'true'
	]);

	$get_data_array = [];
	if ( $get_data ) {
		foreach( $get_data as $key => $val ) {
			// if ( is_array( $val ) ) {
			// 	foreach( $val  as $val_array ) {
			// 		$get_data_array[] = $val_array;
			// 	}
			// }
			$get_data_array[] = $val;
		}
	}

	return $get_data_array;
}
