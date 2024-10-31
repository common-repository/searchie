<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Add custom searchie block category.
 */
function sio_block_category( $categories, $post ) {
	return array_merge(
		$categories,
		array(
			array(
				'slug' => 'searchie-blocks',
				'title' => __( 'Searchie', 'searchie-blocks' ),
			),
		)
	);
}
add_filter( 'block_categories', 'sio_block_category', 10, 2);
