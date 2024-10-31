<?php
/**
 * Plugin Name:     Searchie Media Block
 * Description:     Use to embed media file in iframe.
 * Version:         0.1.0
 * Author:          allan.casilum
 * License:         GPL
 * License URI:     https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:     searchie-media-block
 *
 * @package         searchie-block
 */

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/block-editor/tutorials/block-tutorial/writing-your-first-block-type/
 */
function searchie_block_searchie_media_block_block_init() {
	register_block_type_from_metadata( __DIR__ );
}
add_action( 'init', 'searchie_block_searchie_media_block_block_init' );
