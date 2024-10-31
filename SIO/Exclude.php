<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
 * Use it to validate if the include files are excluded in certain areas in WP.
 */
interface SIO_Exclude
{
    public function exclude();
}
