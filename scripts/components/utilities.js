/**
 * Module: utilities
 * General helper functions
 * 
 * @package mindgrub-starter-theme
 */

/**
 * Convert dash separated values into camel case format
 *
 * @param  {string} input The dash separated string to convert
 * @return {string}       The camel case formatted string
 */
function dashToCamel( input ) {
	return input.toLowerCase().replace(
		/-(.)/g,
		function(match, group1) {
			return group1.toUpperCase();
		}
	);
}

/**
 * Determine if a given string is a valid email address
 *
 * @param  {string} email The email address
 * @return {bool}
 */
var isEmail = function( email ) {
	var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	return regex.test( email );
}

/**
 * Public API
 */
module.exports = {
	dashToCamel: dashToCamel,
	isEmail : isEmail
};
