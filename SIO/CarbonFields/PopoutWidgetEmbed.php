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
class SIO_CarbonFields_PopoutWidgetEmbed {
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

  public function initWpHead() {
		$get_global_widget = SIO_Settings_Widgets::get_instance()->widget_global(['action' => 'r']);
		if ( !$get_global_widget ) {
			add_action( 'wp_head', [$this, 'js_script'], 100 );
		}
	}

  public function js_script( $args = [] ) {
    $use = carbon_get_post_meta( get_the_ID(), 'searchie_use_popout_widget');
    $type = carbon_get_post_meta( get_the_ID(), 'searchie_widget_embed_popout_type');
		$leftside = carbon_get_post_meta( get_the_ID(), 'searchie_widget_embed_popout_leftside');
		$custom_button = carbon_get_post_meta( get_the_ID(), 'searchie_widget_embed_popout_custombutton');
		$hash = carbon_get_post_meta( get_the_ID(), 'searchie_widget_embed_popout_hash');
		$float_position = carbon_get_post_meta( get_the_ID(), 'searchie_widget_embed_popout_button_position');

		if ($hash && $use) {
		  if ( isset($leftside) && $leftside == 'yes' ) {
		    $leftside = 'true';
		  } elseif ( isset($leftside) && $leftside == 'no' ) {
		    $leftside = 'false';
		  }
		  $popup_bool = false;
		  if ( $type == 'floating' ) {
		    $type = 'popup';
		    $float_position = $float_position;
		    $popup_bool = true;
		  } else {
		    $type = 'full';
		    $float_position = '';
		  }
		  if ( $custom_button == 'yes' ) {
		    $float_position = '';
		  }
		}
		if ( $hash && $hash !== '' && $use ) {
			?>
				<script>
				 (function(w,d,s,i,a,b,t,l,p) {
					 w._searchie = {widget:i,accent:a,background:b,type:t,left:l,position:p};var f=d.getElementsByTagName(s)[0],j=d.createElement(s);j.async = true;j.src='https://app.searchie.io/js/js-popup.js';f.parentNode.insertBefore(j,f);
				 })(window, document, 'script', '<?php echo $hash;?>', '#00C1CB', '#EDEFF3', '<?php echo $type;?>', '<?php echo $leftside;?>', '<?php echo $float_position;?>');
				</script>
			<?php
		}
  }

  public function init() {
    $api_url = [];
    $get_button_positions = SIO_Settings_Widgets::get_instance()->floatPositionArr();

		$get_api_widgets = SIO_API_Widgets::get_instance()->getOptions();

    if ( $get_api_widgets ) {
      foreach( $get_api_widgets as $widget ) {
        $api_url[$widget->hash] = sio_limit_str($widget->name);
      }
    }

		$get_global_widget = SIO_Settings_Widgets::get_instance()->widget_global(['action' => 'r']);
		if ( $get_global_widget ) {
			$arr_set = array(
					Field::make( 'html', 'crb_html', __( 'Warning' ) )
						->set_html( __( 'The global widget is set, need to set to none first, go to Searchine > Settings > Global pop-out widget to use > Set to None.' ) )
					);
		} else {
			$arr_set = array(
					Field::make( 'checkbox', 'searchie_use_popout_widget', __( 'Use Popout Widget?' ) )
						->set_option_value( 'no' ),
	  	    Field::make('select', 'searchie_widget_embed_popout_hash', __('Choose Widget to embed'))
	          ->add_options($api_url)
						->set_conditional_logic(array(
							array(
	                'field' => 'searchie_use_popout_widget',
	                'value' => true,
	            )
						)),
	        Field::make('select', 'searchie_widget_embed_popout_type', __('Widget Type'))
	          ->add_options(array(
							'full-height' => 'Full Height',
							'floating' => 'Floating Widget',
						))
						->set_conditional_logic(array(
							array(
	                'field' => 'searchie_use_popout_widget',
	                'value' => true,
	            )
						)),
	        Field::make('select', 'searchie_widget_embed_popout_leftside', __('Left Side'))
	          ->add_options(array(
							'yes' => 'Yes',
							'no' => 'No',
						))
						->set_conditional_logic(array(
							array(
	                'field' => 'searchie_use_popout_widget',
	                'value' => true,
	            )
						)),
	        Field::make('select', 'searchie_widget_embed_popout_custombutton', __('Custom Button'))
	          ->add_options(array(
							'yes' => 'Yes',
							'no' => 'No',
						))
						->set_conditional_logic(array(
							array(
	                'field' => 'searchie_use_popout_widget',
	                'value' => true,
	            ),
							array(
	                'field' => 'searchie_widget_embed_popout_type',
	                'value' => 'floating',
	                'compare' => '=',
	            ),
						)),
						Field::make( 'html', 'searchie_widget_embed_popout_custom_button_obj', __( 'Custom Button HTML' ) )
	    				->set_html( '<input type="text" class="searchie-widget-custom-button-html" style="width:100%;" value="&#x3C;a href=&#x22;javascript:window._searchie.toggle()&#x22;&#x3E;Click Here&#x3C;/a&#x3E;">' )
							->set_conditional_logic(array(
								array(
		                'field' => 'searchie_use_popout_widget',
		                'value' => true,
		            ),
								array(
		                'field' => 'searchie_widget_embed_popout_custombutton',
		                'value' => 'yes',
		                'compare' => '=',
		            ),
							)),
	        Field::make('select', 'searchie_widget_embed_popout_button_position', __('Button Position'))
	          ->add_options($get_button_positions)
	          ->set_conditional_logic(array(
							array(
	                'field' => 'searchie_use_popout_widget',
	                'value' => true,
	            ),
	            array(
	                'field' => 'searchie_widget_embed_popout_type',
	                'value' => 'floating',
	                'compare' => '=',
	            ),
	            array(
	                'field' => 'searchie_widget_embed_popout_custombutton',
	                'value' => 'no',
	                'compare' => '=',
	            ),
	          ))
	  	);
		}
    Container::make( 'post_meta', 'Searchie Pop-out Widget Embed' )
  	->where( 'post_type', '=', 'page' )
    ->or_where( 'post_type', '=', 'post' )
    ->set_context( 'side' )
  	->add_fields( $arr_set );
  }

}
