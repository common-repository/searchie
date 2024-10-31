<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
 *
 */
class SIO_Widgets_Ajax {

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

  public function widget_embed( $arg = [] ) {
    $embed_url = false;
    if ( isset( $_GET['embed_url'] ) ) {
      $embed_url = sanitize_text_field( $_GET['embed_url'] );
      $title = isset( $_GET['title'] ) ? sanitize_text_field( $_GET['title'] ) : '';
      $data = [
        'embed_url' => $embed_url,
        'width' => '100%',
        'height' => '100vh',
        'title' => $title,
        'css_inline' => 'width:100%;height:70%;',
      ];
      SIO_View::get_instance()->admin_partials('dashboard/widgets/preview-modal.php', $data);
    }

		wp_die();
  }

  public function __construct() {
    add_action( 'wp_ajax_tb_show_widget', [$this, 'widget_embed'] );
  }

}
