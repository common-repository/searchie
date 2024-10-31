<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
 * Set Of API.
 * @since 0.0.1
 * */
class SIO_API {
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
   * Set the headr auth api.
   *
   * @param array $args {
   *    pass api parameters
   *    @type string $token
   * }
   */
  public function setAuthHeader( $args = [] ) {
    $token = isset($args['token']) ? $args['token'] : false;
    if ( $token ) {
      $args_header = 'Bearer ' . $token;
      return $args_header;
    }
    return false;
  }

  public function getToken() {
    $token = SIO_MetaOption::get_instance()->auth_token_body([
      'action' => 'r'
    ]);

    $token_decode = json_decode($token);
    return $token_decode;
  }

  /**
   * Get HTTP.
   *
   * @param array $arg {
   *    pass api parameters, expected are:
   *    @type string $access_token api access token.
   *    @type string $refresh_token api refresh token.
   *    @type string $type the api name to get.
   * }
   */
  public function get( $args = [] ) {

    $get_token = $this->getToken();

    $access_token = isset($get_token->access_token) ? $get_token->access_token : false;
    $config = $config = SIO_API_Config::get_instance()->get();
    if ( $access_token ) {
      $defaults = [
        'headers' => [
          'Authorization' => 'Bearer ' . $access_token,
        ]
      ];

      // Parse incoming $args into an array and merge it with $defaults
      $args = wp_parse_args( $args, $defaults );

      $type = $args['type'];
			$query_uri = '';
			if ( isset( $args['query_uri'] ) ) {
				$query_uri = '/?' . urldecode( http_build_query( $args['query_uri'] ) );
			}
      $remote_url = $config['api_url'] . $type . $query_uri;
      $result = SIO_HTTP_WP::get_instance()->get( $remote_url, $args );

      return $result;
    }
    return false;
  }

}
