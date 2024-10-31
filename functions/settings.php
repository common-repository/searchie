<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

function sio_get_media_datasource() {
  $media_data_source = SIO_MetaOption::get_instance()->media_datasource([
    'action' => 'r',
  ]);
  return $media_data_source ? $media_data_source : 'live';
}

function sio_get_widget_datasource() {
  $data_source = SIO_MetaOption::get_instance()->widget_datasource([
    'action' => 'r',
  ]);
  return $data_source ? $data_source : 'live';
}

function sio_get_playlist_datasource() {
  $data_source = SIO_MetaOption::get_instance()->playlist_datasource([
    'action' => 'r',
  ]);
  return $data_source ? $data_source : 'live';
}

function sio_get_audience_status() {
	$audience = SIO_MetaOption::get_instance()->audience_status([
    'action' => 'r',
  ]);
	return $audience ? $audience : 'disable';
}
