<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
 * Controller for the settings page.
 * @since 1.0.0
 * */
class SIO_Dashboard_Controller extends SIO_Base {
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

	public function disconnect() {
		SIO_MetaOption::get_instance()->auth_token_raw([
			'action' => 'd'
		]);

		SIO_MetaOption::get_instance()->auth_token_body([
			'action' => 'd'
		]);
		sio_redirect_to( admin_url('?page=Searchie') );
	}

	public function connect_searchie() {
		$data = [];
		$args = SIO_API_Config::get_instance()->get();

		$data = [
			'msg' => false
		];

		$args['username'] = false;
		if ( isset($_POST['user_login']) && $_POST['user_login'] !== '' ) {
			$args['username'] = $_POST['user_login'];
		}

		$args['password'] = false;
		if ( isset($_POST['user_pass']) && $_POST['user_pass'] !== '' ) {
			$args['password'] = $_POST['user_pass'];
		}

		if ( $args['username'] && $args['password'] ) {
			$res_token = SIO_API_Auth_Oauth::get_instance()->getToken( $args );

		if ( $res_token && $res_token['http_code'] == 200 ) {
			SIO_MetaOption::get_instance()->auth_token_raw([
			'action' => 'u',
			'value' => $res_token
			]);

			SIO_MetaOption::get_instance()->auth_token_body([
			'action' => 'u',
			'value' => $res_token['body']
			]);

			$data['msg'] = 'Successfully connected to Searchie';

					SIO_API_Profile::get_instance()->store();
					// SIO_API_Files::get_instance()->store();
					// SIO_API_Widgets::get_instance()->store();

					sio_redirect_to( admin_url('?page=searchie-media') );
		} else {
			$msg = json_decode($res_token['body']);
					$data['msg'][] = $msg->error_description;
		}

		} else {
			$data['msg'][] = 'Wrong Username or Password';
		}

		SIO_View::get_instance()->admin_partials('login.php', $data);

	}

	/**
	 * Index
	 */
	public function _searchie() {
	$data = [];

		add_filter('searchie-right-content-title', [SIO_Dashboard_Index::get_instance(), 'title']);
		SIO_Dashboard_Index::get_instance()->show_dashboard();
	}

	public function searchie() {
		sio_redirect_to( admin_url('?page=searchie-media') );
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
