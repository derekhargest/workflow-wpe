<?php
/**
 * Misc Functions
 *
 * @package mindgrub-starter-theme
 */

/**
 * Gets the URL of a single post with the given template name
 *
 * @param string $template The template file name ( including file extension ).
 * @return string|bool     The post object, or FALSE if no post was found
 */
function mg_get_post_by_template( $template ) {
	// Query for a single post that has the given template.
	$args = array(
		'post_type'      => 'any',
		'post_status'    => 'publish',
		'posts_per_page' => 1,
		'meta_query'     => array(
			array(
				'key'   => '_wp_page_template',
				'value' => $template,
			),
		),
	);

	$posts = get_posts( $args );

	// If there is a result, return post object - else return FALSE.
	if ( is_array( $posts ) ) {
		return array_shift( $posts );
	} else {
		return false;
	}
}

/**
 * Debug tool - displays contents of any variable wrapped in pre tags
 *
 * @param mixed $variable Variable you want to debug.
 */
function mg_debug( $variable ) {
	echo '<pre>';
	if ( is_array( $variable ) || is_object( $variable ) ) {
		print_r( $variable );
	} else {
		var_dump( $variable );
	}
	echo '</pre>';
}
