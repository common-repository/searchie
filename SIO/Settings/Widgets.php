<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
 * Widgets Settings.
 * @since 1.0.0
 * */
class SIO_Settings_Widgets {
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

	public function __construct() {
    add_action( 'wp_ajax_sio_set_global_widget', [$this, 'ajaxSetGlobalWidget'] );
    add_action( 'wp_head', [$this, 'buildPopOut'], 100 );
	}

  /**
   * Set ajax.
   */
	public function ajaxSetGlobalWidget() {
    $ret = [
      'success' => false
    ];
    $hash = isset($_POST['widget']) ? sanitize_text_field( $_POST['widget'] ) : false;
    if ( $hash && $hash !== '-1' ) {
      // $api_url = SIO_API_Config::get_instance()->getUrl() . 'widget/' . $hash;
      // $ret['url'] = $api_url;
      $this->widget_global([
        'action' => 'u',
        'value' => $hash
      ]);
      $widget_global_settings = [
        'type' => sanitize_text_field( $_POST['widget_type'] )
      ];
      $this->widget_global_settings([
        'action' => 'u',
        'value' => $widget_global_settings
      ]);
      $this->widget_float_position([
        'action' => 'u',
        'value' => sanitize_text_field( $_POST['float_position'] )
      ]);
      $this->widget_custom_button([
        'action' => 'u',
        'value' => sanitize_text_field( $_POST['custom_button'] )
      ]);
      $this->widget_left_side([
        'action' => 'u',
        'value' => sanitize_text_field( $_POST['left_side'] )
      ]);
      $ret['success'] = true;
    } else {
      $this->widget_global([
        'action' => 'd'
      ]);
      $this->widget_global_settings([
        'action' => 'd'
      ]);
      $this->widget_float_position([
        'action' => 'd'
      ]);
      $this->widget_custom_button([
        'action' => 'd'
      ]);
      $this->widget_left_side([
        'action' => 'd'
      ]);
    }

    echo json_encode($ret);
    die();
  }

  /**
   * Store API Widget global.
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
  public function widget_global( $args = [] ) {
    // Key prefix in _options table.
    $prefix = 'sio_widget_global';
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
   * Store API Widget global settings.
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
  public function widget_global_settings( $args = [] ) {
    // Key prefix in _options table.
    $prefix = 'sio_widget_global_settings';
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
   * Store API Widget global settings.
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
  public function widget_float_position( $args = [] ) {
    // Key prefix in _options table.
    $prefix = 'sio_widget_float_position';
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
   * Store API Widget custom button, global settings.
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
  public function widget_custom_button( $args = [] ) {
    // Key prefix in _options table.
    $prefix = 'sio_widget_custom_button';
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
   * Store API Widget left side, global settings.
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
  public function widget_left_side( $args = [] ) {
    // Key prefix in _options table.
    $prefix = 'sio_widget_left_side';
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
	 * Float position.
	 * @return array
	 */
	public function floatPositionArr() {
		$arr = [
			'left-bottom1' => 'Left Bottom 1',
			'left-bottom2' => 'Left Bottom 2',
			'left-bottom3' => 'Left Bottom 3',
			'left-middle' => 'Left Middle',
			'left-top1' => 'Left Top 1',
			'left-top2' => 'Left Top 2',
			'left-top3' => 'Left Top 3',
			'middle-bottom' => 'Middle Bottom',
			'middle-top' => 'Middle Top',
			'right-bottom1' => 'Right Bottom 1',
			'right-bottom2' => 'Right Bottom 2',
			'right-bottom3' => 'Right Bottom 3',
			'right-middle' => 'Right Middle',
			'right-top1' => 'Right Top 1',
			'right-top2' => 'Right Top 2',
			'right-top3' => 'Right Top 3'
		];

		return $arr;
	}

	public function getPopupData() {
		$hash = $this->widget_global([
			'action' => 'r',
			'single' => true
		]);
		$data = [];
		if ( $hash ) {
			$widget_global_settings = $this->widget_global_settings([
        'action' => 'r',
        'single' => true
      ]);
			$data['hash'] = $hash;

			$left_side = $this->widget_left_side([
				'action'  => 'r',
				'single'  =>  true
			]);
			$data['left_side'] = $left_side;

			$custom_button = $this->widget_custom_button([
				'action'  => 'r',
				'single'  =>  true
			]);
			$data['custom_button'] = $custom_button;
			$data['widget_type'] = $widget_global_settings['type'];
			if ( $widget_global_settings['type'] == 'floating-widget' ) {
				$float_position = $this->widget_float_position([
	        'action' => 'r',
	        'single' => true
	      ]);
				$data['float_position'] = $float_position;

				if ( $custom_button == 'yes' ) {
					$data['float_position'] = '';
				}

			} elseif ( $widget_global_settings['type'] == 'full-height' ) {

			}
			return $data;
		}
		return false;
	}

	public function buildPopOut() {
		$get = $this->getPopupData();
		if ( $get ) {
			$hash = $get['hash'];
			$type = $get['widget_type'];
			$float_position = isset($get['float_position']) ? $get['float_position'] : '';
			$left_side = isset($get['left_side']) ? $get['left_side'] : 'no';
			if ( $left_side == 'yes' ) {
				$left_side = 'true';
			} elseif ( $left_side == 'no' ) {
				$left_side = 'false';
			}
			$use_custom_button = $get['custom_button'];
			$popup_bool = false;
			if ( $type == 'floating-widget' ) {
				$type = 'popup';
				$float_position = $float_position;
				$popup_bool = true;
			} else {
				$type = 'full';
				$float_position = '';
			}
			if ( $use_custom_button == 'yes' ) {
				$float_position = '';
			}
			?>
        <script>
        (function(w,d,s,i,u,a) {
          w._searchie = {widget:i, url:u, user:a};var f=d.getElementsByTagName(s)[0],j=d.createElement(s);j.async = true;j.src='https://app.searchie.io/js/js-popup.js?' + Date.now();f.parentNode.insertBefore(j,f);
        })(window, document, 'script', '<?php echo $hash;?>', 'https://app.searchie.io');
        </script>
			<?php
		}
	}

}
