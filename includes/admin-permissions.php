<?php
/**
 * Admin Permissions
 *
 * @package mindgrub-starter-theme
 */

/**
 * Hide the admin bar for subscribers
 * 
 * @param bool $show Whether to show the admin bar.
 */
function mg_disable_admin_bar( $show ) {
	return ( current_user_can( 'edit_posts' ) ) ? $show : false;
}
// add_filter( 'show_admin_bar' , 'mg_disable_admin_bar');.


/**
 * Prevent subscribers from accessing wp-admin
 */
function mg_deny_admin_access() {
	if ( ! current_user_can( 'edit_posts' ) && ! wp_doing_ajax() ) {
		$redirected = wp_redirect( '/' );
		exit( esc_html( $redirected ) );
	}
}
// add_action( 'admin_init', 'mg_deny_admin_access', 100 );.
