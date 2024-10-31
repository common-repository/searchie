<?php
/**
 *
 * @link              https://www.searchie.io/
 * @since             1.0
 * @package           Searchie
 *
 * @wordpress-plugin
 * Plugin Name:       Searchie
 * Plugin URI:        https://www.searchie.io/
 * Description:       Unlock the full potential of your video and audio content Searchie helps reduce content overwhelm for your customers and team, making your content more accessible and easier to consume.  You create� And let Searchie do the work for you.
 * Version:           1.17.0
 * Author:            Searchie
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       searchie
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for the plugin and update it as you release new versions.
 */
define( 'SEARCHIE_VERSION', '1.17.0' );
/**
 * Get the root url file.
 */
define( 'SEARCHIE_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'SIO_LOCAL_SYNC_LIMIT', 25 );
/**
 * For autoloading classes
 * */
spl_autoload_register('sio_directory_autoload_class');
function sio_directory_autoload_class($class_name){
	//check if class has a prefix of SIO
	if ( false !== strpos( $class_name, 'SIO' ) ) {
		//get the include classes directory/folder
		$include_classes_dir = realpath( get_template_directory( __FILE__ ) ) . DIRECTORY_SEPARATOR;

		//this is for the admin classes
		$admin_classes_dir = realpath( plugin_dir_path( __FILE__ ) ) . DIRECTORY_SEPARATOR;

		//parse the class
		$class_file = str_replace( '_', DIRECTORY_SEPARATOR, $class_name ) . '.php';

		//check if include classes directory exists and require or call it
		if( file_exists($include_classes_dir . $class_file) ){
			require_once $include_classes_dir . $class_file;
		}

		//check if admin classes directory exists and require or call it
		if( file_exists($admin_classes_dir . $class_file) ){
			require_once $admin_classes_dir . $class_file;
		}

	}
}
/**
 * Get the plugin details.
 */
function sio_get_plugin_details() {
 // Check if get_plugins() function exists. This is required on the front end of the
 // site, since it is in a file that is normally only loaded in the admin.
 if ( ! function_exists( 'get_plugins' ) ) {
	 require_once ABSPATH . 'wp-admin/includes/plugin.php';
 }
 $ret = get_plugins();
 return $ret['searchie/searchie.php'];
}

/**
* get the text domain of the plugin.
**/
function sio_get_text_domain() {
 $ret = sio_get_plugin_details();
 return $ret['TextDomain'];
}

/**
* get the plugin directory path.
**/
function sio_get_plugin_dir() {
 return plugin_dir_path( __FILE__ );
}

/**
* get the plugin url path.
**/
function sio_get_plugin_dir_url() {
 return plugin_dir_url( __FILE__ );
}
/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-searchie-activator.php
 */
function activate_searchie() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-searchie-activator.php';
	Searchie_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-searchie-deactivator.php
 */
function deactivate_searchie() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-searchie-deactivator.php';
	Searchie_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_searchie' );
register_deactivation_hook( __FILE__, 'deactivate_searchie' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-searchie.php';

/**
 * functions.
 */
require plugin_dir_path( __FILE__ ) . 'functions/api.php';
require plugin_dir_path( __FILE__ ) . 'functions/helper.php';
require plugin_dir_path( __FILE__ ) . 'functions/pagination.php';
require plugin_dir_path( __FILE__ ) . 'functions/settings.php';
require plugin_dir_path( __FILE__ ) . 'functions/hooks.php';
require plugin_dir_path( __FILE__ ) . 'functions/blocks.php';
require plugin_dir_path( __FILE__ ) . 'functions/media.php';
require plugin_dir_path( __FILE__ ) . 'functions/widgets.php';
require plugin_dir_path( __FILE__ ) . 'functions/playlist.php';


/**
 * Block Initializer.
 */
if ( sio_exclude_this() ) {
	require plugin_dir_path( __FILE__ ) . 'searchie-media-block/searchie-media-block.php';
}

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_searchie() {

	$plugin = new Searchie();
	$plugin->run();
	
	//initialize menu
	SIO_Menu::get_instance();
	
	if( sio_has_token() ) {
		SIO_Settings_JS::get_instance();

		//shortcodes
		SIO_Shortcodes_EmbedURL::get_instance();
		SIO_Shortcodes_WidgetsEmbed::get_instance();
		SIO_Shortcodes_PlaylistEmbed::get_instance();
	
		//ajax
		SIO_Settings_Widgets::get_instance();
	
		SIO_NavMenu::get_instance()->init();

		//dashboard
		SIO_Dashboard_NavMenu::get_instance();
		SIO_Dashboard_Profile::get_instance();
	
		SIO_Media_Ajax::get_instance();
		SIO_Widgets_Ajax::get_instance();
		SIO_Playlists_Ajax::get_instance();
	}
	
}

add_action('plugins_loaded', 'run_searchie');

function sio_init() {}
add_action( 'init', 'sio_init' );

add_action( 'after_setup_theme', 'crb_load' );
function crb_load() {
    require_once( sio_get_plugin_dir() . 'vendor/autoload.php' );
    \Carbon_Fields\Carbon_Fields::boot();
	
	SIO_CarbonFields_PopoutWidgetEmbedPublic::get_instance()->initWpHead();
}

add_action( 'carbon_fields_register_fields', 'crb_attach_theme_options' );
function crb_attach_theme_options() {
    SIO_CarbonFields_PopoutWidgetEmbedInitMetaAdmin::get_instance()->init();
}