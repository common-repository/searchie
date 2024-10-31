<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
 * Pagination API.
 * @since 0.0.1
 * */
class SIO_API_Pagination {
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

	public function parse_url( $links ) {

		$links_arr = [
			'first' => '',
			'prev' => '',
			'next' => '',
			'last' => '',
		];

		if ( $links->first != '' ) {
			$url_first = parse_url($links->first);
			if ( isset( $url_first['query'] ) ) {
				parse_str($url_first['query'], $url_query);
				$links_arr['first'] = $url_query['page'];
			}
		}

		if ( $links->prev != '' ) {
			$url_prev = parse_url($links->prev);
			if ( isset( $url_prev['query'] ) ) {
				parse_str($url_prev['query'], $url_query);
				$links_arr['prev'] = $url_query['page'];
			}
		}

		if ( $links->next != '' ) {
			$url_next = parse_url($links->next);
			if ( isset( $url_next['query'] ) ) {
				parse_str($url_next['query'], $url_query);
				$links_arr['next'] = $url_query['page'];
			}
		}

		if ( $links->last != '' ) {
			$url_last = parse_url($links->last);
			if ( isset( $url_last['query'] ) ) {
				parse_str($url_last['query'], $url_query);
				$links_arr['last'] = $url_query['page'];
			}
		}

		return $links_arr;
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
		$links = $args['links'];
		$url_links = $this->parse_url( $links );
		$data = [
			'url_links' => $url_links,
			'link_href' => $args['link_href']
		];
		SIO_View::get_instance()->admin_partials('dashboard/pagination.php', $data);
	}



}
