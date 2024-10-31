<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
 * Controller for the settings page.
 * @since 1.0.0
 * */
class SIO_Media_Controller extends SIO_Base {
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
	 * @since     1.0.0
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

	public function sync() {
		SIO_Media_Index::get_instance()->sync();
		sio_redirect_to( admin_url('?page=searchie-media') );
	}

	public function search_files() {
		$ret = [];

		add_filter('searchie-right-content-title', [SIO_Media_Index::get_instance(), 'title']);
    	add_action('searchie-dashboard-right-content', [SIO_Media_Index::get_instance(), 'search_media']);
    	SIO_Dashboard_Index::get_instance()->show_dashboard();
	}

  public function searchie_media() {
    $data = [];
    add_filter('searchie-right-content-title', [SIO_Media_Index::get_instance(), 'title']);
    add_action('searchie-dashboard-right-content', [SIO_Media_Index::get_instance(), 'content']);
    SIO_Dashboard_Index::get_instance()->show_dashboard();
  }

	/**
	 * Controller
	 *
	 * @param	$action		string | empty
	 * @parem	$arg		array
	 * 						optional, pass data for controller
	 * @return mix
	 * */
	public function controller($action = '', $arg = array()){
		$this->call_method($this, $action);
	}

	public function __construct(){}

}
