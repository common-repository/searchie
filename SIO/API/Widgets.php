<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
 * Widgets API.
 * @since 0.0.1
 * */
class SIO_API_Widgets {
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
	 * Display the part template.
	 * @param array $args {
	 *
	 * }
		* @return html
		*/
	public function show( $args = [] ) {
		$data = [];
		$get_data = $this->getOptions();
		$data = [
			'datas' => $get_data
		];

		SIO_View::get_instance()->admin_partials('settings/part/widgets.php', $data);
	}

	/**
	 * Get the API data.
	 *
	 * @param array $arg {
	 *    pass api parameters
	 *    @type string type the api type to pass.
	 * }
	 */
	public function get( $args= [] ) {
		$defaults = [
			'type' => 'widgets',
			'query_uri' => [
				'page' => isset($args['paged']) ? $args['paged'] : 1
			]
		];

		// Parse incoming $args into an array and merge it with $defaults
		$args = wp_parse_args( $args, $defaults );
		$ret = [
			'body' => '',
			'msg' => '',
			'status' => false,
			'http_code' => 0,
		];

		$res = SIO_API::get_instance()->get($args);

		if ( isset($res['http_code']) && $res['http_code'] == 200 ) {
			$body = json_decode($res['body']);
			$msg = $res['msg'];
			$ret = [
				'body' => $body,
				'msg' => $msg,
				'status' => true,
				'http_code' => $res['http_code'],
			];
		} else {
			$resBody = isset($res['body']) ?? [];
			$body = json_decode($resBody);
			$msg = $res['msg'] ?? '';

			$ret = [
				'body' => $body,
				'msg' => $msg,
				'status' => false,
				'http_code' => $res['http_code'] ?? '',
			];
		}

		return $ret;
	}

	/**
	 * store to options
	 */
	public function store() {
		$ret = $this->get();

		if ( $ret['status'] ) {

			$data = $ret['body']->data;

			SIO_MetaOption::get_instance()->widgets_data([
				'action' => 'u',
				'value' => $data
			]);
		} else {
			$ret = [];
		}

		return $ret;
	}

	/**
	 * Get the data in the WP.
	 * check first if its in the options table, if not get it in the API.
	 */
	public function getOptions() {

		return sio_get_data_widgets();

	}//getMeWP

}
