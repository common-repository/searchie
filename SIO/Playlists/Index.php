<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
 *
 */
class SIO_Playlists_Index {

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
	public static function get_instance() 
	{
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
		return 'Playlists';
	}

	public function search_local( $args = [] ) 
	{
		$search = isset($_GET['search']) ? sanitize_text_field( $_GET['search'] ) : '';
		$res = sio_get_local_playlist();

		$res_array = [];
		$search_result_arr = [];
		
		if($res) {
			foreach($res as $k => $v) {
				$res_array[] = $v->title;
			}
		}

		$search_arr = sio_search_arr_values($search, $res_array);

		if($search_arr && count($search_arr) > 0) {
			foreach( $search_arr as $k => $v ) {
				$search_result_arr[] = $res[$k];
			}
		}

		return $search_result_arr;
	}

	public function search_playlists( $args = [] ) 
	{
		$defaults = [];
		$data = wp_parse_args( $args, $defaults );

		$paged = isset( $_GET['paged'] ) ? sanitize_text_field( $_GET['paged'] ) : 1;

		$search = true;
		if(isset($_GET['search'])){
			$search = sanitize_text_field( $_GET['search'] );
		}
		$search_query = isset( $_GET['search'] ) ? sanitize_text_field( $_GET['search'] ) : '';

		$data_source = sio_get_playlist_datasource();

		if($search){
			if($data_source == 'local') {
				$limit = SIO_LOCAL_SYNC_LIMIT;
				$offset = ($paged - 1) * $limit;
				if( $offset < 0 ) {
					$offset = 0;
				}
				$playlists = $this->search_local();
				$data = [
					'limit' => $limit,
					'data' => $playlists,
					'playlists' => array_slice( $playlists, $offset, $limit ),
					'page' => $paged,
					'offset' => $offset,
					'search_query' => $search_query,
					'link_href' => '?page=searchie-playlists&paged=%d',
					'playlists_data_source' => $data_source
				];
				SIO_View::get_instance()->admin_partials('dashboard/playlists/local-index.php', $data);
			}
		} else {
			sio_redirect_to( admin_url('?page=searchie-playlists') );
		}
	}

	public function content( $args = [] ) {
		$defaults = [];
		$data = wp_parse_args( $args, $defaults );
		$data_source = sio_get_playlist_datasource();

		$paged = isset( $_GET['paged'] ) ? sanitize_text_field( $_GET['paged'] ) : 1;
		$search_query = isset( $_GET['search'] ) ? sanitize_text_field( $_GET['search'] ) : '';

		if ( $data_source == 'live' ) {
			$api_file_args = [
				'paged' => $paged
			];
			$playlist = SIO_API_Playlists::get_instance()->get($api_file_args);
			if ( $playlist['status'] && isset($playlist['body']->data) ) {
				$data = [
					'playlists' => $playlist['body']->data,
					'links' => $playlist['body']->links,
					'meta' => $playlist['body']->meta,
					'link_href' => '?page=searchie-playlists&paged=',
					'page' => $paged
				];

				SIO_View::get_instance()->admin_partials('dashboard/playlists/index.php', $data);
			} else {
				$errorMsg = 'Error on getting Playlist.';
				if ( isset($files['msg']) && $files['msg'] != '' ) {
					$errorMsg = $files['msg'];
				}
				SIO_Notices::get_instance()->error($errorMsg);
			}
		} elseif ( $data_source == 'local' ) {
			$limit = SIO_LOCAL_SYNC_LIMIT;

			$offset = ($paged - 1) * $limit;
			if( $offset < 0 ) {
				$offset = 0;
			}
			$playlists = sio_get_local_playlist();
			$data = [
				'limit' => $limit,
				'data' => $playlists,
				'total_page' => ceil( count($playlists) / $limit ),
				'playlists' => array_slice( $playlists, $offset, $limit ),
				'page' => $paged,
				'offset' => $offset,
				'search_query' => $search_query,
				'link_href' => '?page=searchie-playlists&paged=',
				'playlists_data_source' => $data_source
			];
			SIO_View::get_instance()->admin_partials('dashboard/playlists/local-index.php', $data);
		}

	}

	public function sync( $args = [] ) {
		$data = [];
		$defaults = [];
		$api_file_args = wp_parse_args( $args, $defaults );

		$paged = 1;
		$args = [
			'paged' => $paged
		];
		$playlist = sio_get_api_playlist($args);

		$data = [
			'playlist' => $playlist['body']->data,
			'links' => $playlist['body']->links,
			'meta' => $playlist['body']->meta,
			'page' => $paged,
			'link_href' => '?page=searchie-playlist&paged=',
		];

		$last_page = $data['meta']->last_page;
		$total = $data['meta']->total;
		$per_page = $data['meta']->per_page;
		$result_data = [];

		if ( $total >= 1 ) {
			if ( $per_page >= $total ) {
			//one page only
				$result_data = $data['playlist'];
			} else {
				//many pages
				$result_data[] = $data['playlist'];
				for($i = 2; $i <= $last_page; $i++) {
					$paged = $i;
					$api_args = [
						'paged' => $paged,
					];
					$widgets = sio_get_api_playlist($api_args);
					$result_data[] = $widgets['body']->data;
				}
			}
		}
		sio_store_playlist($result_data);
	}

	public function __construct() 
	{

	}

}
