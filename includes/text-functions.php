<?php
/**
 * Text Functions
 *
 * @package mindgrub-starter-theme
 */

/**
 * Checks if a string starts with a given sub string
 * https://stackoverflow.com/questions/834303/startswith-and-endswith-functions-in-php
 *
 * @param  string $haystack String to check within.
 * @param  string $needle   String to check for.
 * @return bool
 */
function mg_str_starts_with( $haystack, $needle ) {
	$length = strlen( $needle );
	return ( substr( $haystack, 0, $length ) === $needle );
}

/**
 * Checks if a string ends with a given sub string
 * https://stackoverflow.com/questions/834303/startswith-and-endswith-functions-in-php
 *
 * @param  string $haystack String to check within.
 * @param  string $needle   String to check for.
 * @return bool
 */
function mg_str_ends_with( $haystack, $needle ) {
	$length = strlen( $needle );
	if ( 0 == $length ) {
		return true;
	}

	return ( substr( $haystack, -$length ) === $needle );
}

/**
 * Converts a string into URL share friendly format
 *
 * @param  string $string String to format.
 * @return string         URL sharable string
 */
function mg_format_url_safe_text( $string ) {
	return htmlspecialchars( urlencode( html_entity_decode( $string, ENT_COMPAT, 'UTF-8' ) ), ENT_COMPAT, 'UTF-8' );
}

/**
 * Truncates a string to the nearest word under a given maximum length
 *
 * @param string $string The string which will be truncated.
 * @param int    $length The length to which to truncate the string.
 * @param string $append A string that will be appended to the end of a truncated string.
 */
function mg_truncate( $string, $length, $append = '&hellip;' ) {
	if ( strlen( $string ) > $length ) {
		$string  = substr( $string, 0, strrpos( substr( $string, 0, $length ), ' ' ) );
		$string .= $append;
	}
	return $string;
}
