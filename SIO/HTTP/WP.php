<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
 * Use HTTP in WP.
 * @since 0.0.1
 * */
class SIO_HTTP_WP {
  /**
	 * instance of this class
	 *
	 * @since 0.0.1
	 * @access protected
	 * @var	null
	 * */
	protected static $instance = null;

	/**
	 * Return an instance of this class.
	 *
	 * @since     0.0.1
	 *
	 * @return    object    A single instance of this class.
	 */
	public static function get_instance() {

		/*
		 * - Uncomment following lines if the admin class should only be available for super admins
		 */
		/* if( ! is_super_admin() ) {
			return;
		} */

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	public function __construct() {
  }

  /**
   * Performs HTTP get request using GET Method and returns its reponse.
   *
   * @see https://developer.wordpress.org/reference/functions/wp_remote_get/
   * @param string $url
   * @param array $arg_options {
   *  use for http or get options
   *  see url for more options.
   * }
   * @return array|WP_Error
   */
  public function get( $url, $arg_options = [] ) {
		$defaults = array (
        'timeout' => 120,
    );
    // Parse incoming $args into an array and merge it with $defaults
    $arg_options = wp_parse_args( $arg_options, $defaults );

    $response = wp_remote_get( $url, $arg_options );
    $http_code = wp_remote_retrieve_response_code( $response );

    if ( is_wp_error( $response ) ) {
        $error_message = $response->get_error_message();
        return [
          'status' => false,
          'http_code' => $http_code,
          'body' => wp_remote_retrieve_body($response),
          'msg' => $error_message
        ];
    } else {
      return [
        'status' => true,
        'http_code' => $http_code,
        'body' => wp_remote_retrieve_body($response),
        'msg' => ''
      ];
    }
    return false;
  }

  /**
   * Performs an HTTP request using the POST method and returns its response.
   *
   * @see https://developer.wordpress.org/reference/functions/wp_remote_post/
   * @param string $url
   * @param array $arg_options {
   *  use for http or get options
   *  see url for more options.
   * }
   * @return array|WP_Error
   */
  public function post( $url, $arg_options = [] ) {
		$defaults = array (
        'timeout' => 120,
    );
    // Parse incoming $args into an array and merge it with $defaults
    $arg_options = wp_parse_args( $arg_options, $defaults );
    $response   = wp_remote_post( $url, $arg_options );
    $http_code  = wp_remote_retrieve_response_code( $response );

    if ( is_wp_error( $response ) ) {
        $error_message = $response->get_error_message();
        return [
          'status' => false,
          'http_code' => $http_code,
          'body' => wp_remote_retrieve_body($response),
          'msg' => $error_message
        ];
    } else {
      return [
        'status' => true,
        'http_code' => $http_code,
        'body' => wp_remote_retrieve_body($response),
        'msg' => ''
      ];
    }
    return false;
  }

}
