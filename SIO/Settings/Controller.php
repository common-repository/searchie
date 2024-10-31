<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
 * Controller for the settings page.
 * @since 1.0.0
 * */
class SIO_Settings_Controller extends SIO_Base {
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

	public function set_audience() {
		$set_audience_set = isset($_POST['audience_status']) ? sanitize_text_field($_POST['audience_status']) : 'disable';
		SIO_MetaOption::get_instance()->audience_status([
			'action' => 'u',
			'value'   => $set_audience_set
		]);
		sio_redirect_to( admin_url('?page=searchie-settings') );
	}

  public function set_sync_media() {
		$set_sync_media_post = isset($_POST['media-datasource']) ? sanitize_text_field($_POST['media-datasource']) : 'live';
		SIO_MetaOption::get_instance()->media_datasource([
			'action' => 'u',
			'value'   => $set_sync_media_post
		]);
		if ( $set_sync_media_post == 'local' ) {
			SIO_Media_Index::get_instance()->sync();
		}
		sio_redirect_to( admin_url('?page=searchie-settings') );
	}

	public function set_sync_widgets() {
		$set_sync_widget_post = isset($_POST['widget-datasource']) ? sanitize_text_field($_POST['widget-datasource']) : 'live';
		SIO_MetaOption::get_instance()->widget_datasource([
			'action' => 'u',
			'value'   => $set_sync_widget_post
		]);
		if ( $set_sync_widget_post == 'local' ) {
			SIO_Widgets_Index::get_instance()->sync();
		}
		sio_redirect_to( admin_url('?page=searchie-settings') );
	}

	public function set_sync_playlist() {
		$set_sync = isset($_POST['playlist-datasource']) ? sanitize_text_field($_POST['playlist-datasource']) : 'live';
		SIO_MetaOption::get_instance()->playlist_datasource([
			'action' => 'u',
			'value'   => $set_sync
		]);
		if ( $set_sync == 'local' ) {
			SIO_Playlists_Index::get_instance()->sync();
		}
		sio_redirect_to( admin_url('?page=searchie-settings') );
	}

	public function searchie_settings() {
		$data = [];
    add_filter('searchie-right-content-title', [SIO_Settings_Index::get_instance(), 'title']);
    add_action('searchie-dashboard-right-content', [SIO_Settings_Index::get_instance(), 'content']);
    SIO_Dashboard_Index::get_instance()->show_dashboard();
	}

	public function connect_searchie() {
		$data = [];
    $args = SIO_API_Config::get_instance()->get();

		$data = [
      'msg' => false
    ];

		$args['username'] = false;
		if ( isset($_POST['username']) && $_POST['username'] !== '' ) {
			$args['username'] = $_POST['username'];
		}

		$args['password'] = false;
		if ( isset($_POST['password']) && $_POST['password'] !== '' ) {
			$args['password'] = $_POST['password'];
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
				SIO_API_Files::get_instance()->store();
				SIO_API_Widgets::get_instance()->store();

				sio_redirect_to( admin_url('?page=Searchie') );
      } else {
        $data['msg'] = json_decode($res_token['body']);
      }

		} else {
			$error = [
				'error' => '',
				'message' => 'Wrong Username or Password',
			];

			$data['msg'] = (object)$error;
		}

		SIO_View::get_instance()->admin_partials('settings/index.php', $data);

	}
  /**
   * Index
   */
  public function searchie() {
    $data = [];
    $config = SIO_API_Config::get_instance()->get();
    $data = [
      'msg' => false
    ];
    //SIO_View::get_instance()->admin_partials('dashboard/settings/index-v1.php', $data);
    SIO_View::get_instance()->admin_partials('dashboard/index.php', $data);
  }

	public function login() {
		$data = [];
		SIO_View::get_instance()->admin_partials('login.php', $data);
	}

  public function getme() {

    $ret_me = SIO_API_Profile::get_instance()->getMeWP();
		$this->searchie();
  }

  public function getfiles() {

    $ret_me = SIO_API_Files::get_instance()->store();

		$this->searchie();
  }

	public function getwidgets() {
		$ret_me = SIO_API_Widgets::get_instance()->store();

		$this->searchie();
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
