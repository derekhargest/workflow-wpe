/**
 * Module: ui
 * General ui behaviors
 * 
 * @package mindgrub-starter-theme
 */

/**
 * Initialize ui behaviors.
 */
function init() {
	// Toggle active state.
	$( '[data-toggle-active]' ).on(
		'click',
		function(e) {
			e.preventDefault();
			var target = $( this ).data( 'toggle-active' );
			$( this ).toggleClass( 'active' );
			$( target ).toggleClass( 'active' );
		}
	);

	// Smooth scroll.
	$( '.js-scroll[href*="#"]:not([href="#"])' ).click(
		function() {
			if (location.pathname.replace( /^\//,'' ) == this.pathname.replace( /^\//,'' ) && location.hostname == this.hostname) {
				var target = $( this.hash );
				target     = target.length ? target : $( '[name=' + this.hash.slice( 1 ) + ']' );
				if (target.length) {
					$( 'html, body' ).animate(
						{
							scrollTop: target.offset().top
						},
						1000
					);
					return false;
				}
			}
		}
	);
}

/**
 * Public API
 *
 * @type {Object}
 */
module.exports = {
	init: init
};
