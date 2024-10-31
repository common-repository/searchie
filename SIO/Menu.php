<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
 * Add Menu on WordPress.
 * @since 0.0.1
 * */
class SIO_Menu {
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
    add_action( 'admin_menu', [$this, 'init'] );
  }

  /**
   * Initialize menu page.
   */
  public function init() {
    $textdomain = sio_get_text_domain();
    $details = sio_get_plugin_details();
		//root url
		//$details['Name']
    add_menu_page(
        __( 'Searchie', $textdomain ),
        'Searchie',
        'publish_posts',
        $details['Name'],
        [SIO_Dashboard_Controller::get_instance(), 'controller'],
        SEARCHIE_PLUGIN_URL . 'assets/img/searchie-symbol.png',
        6
    );
		add_submenu_page(
        '',
        __( 'Media', $textdomain ),
        'Media',
        'publish_posts',
        'searchie-media',
        [SIO_Media_Controller::get_instance(), 'controller']
    );
		add_submenu_page(
        '',
        __( 'Playlists', $textdomain ),
        __( 'Playlists', $textdomain ),
        'publish_posts',
        'searchie-playlists',
        [SIO_Playlists_Controller::get_instance(), 'controller']
    );
		add_submenu_page(
        '',
        __( 'Widgets', $textdomain ),
        __( 'Widgets', $textdomain ),
        'publish_posts',
        'searchie-widgets',
        [SIO_Widgets_Controller::get_instance(), 'controller']
    );
		add_submenu_page(
        '',
        __( 'Settings', $textdomain ),
        __( 'Settings', $textdomain ),
        'publish_posts',
        'searchie-settings',
        [SIO_Settings_Controller::get_instance(), 'controller']
    );
  }

}
