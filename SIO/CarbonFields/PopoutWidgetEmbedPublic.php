<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
use Carbon_Fields\Container;
use Carbon_Fields\Field;
use Carbon_Fields\Block;
/**
 * Metabox Carbon Fields
 * @since 0.0.1
 * */
class SIO_CarbonFields_PopoutWidgetEmbedPublic {
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

  	public function initWpHead() {
		$get_global_widget = SIO_Settings_Widgets::get_instance()->widget_global(['action' => 'r']);
		if ( !$get_global_widget ) {
			add_action( 'wp_head', [$this, 'js_script'], 100 );
		}
	}

	public function js_script( $args = [] ) {
		$use = carbon_get_post_meta( get_the_ID(), 'searchie_use_popout_widget');
		$type = carbon_get_post_meta( get_the_ID(), 'searchie_widget_embed_popout_type');
		$leftside = carbon_get_post_meta( get_the_ID(), 'searchie_widget_embed_popout_leftside');
		$custom_button = carbon_get_post_meta( get_the_ID(), 'searchie_widget_embed_popout_custombutton');
		$hash = carbon_get_post_meta( get_the_ID(), 'searchie_widget_embed_popout_hash');
		$float_position = carbon_get_post_meta( get_the_ID(), 'searchie_widget_embed_popout_button_position');

		if ($hash && $use) {
			if ( isset($leftside) && $leftside == 'yes' ) {
			$leftside = 'true';
			} elseif ( isset($leftside) && $leftside == 'no' ) {
			$leftside = 'false';
			}
			$popup_bool = false;
			if ( $type == 'floating' ) {
			$type = 'popup';
			$float_position = $float_position;
			$popup_bool = true;
			} else {
			$type = 'full';
			$float_position = '';
			}
			if ( $custom_button == 'yes' ) {
			$float_position = '';
			}
		}
		if ( $hash && $hash !== '' && $use ) {
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
