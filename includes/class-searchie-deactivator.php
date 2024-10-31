<?php

/**
 * Fired during plugin deactivation
 *
 * @link       https://www.searchie.io/
 * @since      1.0.0
 *
 * @package    Searchie
 * @subpackage Searchie/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Searchie
 * @subpackage Searchie/includes
 * @author     Searchie <support@searchie.io>
 */
class Searchie_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
		SIO_MetaOption::get_instance()->auth_token_raw(['action' => 'd']);
		SIO_MetaOption::get_instance()->auth_token_body(['action' => 'd']);
		SIO_MetaOption::get_instance()->me_data(['action' => 'd']);
		SIO_MetaOption::get_instance()->files_data(['action' => 'd']);
		SIO_MetaOption::get_instance()->widgets_data(['action' => 'd']);
		SIO_MetaOption::get_instance()->playlists_data(['action' => 'd']);
		SIO_MetaOption::get_instance()->media_datasource(['action' => 'd']);
		SIO_MetaOption::get_instance()->widget_datasource(['action' => 'd']);
		SIO_MetaOption::get_instance()->playlist_datasource(['action' => 'd']);
		SIO_MetaOption::get_instance()->audience_status(['action' => 'd']);
	}

}
