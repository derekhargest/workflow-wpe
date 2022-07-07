<?php
/**
 * Admin
 *
 * @package mindgrub-starter-theme
 */

/**
 * Remove default link option for images
 */
function mg_imagelink_setup() {
	$image_set = get_option( 'image_default_link_type' );
	if ( 'none' !== $image_set ) {
		update_option( 'image_default_link_type', 'none' );
	}
}
add_action( 'admin_init', 'mg_imagelink_setup', 10 );

/**
 * Add ability to upload SVGs
 * 
 * @param array $existing_mimes Currently allowed file types.
 * @return array Modified allowed file types.
 */
function mg_upload_types( $existing_mimes = array() ) {
	$existing_mimes['svg'] = 'image/svg+xml';
	return $existing_mimes;
}
add_filter( 'upload_mimes', 'mg_upload_types' ); // phpcs:ignore
