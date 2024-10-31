<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
 * JS Settings.
 * @since 1.0.0
 * */
class SIO_Settings_JS {
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
	 * @since     1.0.0
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
		add_action('wp_head', [$this, 'jsSdk'], 100 );
	}

	/**
	 * Display the API html.
	 * @return html
	 */
	public function show() {
		$data = [];

		SIO_View::get_instance()->admin_partials('settings/js.php', $data);
	}

	/**
	 * add the js sdk to the header.
	 */
	public function jsSdk() {
		$has_profile = sio_has_me_data();
		$audience = sio_get_audience_status();
		if ( $has_profile && $audience == 'enable' ) {
			$current_user = wp_get_current_user();
			$first_name = $current_user->user_firstname ? $current_user->user_firstname : '';
			$last_name = $current_user->user_lastname ? $current_user->user_lastname : '';
			$fullname = $first_name . ' ' . $last_name;
			?>
				<!-- Searchie SDK -->
			  <script type="text/javascript">
					window.Searchie = {
						team: '<?php echo $has_profile->current_team_hash;?>',
						user: {
							tracking_id: <?php echo $current_user->ID; ?>,
							email: '<?php echo $current_user->user_email; ?>',
							name: '<?php echo $fullname;?>',
						}
					};
			  </script>
			<?php
		}
	}

}
