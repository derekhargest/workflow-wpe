<?php
/**
 * Advanced Custom Fields plugin modifications
 *
 * @package mindgrub-starter-theme
 */

/**
 * Retrieves the url of an image uploaded via an ACF image field
 * TODO: Add support for return types other than array
 *
 * @param (string) $name The name of the ACF field - assume default return of image array is used.
 * @param (string) $size The size of the image to be retrieved.
 * @return (string) The image url ( defaults to original size )
 */
function mg_get_acf_image_src( $name, $size = 'thumbnail' ) {
	// Return false if ACF is not active.
	if ( ! function_exists( 'get_field' ) ) {
		return false;
	}

	$image_type  = get_field_object( $name )['return_format'];
	$image_value = ( get_row() ) ? get_sub_field( $name ) : get_field( $name );

	switch ( $image_type ) {
		case 'array':
			$image_url = mg_get_image_src_from_array( $image_value, $size );
			break;
		case 'id':
			$image_url = wp_get_attachment_image_url( $image_value, $size );
			break;
		case 'url':
			$image_url = wp_get_attachment_image_url( attachment_url_to_postid( $image_value ), $size );
			break;
		default:
			return false;
	}
	return $image_url;
}

/**
 * Echos the url of an image uploaded via an ACF image field
 *
 * @param (string) $name The name of the ACF field - assume default return of image object is used.
 * @param (string) $size The size of the image to be retrieved.
 */
function mg_the_acf_image_src( $name, $size = 'thumbnail' ) {
	echo esc_url( mg_get_acf_image_src( $name, $size ) );
}

/**
 * Adds ACF options pages.
 */
function mg_add_acf_options_page() {
	if ( function_exists( 'acf_add_options_page' ) ) {

		// Main parent menu entry.
		$parent = acf_add_options_page(
			array(
				'page_title' => 'Theme Options',
				'menu_title' => 'Theme Options',
				'menu_slug'  => 'theme-options',
				'capability' => 'edit_posts',
				'redirect'   => false,
			)
		);

		// Contact Us block settings.
		acf_add_options_sub_page(
			array(
				'page_title'  => 'Tracking Scripts',
				'menu_title'  => 'Tracking Scripts',
				'capability'  => 'edit_posts',
				'parent_slug' => $parent['menu_slug'],
			)
		);
	}
}
add_action( 'acf/init', 'mg_add_acf_options_page' );
