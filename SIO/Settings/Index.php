<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
 *
 */
class SIO_Settings_Index {

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
    return 'Settings';
  }

  public function content( $arg = [] ) {
    $data = isset($arg['data']) ? $arg['data'] : [];

		//$widgets = SIO_API_Widgets::get_instance()->get($api_widgets_args);
		$widgets = sio_get_data_widgets();

		$data = [
			'datas' => $widgets
		];

    SIO_View::get_instance()->admin_partials('dashboard/settings/index.php', $data);
  }

  public function __construct() {

  }

}
