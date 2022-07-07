<?php
/**
 * Functions
 *
 * @package mindgrub-starter-theme
 */

/**
 * Add supports, register components, and include compartamentalized theme functions.
 */
function mg_theme_setup() {
	// Enable support for post thumbnails on posts and pages.
	add_theme_support( 'post-thumbnails' );

	// Add custom image sizes.
	// add_image_size( $name, $width = 0, $height = 0, $crop = false );.

	// Enable support for automated page titles.
	add_theme_support( 'title-tag' );

	// Enable support for HTML5 markup.
	add_theme_support( 'html5', array( 'comment-list', 'search-form', 'comment-form', 'gallery', 'caption' ) );

	// Add WYSIWYG editor stylesheet.
	add_editor_style( '/dist/styles/editor-styles.min.css' );

	// Register commonly used menus.
	register_nav_menus(
		array(
			'header' => 'Header Navigation',
			'footer' => 'Footer Navigation',
		)
	);

	// Register commonly used menus.
	register_sidebar(
		array(
			'name'          => 'Sidebar',
			'id'            => 'sidebar',
			'class'         => 'widget',
			'description'   => 'Sidebar',
			'before_widget' => '<li class="widget %2$s"><div class="widget__content">',
			'after_widget'  => '</div></li>',
			'before_title'  => '<h4 class="widget__title">',
			'after_title'   => '</h4>',
		)
	);

	// Cleanup Head.
	remove_action( 'wp_head', 'rsd_link' );
	remove_action( 'wp_head', 'wp_generator' );
	remove_action( 'wp_head', 'feed_links', 2 );
	remove_action( 'wp_head', 'index_rel_link' );
	remove_action( 'wp_head', 'wlwmanifest_link' );
	remove_action( 'wp_head', 'feed_links_extra', 3 );
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
	remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 );
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'wp_head', 'wp_oembed_add_host_js' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );

	// Include custom post types, custom taxonomies, general includes, and plugin customizations.
	$includes = array_merge(
		glob( get_theme_root() . '/' . get_template() . '/taxonomies/*.php' ), // All taxonomies.
		glob( get_theme_root() . '/' . get_template() . '/types/*.php' ), // All custom post types.
		glob( get_theme_root() . '/' . get_template() . '/includes/*.php' ), // All includes.
		glob( get_theme_root() . '/' . get_template() . '/plugins/*.php' ) // All plugin customizations.
	);

	// Include files.
	if ( $includes ) {
		foreach ( $includes as $include ) {
			include_once $include;
		}
	}
}
add_action( 'after_setup_theme', 'mg_theme_setup' );
