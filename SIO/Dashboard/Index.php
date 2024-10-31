<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
 *
 */
class SIO_Dashboard_Index {

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

	public function title() {
	return 'Dashboard';
	}

	public function show_dashboard( $arg = [] ) {
		$data = isset($arg['data']) ? $arg['data'] : [];
		if ( sio_has_token() ) {
			SIO_View::get_instance()->admin_partials('dashboard/index.php', $data);
		} else {
			SIO_View::get_instance()->admin_partials('login.php', $data);
		}
	}

	public function __construct() {

	}

}
