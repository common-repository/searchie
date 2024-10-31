<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
 * Base Class Utility
 * */
abstract class SIO_BaseController{
	/**
	 * get method via get and post request
	 *
	 *
	 * @return mix
	 * */
	public function get_method(){
		$action = '';
		if( isset( $_GET['_method'] ) ) {
			$action = sanitize_text_field( $_GET['_method'] );
		} elseif ( isset( $_POST['_method'] ) ) {
			$action = sanitize_text_field( $_POST['_method'] );
		} else {
			//index get in the page of get
			$action = sanitize_text_field( $_GET['page'] );
		}

		return	$action;
	}

	/**
	 * call method
	 *
	 * call the method in the class
	 *
	 * @param $class null | instantiate object
	 * 					the class object
	 * @param $method	empty
	 * 						method in class
	 * @param	$param_arr	null | array
	 * 							default is null, this is the third param of the call_user_func_array
	 * @return	class method
	 * */
	public function call_method( $class = null, $method = '', $param_arr = null ) {
		/**
		 * if the $method is empty, get the current $_GET array 'page' element
		 * mostly this is the index of the class
		 * */
		if ( sanitize_text_field( $method ) == '' ) {
			$method = $this->get_method();
		}
		/**
		 * make sure method name hyphen is converted into underscore
		 * */
		$method = str_replace( '-', '_', $method );
		/**
		 * check if method exists and if its callable
		 * */
		if(
			method_exists( $class, $method )
			&& is_callable( array ($class, $method ) )
		){
			return call_user_func_array( array( $class, $method ), array( $param_arr ) );
		}
	}

	/**
	 * base controller
	 *
	 * @param	$action		string
	 * @param	$arg		array | optional
	 * 						additional argument to be pass on controller method
	 * */
	abstract protected function controller( $action = '', $arg = array() );
}
