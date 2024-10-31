<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
 * CRUD for _options functions.
 * @since 0.0.1
 * */
class SIO_MetaOption {
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
   * Store the raw return of auth token.
   *
   * @param array $args {
   *		Array of arguments.
   *		@type bool $single this will return string if true else array if false. default is false.
   *			- applicable only on read or get_post_meta.
   *		@type string $action CRUD action, default is read.
   *			accepted values: r (read), u (update), d (delete)
   *		@type string $prefix the prefix meta key.
   * }
   * @return mixed Will be an array if $action is read, and bool | id if $action is update or delete.
   */
  public function auth_token_raw( $args = [] ) {
    // Key prefix in _options table.
    $prefix = 'sio_auth_token_raw';
    $defaults = [
      'action'  => 'r',
      'value'   => '',
      'prefix'  => $prefix,
      'extend_prefix'  => '',
    ];

    $args = wp_parse_args( $args, $defaults );

    switch( $args['action'] ) {
      case 'd':
        delete_option( $args['prefix'] );
        break;
      case 'u':
        update_option( $args['prefix'] , $args['value'] );
        break;
      case 'r':
        return get_option( $args['prefix'] );
        break;
    }
  }

  /**
   * Store the raw return of auth token.
   *
   * @param array $args {
   *		Array of arguments.
   *		@type bool $single this will return string if true else array if false. default is false.
   *			- applicable only on read or get_post_meta.
   *		@type string $action CRUD action, default is read.
   *			accepted values: r (read), u (update), d (delete)
   *		@type string $prefix the prefix meta key.
   * }
   * @return mixed Will be an array if $action is read, and bool | id if $action is update or delete.
   */
  public function auth_token_body( $args = [] ) {
    // Key prefix in _options table.
    $prefix = 'sio_auth_token_body';
    $defaults = [
      'action'  => 'r',
      'value'   => '',
      'prefix'  => $prefix,
      'extend_prefix'  => '',
    ];

    $args = wp_parse_args( $args, $defaults );

    switch( $args['action'] ) {
      case 'd':
        delete_option( $args['prefix'] );
        break;
      case 'u':
        update_option( $args['prefix'] , $args['value'] );
        break;
      case 'r':
        return get_option( $args['prefix'] );
        break;
    }
  }

  /**
   * Store API Profile/Me Data.
   *
   * @param array $args {
   *		Array of arguments.
   *		@type bool $single this will return string if true else array if false. default is false.
   *			- applicable only on read or get_post_meta.
   *		@type string $action CRUD action, default is read.
   *			accepted values: r (read), u (update), d (delete)
   *		@type string $prefix the prefix meta key.
   * }
   * @return mixed Will be an array if $action is read, and bool | id if $action is update or delete.
   */
  public function me_data( $args = [] ) {
    // Key prefix in _options table.
    $prefix = 'sio_me_data';
    $defaults = [
      'action'  => 'r',
      'value'   => '',
      'prefix'  => $prefix,
      'extend_prefix'  => '',
    ];

    $args = wp_parse_args( $args, $defaults );

    switch( $args['action'] ) {
      case 'd':
        delete_option( $args['prefix'] );
        break;
      case 'u':
        update_option( $args['prefix'] , $args['value'] );
        break;
      case 'r':
        return get_option( $args['prefix'] );
        break;
    }
  }

  /**
   * Store API Files Data.
   *
   * @param array $args {
   *		Array of arguments.
   *		@type bool $single this will return string if true else array if false. default is false.
   *			- applicable only on read or get_post_meta.
   *		@type string $action CRUD action, default is read.
   *			accepted values: r (read), u (update), d (delete)
   *		@type string $prefix the prefix meta key.
   * }
   * @return mixed Will be an array if $action is read, and bool | id if $action is update or delete.
   */
  public function files_data( $args = [] ) {
    // Key prefix in _options table.
    $prefix = 'sio_files_data';
    $defaults = [
      'action'  => 'r',
      'value'   => '',
      'prefix'  => $prefix,
      'extend_prefix'  => '',
    ];

    $args = wp_parse_args( $args, $defaults );

    switch( $args['action'] ) {
      case 'd':
        delete_option( $args['prefix'] );
        break;
      case 'u':
        update_option( $args['prefix'] , $args['value'] );
        break;
      case 'r':
        return get_option( $args['prefix'] );
        break;
    }
  }

  /**
   * Store API Widgets Data.
   *
   * @param array $args {
   *		Array of arguments.
   *		@type bool $single this will return string if true else array if false. default is false.
   *			- applicable only on read or get_post_meta.
   *		@type string $action CRUD action, default is read.
   *			accepted values: r (read), u (update), d (delete)
   *		@type string $prefix the prefix meta key.
   * }
   * @return mixed Will be an array if $action is read, and bool | id if $action is update or delete.
   */
  public function widgets_data( $args = [] ) {
    // Key prefix in _options table.
    $prefix = 'sio_widgets_data';
    $defaults = [
      'action'  => 'r',
      'value'   => '',
      'prefix'  => $prefix,
      'extend_prefix'  => '',
    ];

    $args = wp_parse_args( $args, $defaults );

    switch( $args['action'] ) {
      case 'd':
        delete_option( $args['prefix'] );
        break;
      case 'u':
        update_option( $args['prefix'] , $args['value'] );
        break;
      case 'r':
        return get_option( $args['prefix'] );
        break;
    }
  }

