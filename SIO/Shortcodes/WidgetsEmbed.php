<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
 * Shortcode Widget Embed URL.
 * @since 0.0.1
 * */
class SIO_Shortcodes_WidgetsEmbed {
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
    add_shortcode( 'sio_embed_widget', [$this, 'embedWidget'] );
  }

  public function embedWidget( $atts ) {
    $atts = shortcode_atts( [
  		'width' => '100%',
  		'height' => '100vh',
  		'embed_url' => '',
  	], $atts, 'sio_embed_widget' );

    $data = [
      'width' => $atts['width'],
      'height' => $atts['height'],
      'embed_url' => $atts['embed_url'],
    ];
		
    ob_start();
    SIO_View::get_instance()->admin_partials('shortcodes/widget-embed.php', $data);
    return ob_get_clean();
	}

}
