<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
 * Oauth.
 * @since 0.0.1
 * */
class SIO_API_Auth_Oauth {
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

  }

  /**
   * Authorize the oauth to get the code.
   *
   * @param array $arg {
   *  pass the settings for the authorization.
   *  @type int $client_id
   *  @type string $client_secret
   *  @type string $response_type
   *  @type string|url $redirect_uri
   * }
   * @return API|Bool|Array
   */
  public function setAuthorizeURL( $arg = [] ) {
    $url = '';
    if ( isset( $arg['url'] ) ) {
      $url = $arg['url'];
    }

    $client_id = false;
    if ( isset( $arg['client_id'] ) ) {
      $client_id = $arg['client_id'];
    }

    $client_secret = false;
    if ( isset( $arg['client_secret'] ) ) {
      $client_secret = $arg['client_secret'];
    }

    $response_type = 'code';
    if ( isset( $arg['response_type'] ) ) {
      $response_type = $arg['response_type'];
    }

    $redirect_url = '';
    if ( isset( $arg['redirect_url'] ) ) {
      $redirect_url = $arg['redirect_url'];
    }

    $auth_url = '';
    if ( isset( $arg['auth_url'] ) ) {
      $auth_url = $arg['auth_url'];
    }

    if ( $client_id && $client_secret ) {
      return $url . $auth_url . '?client_id=' . $client_id . '&client_secret=' . $client_secret . '&response_type=' . $response_type . '&redirect_uri=' . $redirect_url;
    }

    return false;

  }

  /**
   * Get the token from the auth code.
   *
   * @param array $arg {
   *  pass the settings for the authorization.
   *  @type int $client_id
   *  @type string $client_secret
   *  @type string $grant_type
   *  @type string $code the return code from the authorization.
   *  @type string|url $redirect_uri
   * }
   * @return API|Bool|Array
   */
  public function getToken( $arg = [] ) {
    $url = false;
    if ( isset( $arg['url'] ) ) {
      $url = $arg['url'] . $arg['token_url'];
    }
    if ( $url ) {
      $scope = isset( $arg['scope'] ) ? $arg['scope'] : '';
      $username = isset( $arg['username'] ) ? $arg['username'] : '';
      $password = isset( $arg['password'] ) ? $arg['password'] : '';
      $grant_type = isset( $arg['grant_type'] ) ? $arg['grant_type'] : 'password';
      $client_id = isset( $arg['client_id'] ) ? $arg['client_id'] : '';
      $client_secret = isset( $arg['client_secret'] ) ? $arg['client_secret'] : '';
      $args = [
        'body' => [
          'grant_type'    => $grant_type,
          'client_id'     => $client_id,
          'client_secret' => $client_secret,
          'scope'     		=> $scope,
          'username'   		=> $username,
          'password'   		=> $password,
        ]
      ];

      $res = SIO_HTTP_WP::get_instance()->post( $url, $args );

      return $res;
    }
    return false;
  }

}
