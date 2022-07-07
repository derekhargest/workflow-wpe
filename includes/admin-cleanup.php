<?php
/**
 * Admin Cleanup
 *
 * @package mindgrub-starter-theme
 */

/**
 * Remove unnecessary dashboard meta boxes
 */
function mg_remove_dashboard_widgets() {
	// remove_meta_box('dashboard_right_now', 'dashboard', 'normal');       // Right Now.
	remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );    // Recent Comments.
	remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );     // Incoming Links.
	remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );            // Plugins.
	remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );          // Quick Press.
	remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );        // Recent Drafts.
	remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );              // WordPress blog.
	remove_meta_box( 'dashboard_secondary', 'dashboard', 'side' );            // Other WordPress News.
}
add_action( 'wp_dashboard_setup', 'mg_remove_dashboard_widgets' );

/**
 * Unregisters unnecesary default widgets
 */
function mg_unregister_default_widgets() {
	unregister_widget( 'WP_Widget_Calendar' );
	unregister_widget( 'WP_Widget_Search' );
	unregister_widget( 'WP_Widget_Recent_Comments' );
	unregister_widget( 'WP_Widget_Meta' );
	unregister_widget( 'WP_Widget_Links' );
	unregister_widget( 'WP_Widget_Pages' );
	unregister_widget( 'WP_Widget_Archives' );
	unregister_widget( 'WP_Widget_Recent_Posts' );
	unregister_widget( 'WP_Widget_Tag_Cloud' );
	unregister_widget( 'WP_Widget_RSS' );
	unregister_widget( 'WP_Widget_Categories' );
	// unregister_widget('WP_Widget_Text');.
	unregister_widget( 'WP_Nav_Menu_Widget' );
	unregister_widget( 'GFWidget' );
}
add_action( 'widgets_init', 'mg_unregister_default_widgets' );

/**
 * Hide admin pages that are not used
 */
function mg_remove_menu_pages() {
	remove_menu_page( 'edit-comments.php' );    // Comments.
	remove_menu_page( 'edit.php' );             // Posts.
}
// add_action('admin_menu', 'mg_remove_menu_pages');.
