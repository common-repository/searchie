<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
 *
 */
class SIO_Dashboard_NavMenu {

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

	private function nav() {
		$nav = [
			[
				'id' => 'searchie-media',
				'name' => 'Media',
				'link' => admin_url('?page=searchie-media'),
			],
			[
				'id' => 'searchie-playlists',
				'name' => 'Playlists',
				'link' => admin_url('?page=searchie-playlists'),
			],
			[
				'id' => 'searchie-widgets',
				'name' => 'Widgets',
				'link' => admin_url('?page=searchie-widgets'),
			],
			[
				'id' => 'searchie-settings',
				'name' => 'Settings',
				'link' => admin_url('?page=searchie-settings'),
			],
		];

		return $nav;
	}

	public function show() {
		$data = [];

		$data = [
			'navs' => $this->nav(),
			'current_page' => isset($_GET['page']) ? sanitize_text_field( $_GET['page'] ) : ''
		];
		SIO_View::get_instance()->admin_partials('dashboard/nav.php', $data);
	}

	public function __construct() {
		add_action('searchie-dashboard-sidebar-content', [$this, 'show'], 10);
	}

}
