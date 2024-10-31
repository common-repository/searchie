<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
 * Shortcode Embed URL.
 * @since 0.0.1
 * */
class SIO_Shortcodes_EmbedURL {
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
    add_shortcode( 'sio_embed_media', [$this, 'embedURL'] );
  }

  public function embedURL( $atts ) {
		$atts = shortcode_atts( [
			'width' 			=> 	'560',
			'height' 			=> 	'315',
			'embed_url' 	=> 	'',
			'css_inline' 	=> 	'',
			'responsive'	=>	'0'
			], $atts, 'sio_embed_media' );

		$data = [
		  	'width' => $atts['width'],
		  	'height' => $atts['height'],
		  	'embed_url' => $atts['embed_url'],
		  	'css_inline' => $atts['css_inline'],
			'responsive'	=>	$atts['responsive']
		];

		ob_start();
		SIO_View::get_instance()->admin_partials('shortcodes/embed-url.php', $data);
		return ob_get_clean();
	}

}
