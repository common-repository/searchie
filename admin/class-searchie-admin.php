<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.searchie.io/
 * @since      1.0.0
 *
 * @package    Searchie
 * @subpackage Searchie/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Searchie
 * @subpackage Searchie/admin
 * @author     Searchie <support@searchie.io>
 */
class Searchie_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {
		$screen = get_current_screen();
		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Searchie_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Searchie_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

    	wp_enqueue_style( 'thickbox' );
		wp_enqueue_style( 'bootstrap4-iso', SEARCHIE_PLUGIN_URL . 'assets/bootstrap-iso/bootstrap-iso.min.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name . '-select2', SEARCHIE_PLUGIN_URL . 'assets/select2/select2.min.css', array(), '4.0.12', 'all' );
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/searchie-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Searchie_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Searchie_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_enqueue_script( 'thickbox' );
		wp_enqueue_script( 'bootstrap4-iso', SEARCHIE_PLUGIN_URL . 'assets/bootstrap-iso/bootstrap.min.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( $this->plugin_name . '-select2', SEARCHIE_PLUGIN_URL . 'assets/select2/select2.full.min.js', array( 'jquery' ), '4.0.12', false );
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/searchie-admin.js', array( 'jquery' ), $this->version, false );
		// Localize the script with new data
		$get_global_widget = SIO_Settings_Widgets::get_instance()->widget_global(['action' => 'r']);
		$global_widget = array(
		    'is_set_global_widget' => $get_global_widget ? 1 : 0,
		);
		wp_localize_script( $this->plugin_name, 'sio_global_widget', $global_widget );
	}

	public function enqueue_block_editor_assets() {
		wp_enqueue_script( $this->plugin_name . '-custom-block', plugin_dir_url( __FILE__ ) . 'js/widget-button-block.js', array( 'wp-blocks', 'wp-dom-ready', 'wp-edit-post' ) );
	}

}
