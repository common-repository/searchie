<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
 *
 */
class SIO_Dashboard_Profile {

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

	public function show() {
		SIO_API_Profile::get_instance()->show();
	}

	public function __construct() {
		add_action('searchie-after-dashboard-sidebar-content', [$this, 'show'], 10);
	}

}
