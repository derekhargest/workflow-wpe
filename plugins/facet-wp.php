<?php
/**
 * FacetWP plugin modifications.
 *
 * @package mindgrub-starter-theme
 */

/**
 * Instruct facetwp to look for a query var to trigger filtering on a non-archive or non-search template
 * 
 * @param bool     $is_main_query Whether FacetWP should use the current query.
 * @param WP_Query $query The WP_Query object.
 */
function mg_facetwp_is_main_query( $is_main_query, $query ) {
	if ( isset( $query->query_vars['facetwp'] ) ) {
		$is_main_query = true;
	}

	return $is_main_query;
}
add_filter( 'facetwp_is_main_query', 'mg_facetwp_is_main_query', 10, 2 );

/**
 * Remove default facetwp CSS
 * 
 * @param array $assets An associative array of assets to load.
 */
function mg_facetwp_remove_assets( $assets ) {
	unset( $assets['front.css'] );
	return $assets;
}
add_filter( 'facetwp_assets', 'mg_facetwp_remove_assets' );

/**
 * Escapes facet output
 *
 * @param string $string Content to filter through kses.
 */
function mg_kses_facet( $string ) {
	$allowed_facet_tags = array(
		'div' => array(
			'data-name' => true,
			'data-type' => true,
		),
	);

	// Add global attributes.
	$allowed_facet_tags = array_map( '_wp_add_global_attributes', $allowed_facet_tags );

	return wp_kses( $string, $allowed_facet_tags );
}
