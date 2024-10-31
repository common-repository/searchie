<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
 *
 */
class SIO_Media_Index {
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

	public function title() 
	{
		return 'Media';
	}

	public function search_local_media( $args = [] ) 
	{
		$search = isset($_GET['search']) ? sanitize_text_field( $_GET['search'] ) : '';
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

	public function search_media( $args = [] ) 
	{
		$defaults = [];
		$data = wp_parse_args( $args, $defaults );

		$paged = isset( $_GET['paged'] ) ? sanitize_text_field( $_GET['paged'] ) : 1;

		$search = true;
		if ( isset( $_GET['search'] ) ) {
			$search = sanitize_text_field( $_GET['search'] );
		}
		$search_query = isset( $_GET['search'] ) ? sanitize_text_field( $_GET['search'] ) : '';

		$media_data_source = sio_get_media_datasource();

		if ( $search ) {

			if ( $media_data_source == 'live' ) {

				$res = SIO_API_Files::get_instance()->search([ 'search' => $search, 'paged' => $paged ]);

				if ( $res['http_code'] == 200 && $res['body']->meta->total > 0 ) {
					$data = [
						'medias' => $res['body']->data,
						'search_query' => $search_query,
						'links' => $res['body']->links,
						'meta' => $res['body']->meta,
						'page' => $paged,
						'link_href' => '?page=searchie-media&_method=search-files&search=' . $search . '&paged='
					];
					SIO_View::get_instance()->admin_partials('dashboard/media/index.php', $data);
				} else {
					if ( isset( $ret['msg'] ) ) {
						SIO_Notices::get_instance()->error($files['msg']);
					}
				}

			} elseif ( $media_data_source == 'local' ) {
				$medias = $this->search_local_media();
				$limit = SIO_LOCAL_SYNC_LIMIT;

				$offset = ($paged - 1) * $limit;
				if( $offset < 0 ) {
					$offset = 0;
				}

				$data = [
					'limit' => $limit,
					'data' => $medias,
					'medias' => array_slice( $medias, $offset, $limit ),
					'page' => $paged,
					'offset' => $offset,
					'search_query' => $search_query,
					'link_href' => '?page=searchie-media&paged=%d',
					'media_data_source' => $media_data_source
				];
				SIO_View::get_instance()->admin_partials('dashboard/media/local-index.php', $data);
			}

		} else {
			sio_redirect_to( admin_url('?page=searchie-media') );
		}

	}

	public function content($args = [])
	{
		$defaults = [];
		$data = wp_parse_args( $args, $defaults );

		$media_data_source = sio_get_media_datasource();
		$paged = isset( $_GET['paged'] ) ? sanitize_text_field( $_GET['paged'] ) : 1;
		$search_query = isset( $_GET['search'] ) ? sanitize_text_field( $_GET['search'] ) : '';

		if ( $media_data_source == 'live' ) {

			$api_file_args = [
				'paged' => $paged
			];
			$files = SIO_API_Files::get_instance()->get($api_file_args);
			
			if ( isset($files['status']) && isset($files['body']->data) ) {

				$data = [
					'medias' => $files['body']->data,
					'search_query' => $search_query,
					'links' => $files['body']->links,
					'meta' => $files['body']->meta,
					'page' => $paged,
					'link_href' => '?page=searchie-media&paged=',
					'media_data_source' => $media_data_source
				];

				SIO_View::get_instance()->admin_partials('dashboard/media/index.php', $data);

			} else {
				$errorMsg = 'Error on getting media';
				if ( isset($files['msg']) && $files['msg'] != '' ) {
					$errorMsg = $files['msg'];
				}
				SIO_Notices::get_instance()->error($errorMsg);
			}

		} elseif( $media_data_source == 'local' ) {
			$limit = SIO_LOCAL_SYNC_LIMIT;

			$offset = ($paged - 1) * $limit;
			if( $offset < 0 ) {
				$offset = 0;
			}

			$medias = sio_get_local_media();

			$data = [
				'limit' => $limit,
				'data' => $medias,
				'total_page' => ceil( count($medias) / $limit ),
				'medias' => array_slice( $medias, $offset, $limit ),
				'page' => $paged,
				'offset' => $offset,
				'search_query' => $search_query,
				'link_href' => '?page=searchie-media&paged=',
				'media_data_source' => $media_data_source
			];

			SIO_View::get_instance()->admin_partials('dashboard/media/local-index.php', $data);
		}
	}

	public function sync( $args = [] ) {
		$data = [];
		$defaults = [];
		$api_file_args = wp_parse_args( $args, $defaults );

		$paged = isset( $_GET['paged'] ) ? sanitize_text_field( $_GET['paged'] ) : 1;
		$api_file_args = [
			'paged' => $paged
		];
		$files = sio_get_media($api_file_args);

		$data = [
			'medias' => $files['body']->data,
			'links' => $files['body']->links,
			'meta' => $files['body']->meta,
			'page' => $paged,
		];

		$last_page = $data['meta']->last_page;
		$total = $data['meta']->total;
		$per_page = $data['meta']->per_page;
		$result_data = [];

		if ( $total >= 1 ) {

			if ( $per_page >= $total ) {
				//one page only
				$result_data = $data['medias'];
			} else {
				//many pages
				$result_data = $data['medias'];

				for($i = 2; $i <= $last_page; $i++) {
					$paged = $i;
					$api_file_args = [
						'paged' => $paged,
					];
					$files = sio_get_media($api_file_args);

					$totalFiles = $files['body']->data;
				}
				$result_data += $totalFiles;
			}
		}
		$result_data = array_merge_recursive($result_data, $totalFiles ?? []);

		sio_store_media_files( $result_data );
	}

	public function __construct() {}
}
