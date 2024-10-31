<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
 * Notices
 */
class SIO_Notices {

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

  /**
	 * Initializes the plugin by setting filters and administration functions.
	 */
	public function __construct() {

	}

  public function error($messages = []) {
    if ( !is_array($messages) ) {
      $messages = (array)$messages;
    }
    $data = [
      'messages' => $messages,
      'notice' => 'error'
    ];

    SIO_View::get_instance()->admin_partials('notices/notice.php', $data);
  }

}
