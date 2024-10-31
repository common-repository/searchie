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
class SIO_CarbonFields_WidgetEmbed {
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
		$get_api_widgets = SIO_API_Widgets::get_instance()->getOptions();

		if ( $get_api_widgets ) {
			foreach( $get_api_widgets as $widget ) {
				$api_url[$widget->embed_url] = sio_limit_str($widget->name);
			}
		}
    Block::make( __( 'Widget Embed' ) )
		->set_icon('playlist-video')
    ->add_fields( array(
      Field::make( 'select', 'crb_select_widget_embed', __( 'Choose Widget' ) )
        ->set_options( $api_url )
				->set_classes('searchie-widget-embed-select'),
			Field::make( 'text', 'crb_widget_embed_width', __('Width') )
				->set_default_value('100%'),
			Field::make( 'text', 'crb_player_embed_height', __('Height') )
				->set_default_value('100vh'),
    ) )
    ->set_category('searchie-blocks')
    ->set_render_callback( function ( $fields, $attributes, $inner_blocks ) {
				$url = $fields['crb_select_widget_embed'];
				$width = $fields['crb_widget_embed_width'];
				$height = $fields['crb_player_embed_height'];
				?>
				<div class="searchie-block-container">
				    <div class="block__widget_embed">
							<iframe
								src="<?php echo $url;?>"
								style="width: <?php echo $width;?>; height: <?php echo $height;?>; border: none;"
								frameborder="0"
								allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
								allowfullscreen>
							</iframe>
				    </div><!-- /.block__player -->
				</div><!-- /.searchie-block-container -->
				<?php
    } );
  }

}
