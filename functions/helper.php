<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
*
* $search = 'test*';
* print_r( sio_array_key_exists_wildcard( $array, $search ) );
* print_r( sio_array_key_exists_wildcard( $array, $search, 'key-value' ) )
*
**/
function sio_array_key_exists_wildcard ( $array, $search, $return = '' ) {
    $search = str_replace( '\*', '.*?', preg_quote( $search, '/' ) );
    $result = preg_grep( '/^' . $search . '$/i', array_keys( $array ) );
    if ( $return == 'key-value' )
        return array_intersect_key( $array, array_flip( $result ) );
    return $result;
}

/**
* $search = 'b*';
* print_r( sio_array_value_exists_wildcard( $array, $search ) );
* print_r( sio_array_value_exists_wildcard( $array, $search, 'key-value' ) );
**/
function sio_array_value_exists_wildcard ( $array, $search, $return = '' ) {
    $search = str_replace( '\*', '.*?', preg_quote( $search, '/' ) );
    $result = preg_grep( '/^' . $search . '$/i', array_values( $array ) );
    
	if ( $return == 'key-value' ) {
        return array_intersect( $array, $result );
	}

    return $result;
}

function sio_search_arr_values($search, $res_array) {
	return preg_grep('/'.$search.'/i', $res_array);
}

function sio_img_default() {
	return sio_get_plugin_dir_url() . 'assets/img/api-thumb.png';
}

/**
* $size = small or big
**/
function sio_api_thumb( $obj, $size = 'small') {
	$thumb_url = sio_img_default();
	if ( isset( $obj->thumbnail ) && $obj->thumbnail != '' && isset( $obj->thumbnail->$size ) ) {
		$thumb_url = $obj->thumbnail->$size;
	}
	return $thumb_url;
}

function _sio_api_thumb($thumb_url = null) {
	if ( !is_null($thumb_url)) {
		return $thumb_url;
	} else {
		return sio_img_default();
	}
}
function sio_limit_str($str, $limit = 50) {
	if ( strlen($str) > 55 ) {
		$str = substr($str, 0, 55) . '...';
	}
	return $str;
}

function sio_dd( $arr = [], $exit = false ) {
  echo '<pre>';
  print_r($arr);
  echo '</pre>';
	if ( $exit )
	{
		exit();
	}
}

/**
 * check if has token saved.
 */
function sio_has_token() {
	$get_token = SIO_MetaOption::get_instance()->auth_token_body([
		'action' => 'r'
	]);

	return $get_token ? $get_token : false;
}

/**
 * check if the api me data is already stored.
 */
function sio_has_me_data() {
	$get = SIO_MetaOption::get_instance()->me_data([
		'action' => 'r'
	]);

	return $get ? $get : false;
}

/**
 * Get the files thumbnail url.
 *
 *
 */
function sio_get_files_thumb_url($thumb_url) {
	$path = parse_url($thumb_url);
	if ( $path ) {
		return $path['scheme'] . '://' . $path['host'] . $path['path'];
	}
	return false;
}

function sio_redirect_to($url) {
	?>
	<script type="text/javascript">
		window.location = '<?php echo $url; ?>';
	</script>
	<?php
	die();
}

function sio_exclude_this()
{
	$elementor = new SIO_Exclude_Elementor();
	$thrive_architect = new SIO_Exclude_ThriveArchitect();

	$getExcludes = [
		$elementor,
		$thrive_architect
	];

	$exclude = new SIO_Exclude_Init();

	if( $exclude->exclude($getExcludes) == 0  ){
		return true;
	}
	return false;
}

function sio_is_valid_json($string = '')
{
	json_decode($string);
	return json_last_error() === JSON_ERROR_NONE;
}