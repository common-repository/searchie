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
class SIO_CarbonFields_Player {
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

	public function init() {
		$api_url = [];
		$get_api_media = SIO_API_Files::get_instance()->get();

		if ( $get_api_media ) {
			foreach( $get_api_media as $media ) {
			$api_url[$media->embed_url] = sio_limit_str($media->title);
			}
		}
		Block::make( __( 'Player' ) )
		->set_icon('video-alt3')
		->add_fields( array(
		Field::make( 'select', 'crb_select_player', __( 'Choose Player' ) )
			->set_options( $api_url )
			->set_classes('searchie-player-select'),
			Field::make( 'text', 'crb_player_width', __('Width') )
			->set_default_value(560),
			Field::make( 'text', 'crb_player_height', __('Height') )
			->set_default_value(315),
		) )
		->set_category('searchie-blocks')
		->set_render_callback( function ( $fields, $attributes, $inner_blocks ) {
			$url = $fields['crb_select_player'];
			$width = $fields['crb_player_width'];
			$height = $fields['crb_player_height'];
			?>
			<div class="searchie-block-container">
				<div class="block__player">
							<iframe
						width="<?php echo $width;?>"
						height="<?php echo $height;?>"
						src="<?php echo $url;?>"
						frameborder="0"
						allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
						</iframe>
				</div><!-- /.block__player -->
			</div><!-- /.searchie-block-container -->
			<?php
		});
	}

}
