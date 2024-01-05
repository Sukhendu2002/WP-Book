<?php
/**
 * Register Custom Post.
 *
 * @link       https://github.com/Sukhendu2002/
 * @since      1.0.0
 *
 * @package    Wp_Book
 * @subpackage Wp_Book/includes
 */

/**
 * Register Custom Post Type.
 *
 * @package    Wp_Book
 * @subpackage Wp_Book/includes
 * @author     Sukhendu Sekhar Guria <dev.sukhendu@gmail.com>
 */
class Wp_Book_Custom_Post_Type {
	/**
	 * Add a new custom post type called 'book'.
	 *
	 * @since    1.0.0
	 * @access   public
	 * @return   void
	 */
	public static function register_custom_post_type() {
		$labels = array(
			'name'                  => _x( 'Books', 'Post Type General Name', 'wp-book' ),
			'singular_name'         => _x( 'Book', 'Post Type Singular Name', 'wp-book' ),
			'menu_name'             => _x( 'Books', 'Admin Menu text', 'wp-book' ),
			'name_admin_bar'        => _x( 'Book', 'Add New on Toolbar', 'wp-book' ),
			'archives'              => __( 'Book Archives', 'wp-book' ),
			'attributes'            => __( 'Book Attributes', 'wp-book' ),
			'parent_item_colon'     => __( 'Parent Book:', 'wp-book' ),
			'all_items'             => __( 'All Books', 'wp-book' ),
			'add_new_item'          => __( 'Add New Book', 'wp-book' ),
			'add_new'               => __( 'Add New', 'wp-book' ),
			'new_item'              => __( 'New Book', 'wp-book' ),
			'edit_item'             => __( 'Edit Book', 'wp-book' ),
			'update_item'           => __( 'Update Book', 'wp-book' ),
			'view_item'             => __( 'View Book', 'wp-book' ),
			'view_items'            => __( 'View Books', 'wp-book' ),
			'search_items'          => __( 'Search Book', 'wp-book' ),
			'not_found'             => __( 'Not found', 'wp-book' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'wp-book' ),
			'featured_image'        => __( 'Featured Image', 'wp-book' ),
			'set_featured_image'    => __( 'Set featured image', 'wp-book' ),
			'remove_featured_image' => __( 'Remove featured image', 'wp-book' ),
			'use_featured_image'    => __( 'Use as featured image', 'wp-book' ),
			'insert_into_item'      => __( 'Insert into Book', 'wp-book' ),
			'uploaded_to_this_item' => __( 'Uploaded to this Book', 'wp-book' ),
			'items_list'            => __( 'Books list', 'wp-book' ),
			'items_list_navigation' => __( 'Books list navigation', 'wp-book' ),
			'filter_items_list'     => __( 'Filter Books list', 'wp-book' ),
		);
		$args   = array(
			'label'               => __( 'Book', 'wp-book' ),
			'description'         => __( 'Custom Post Type for Book', 'wp-book' ),
			'labels'              => $labels,
			'menu_icon'           => 'dashicons-book',
			'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', 'author', 'comments' ),
			'taxonomies'          => array(),
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 5,
			'rewrite'             => array( 'slug' => 'book' ),
			'show_in_admin_bar'   => true,
			'show_in_nav_menus'   => true,
			'can_export'          => true,
			'has_archive'         => true,
			'hierarchical'        => false,
			'exclude_from_search' => false,
			'show_in_rest'        => true,
			'publicly_queryable'  => true,
			'capability_type'     => 'post',
		);
		register_post_type( 'book', $args );
	}
}