  /**
   * Store API Playlists Data.
   *
   * @param array $args {
   *		Array of arguments.
   *		@type bool $single this will return string if true else array if false. default is false.
   *			- applicable only on read or get_post_meta.
   *		@type string $action CRUD action, default is read.
   *			accepted values: r (read), u (update), d (delete)
   *		@type string $prefix the prefix meta key.
   * }
   * @return mixed Will be an array if $action is read, and bool | id if $action is update or delete.
   */
  public function playlists_data( $args = [] ) {
    // Key prefix in _options table.
    $prefix = 'sio_playlists_data';
    $defaults = [
      'action'  => 'r',
      'value'   => '',
      'prefix'  => $prefix,
      'extend_prefix'  => '',
    ];

    $args = wp_parse_args( $args, $defaults );

    switch( $args['action'] ) {
      case 'd':
        delete_option( $args['prefix'] );
        break;
      case 'u':
        update_option( $args['prefix'] , $args['value'] );
        break;
      case 'r':
        return get_option( $args['prefix'] );
        break;
    }
  }

  /**
   * Choose which media datasource.
	 * Local or Live
   *
   * @param array $args {
   *		Array of arguments.
   *		@type bool $single this will return string if true else array if false. default is false.
   *			- applicable only on read or get_post_meta.
   *		@type string $action CRUD action, default is read.
   *			accepted values: r (read), u (update), d (delete)
   *		@type string $prefix the prefix meta key.
   * }
   * @return mixed Will be an array if $action is read, and bool | id if $action is update or delete.
   */
  public function media_datasource( $args = [] ) {
    // Key prefix in _options table.
    $prefix = 'sio_media_datasource';
    $defaults = [
      'action'  => 'r',
      'value'   => '',
      'prefix'  => $prefix,
      'extend_prefix'  => '',
    ];

    $args = wp_parse_args( $args, $defaults );

    switch( $args['action'] ) {
      case 'd':
        delete_option( $args['prefix'] );
        break;
      case 'u':
        update_option( $args['prefix'] , $args['value'] );
        break;
      case 'r':
        return get_option( $args['prefix'] );
        break;
    }
  }

  /**
   * Choose which widgets datasource.
	 * Local or Live
   *
   * @param array $args {
   *		Array of arguments.
   *		@type bool $single this will return string if true else array if false. default is false.
   *			- applicable only on read or get_post_meta.
   *		@type string $action CRUD action, default is read.
   *			accepted values: r (read), u (update), d (delete)
   *		@type string $prefix the prefix meta key.
   * }
   * @return mixed Will be an array if $action is read, and bool | id if $action is update or delete.
   */
  public function widget_datasource( $args = [] ) {
    // Key prefix in _options table.
    $prefix = 'sio_widget_datasource';
    $defaults = [
      'action'  => 'r',
      'value'   => '',
      'prefix'  => $prefix,
      'extend_prefix'  => '',
    ];

    $args = wp_parse_args( $args, $defaults );

    switch( $args['action'] ) {
      case 'd':
        delete_option( $args['prefix'] );
        break;
      case 'u':
        update_option( $args['prefix'] , $args['value'] );
        break;
      case 'r':
        return get_option( $args['prefix'] );
        break;
    }
  }

  /**
   * Choose which playlist datasource.
	 * Local or Live
   *
   * @param array $args {
   *		Array of arguments.
   *		@type bool $single this will return string if true else array if false. default is false.
   *			- applicable only on read or get_post_meta.
   *		@type string $action CRUD action, default is read.
   *			accepted values: r (read), u (update), d (delete)
   *		@type string $prefix the prefix meta key.
   * }
   * @return mixed Will be an array if $action is read, and bool | id if $action is update or delete.
   */
  public function playlist_datasource( $args = [] ) {
    // Key prefix in _options table.
    $prefix = 'sio_playlist_datasource';
    $defaults = [
      'action'  => 'r',
      'value'   => '',
      'prefix'  => $prefix,
      'extend_prefix'  => '',
    ];

    $args = wp_parse_args( $args, $defaults );

    switch( $args['action'] ) {
      case 'd':
        delete_option( $args['prefix'] );
        break;
      case 'u':
        update_option( $args['prefix'] , $args['value'] );
        break;
      case 'r':
        return get_option( $args['prefix'] );
        break;
    }
  }

  /**
   * Audience Status.
	 * Enable / Disable
   *
   * @param array $args {
   *		Array of arguments.
   *		@type bool $single this will return string if true else array if false. default is false.
   *			- applicable only on read or get_post_meta.
   *		@type string $action CRUD action, default is read.
   *			accepted values: r (read), u (update), d (delete)
   *		@type string $prefix the prefix meta key.
   * }
   * @return mixed Will be an array if $action is read, and bool | id if $action is update or delete.
   */
  public function audience_status( $args = [] ) {
    // Key prefix in _options table.
    $prefix = 'sio_audience_status';
    $defaults = [
      'action'  => 'r',
      'value'   => '',
      'prefix'  => $prefix,
      'extend_prefix'  => '',
    ];

    $args = wp_parse_args( $args, $defaults );

    switch( $args['action'] ) {
      case 'd':
        delete_option( $args['prefix'] );
        break;
      case 'u':
        update_option( $args['prefix'] , $args['value'] );
        break;
      case 'r':
        return get_option( $args['prefix'] );
        break;
    }
  }

}
