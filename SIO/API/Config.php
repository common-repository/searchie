<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
 * Config or settings of the API.
 * @since 0.0.1
 * */
class SIO_API_Config {
  /**
	 * instance of this class
	 *
	 * @since 0.0.1
	 * @access protected
	 * @var	null
	 * */
	protected static $instance = null;

  protected $url = SIO_API_URL;
  protected $version = 'v1';
  protected $api_endpoint = 'api';
  protected $auth_url = 'oauth/authorize';
  protected $token_url = 'oauth/token';
  protected $redirect_url;
  protected $client_id = SIO_API_CLIENT_ID;
  protected $client_secret = SIO_API_CLIENT_SECRET;

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
   * Get the config.
   *
   * @return array
   */
  public function get() {
    $config = [
      'url'           => $this->getUrl(),
      'version'       => $this->getVersion(),
      'api_endpoint'  => $this->getAPIEndPoint(),
      'api_url'       => $this->getAPIURL(),
      'auth_url'      => $this->getAuthURL(),
      'redirect_url'  => $this->getRedirectURL(),
      'token_url'     => $this->getTokenURL(),
      'client_id'     => $this->getClientID(),
      'client_secret' => $this->getClientSecret(),
    ];

    return $config;
  }

  /**
   * get the URL.
   */
  public function getUrl() {
    return $this->url;
  }

  /**
   * get API End Point.
   */
  public function getAPIEndPoint() {
    return $this->api_endpoint;
  }

  /**
   * get API URL.
   */
  public function getAPIURL() {
    return $this->getUrl() . $this->getAPIEndPoint() .'/'. $this->getVersion() . '/';
  }

  /**
   * get the API version.
   */
  public function getVersion() {
    return $this->version;
  }

  /**
   * get the Auth URL.
   */
  public function getAuthURL() {
    return $this->auth_url;
  }

  /**
   * get the Token URL.
   */
  public function getTokenURL() {
    return $this->token_url;
  }

  /**
   * get the Redirect URL.
   */
	 public function getRedirectURL() {
     return admin_url('?page=Searchie');
   }

  /**
   * get the Client ID.
   */
  public function getClientID() {
    return $this->client_id;
  }

  /**
   * get the Client Secret.
   */
  public function getClientSecret() {
    return $this->client_secret;
  }

}
