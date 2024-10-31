<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
 * Shortcode PlaylistEmbed URL.
 * @since 0.0.1
 * */
class SIO_Shortcodes_PlaylistEmbed {
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
    add_shortcode( 'sio_embed_playlist', [$this, 'embed'] );
  }

  public function embed( $atts ) {
    $atts = shortcode_atts([
  		'width' => '560',
  		'height' => '315',
  		'hash' => '',
  	], $atts, 'sio_embed_playlist');

		$url = SIO_API_Playlists::get_instance()->url($atts['hash']);

    $data = [
      'width' => $atts['width'],
      'height' => $atts['height'],
      'hash' => $atts['hash'],
      'url' => $url,
    ];

    ob_start();
    SIO_View::get_instance()->admin_partials('shortcodes/playlist-embed.php', $data);
    return ob_get_clean();
	}

}
