<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
 *
 */
class SIO_Media_Ajax {

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

  public function media_embed( $arg = [] ) {
    $embed_url = false;
    if ( isset( $_GET['embed_url'] ) ) {
      $embed_url = sanitize_text_field( $_GET['embed_url'] );
      $title = isset( $_GET['title'] ) ? sanitize_text_field( $_GET['title'] ) : '';
      $data = [
        'embed_url' => $embed_url,
        'width' => 560,
        'height' => 315,
        'title' => $title,
        'css_inline' => 'width:100%;height:70%;',
      ];
      SIO_View::get_instance()->admin_partials('dashboard/media/preview-modal.php', $data);
    }

		wp_die();
  }

	public function search_files() {
		$action = false;

		$json_ret = [
			'data' => []
		];

		if ( isset( $_GET['action'] ) ) {
			$action = sanitize_text_field( $_GET['action'] );
		} elseif ( isset( $_POST['action'] ) ) {
			$action = sanitize_text_field( $_POST['action'] );
		}

		if ( $action ) {
			$search = sanitize_text_field($_GET['search']);

			$media_data_source = sio_get_media_datasource();
			if ( $media_data_source == 'live' ) {
				$res = SIO_API_Files::get_instance()->search(['search'=>$search]);

				if ( $res['http_code'] == 200 && $res['body']->meta->total > 0 ) {
					$json_ret['data'] = $res['body']->data;
				}
			} elseif ( $media_data_source == 'local' ) {
				$res = $this->search_local_media($search);
				$json_ret['data'] = $res;
			}

		}
		echo json_encode( $json_ret );
		wp_die();
	}

	public function search_local_media( $search = '' ) {
		$res = sio_get_local_media();

		$res_array = [];
		$search_result_arr = [];
		if ( $res ) {
			foreach($res as $k => $v) {
				$res_array[] = $v->title;
			}
		}
		$search_arr = sio_search_arr_values($search, $res_array);

		if ( $search_arr && count($search_arr) > 0 ) {
			foreach( $search_arr as $k => $v ) {
				$search_result_arr[] = $res[$k];
			}
		}
		return $search_result_arr;
	}

  public function __construct() {
    add_action( 'wp_ajax_tb_show_media', [$this, 'media_embed'] );
	add_action( 'wp_ajax_search_block_files', [$this, 'search_files'] );
	//add_action( 'wp_ajax_search_files', [$this, 'search_media'] );
  }

}
