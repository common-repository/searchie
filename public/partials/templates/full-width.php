<?php
/**
* Template Name: Searchie Full Width Page
* Template Post Type: post, page
*
* @package Searchie
*/
get_header();

?>

<?php do_action('sio-before-bootstrap-container'); ?>

<div class="bootstrap-iso">

  <?php do_action('sio-before-container'); ?>

  <div class="container-fluid <?php echo apply_filters('sio-full-width-template-class', ''); ?>" >

    <?php do_action('sio-before-loop'); ?>

    <?php

    	if ( have_posts() ) {

    		while ( have_posts() ) {
    			the_post();

    			the_content();
    		}
    	}

  	?>

    <?php do_action('sio-after-loop'); ?>

  </div>

  <?php do_action('sio-after-container'); ?>

</div>

<?php do_action('sio-after-bootstrap-container'); ?>

<?php get_footer(); ?>
