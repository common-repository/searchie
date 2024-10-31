<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
 * Header Auth API.
 * @since 0.0.1
 * */
class SIO_API_HeaderAuth {
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
   * Set the headr auth api.
   *
   * @param array $arg {
   *    pass api parameters
   *    @type string $token
   * }
   */
  public function set( $arg = [] ) {
    $token = isset($arg['token']) ? $arg['token'] : false;
    if ( $token ) {
      $args_header = [
        'headers' => [
          'Authorization' => 'Bearer ' . $token,
        ]
      ];
      return $args_header;
    }
    return false;
  }

}
