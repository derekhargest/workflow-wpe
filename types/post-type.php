<?php
/**
 * Post Type Declaration
 *
 * @package mindgrub-starter-theme
 */

$labels = array(
	'name'               => 'Post Types',
	'singular_name'      => 'Post Type',
	'add_new'            => 'Add New',
	'add_new_item'       => 'Add New Post Type',
	'edit_item'          => 'Edit Post Type',
	'new_item'           => 'New Post Type',
	'view_item'          => 'View Post Type',
	'search_items'       => 'Search Post Types',
	'not_found'          => 'No Post Types Found',
	'not_found_in_trash' => 'No Post Types Found in Trash',
	'menu_name'          => 'Post Types',
	'back_to_items'      => 'Back to types',
);

$args = array(
	'labels'              => $labels,
	'description'         => '',
	'public'              => true,
	'exclude_from_search' => false,
	'publicly_queryable'  => true,
	'show_ui'             => true,
	'show_in_nav_menus'   => false,
	'show_in_menu'        => true,
	'show_in_admin_bar'   => true,
	'menu_position'       => 10,
	'menu_icon'           => 'dashicons-images-alt2', // https://developer.wordpress.org/resource/dashicons/.
	'capability_type'     => 'post',
	'hierarchical'        => true,
	'supports'            => array( 'title', 'editor', 'thumbnail' ),
	'taxonomies'          => array(),
	'has_archive'         => true,
);

register_post_type( 'post-type', $args );

/**
 * Custom Title Placeholder
 * 
 * @param string $title 
 */
function mg_change_post_type_title_placeholder( $title ) {
	$screen = get_current_screen();
	if ( 'post-type' == $screen->post_type ) {
		$title = 'Enter post type title here';
	}
	return $title;
}
add_filter( 'enter_title_here', 'mg_change_post_type_title_placeholder' );
