<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
 *https://wpbeaches.com/adding-data-attribute-menu-list-item-via-walker-class/
 */
class SIO_NavMenu {

	/**
	 * Holds our custom fields
	 *
	 * @var    array
	 * @access protected
	 * @since  Menu_Item_Custom_Fields_Example 0.2.0
	 */
	protected static $fields = array();

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

	/**
	 * Initialize plugin
	 */
	public static function init() {
		add_action( 'wp_nav_menu_item_custom_fields', array( __CLASS__, '_fields' ), 10, 4 );
		add_action( 'wp_update_nav_menu_item', array( __CLASS__, '_save' ), 10, 3 );
		add_filter( 'manage_nav-menus_columns', array( __CLASS__, '_columns' ), 99 );
		add_filter( 'nav_menu_link_attributes', array(__CLASS__, '_attributes'), 3, 99);

		self::$fields = array(
			'use_as_searchie_widget_button' => __( 'Use as Searchie widget button?', 'menu-item-custom-fields-example' ),
		);
	}

	public static function _attributes( $atts, $item, $args  ) {
		$value = get_post_meta( $item->ID, '_menu_item_use_as_searchie_widget_button', true );
		if ( $value ) {
			$atts['href'] = '#';
			$atts['class'] = 'wp-searchie-button';
			$atts['onClick'] = 'javascript:window._searchie.toggle()';
		}
		return $atts;
	}

	/**
	 * Save custom field value
	 *
	 * @wp_hook action wp_update_nav_menu_item
	 *
	 * @param int   $menu_id         Nav menu ID
	 * @param int   $menu_item_db_id Menu item ID
	 * @param array $menu_item_args  Menu item data
	 */
	public static function _save( $menu_id, $menu_item_db_id, $menu_item_args ) {
		if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
			return;
		}

		check_admin_referer( 'update-nav_menu', 'update-nav-menu-nonce' );

		foreach ( self::$fields as $_key => $label ) {
			$key = sprintf( '_menu_item_%s', $_key );
			// Sanitize
			if ( ! empty( $_POST[ $key ][ $menu_item_db_id ] ) ) {
				// Do some checks here...
				$value = sanitize_text_field( $_POST[ $key ][ $menu_item_db_id ] );
			}
			else {
				$value = null;
			}

			// Update
			if ( ! is_null( $value ) ) {
				update_post_meta( $menu_item_db_id, $key, $value );
			}
			else {
				delete_post_meta( $menu_item_db_id, $key );
			}
		}
	}


	/**
	 * Print field
	 *
	 * @param object $item  Menu item data object.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args  Menu item args.
	 * @param int    $id    Nav menu ID.
	 *
	 * @return string Form fields
	 */
	public static function _fields( $id, $item, $depth, $args ) {
		foreach ( self::$fields as $_key => $label ) :
			$key   = sprintf( '_menu_item_%s', $_key );
			$id    = sprintf( 'edit-%s-%s', $key, $item->ID );
			$name  = sprintf( '%s[%s]', $key, $item->ID );
			$value = get_post_meta( $item->ID, $key, true );
			$class = sprintf( 'field-%s', $_key );
      $checked = '';
      if ( $value ) {
        $checked = 'checked';
      }
			?>
				<p class="description description-wide <?php echo esc_attr( $class ) ?>">
					<?php printf(
						'<label for="%1$s">%2$s<br /><input type="checkbox" id="%1$s" class="widefat %1$s" name="%3$s" value="1" '.$checked.' /></label>',
						esc_attr( $id ),
						esc_html( $label ),
						esc_attr( $name ),
						esc_attr( $value )
					) ?>
				</p>
			<?php
		endforeach;
	}


	/**
	 * Add our fields to the screen options toggle
	 *
	 * @param array $columns Menu item columns
	 * @return array
	 */
	public static function _columns( $columns ) {
		$columns = array_merge( $columns, self::$fields );

		return $columns;
	}
}
