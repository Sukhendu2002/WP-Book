<?php
/**
 * Class Wp_Book_Taxonomies
 *
 * Handles the custom taxonomies for the plugin.
 *
 * @link       https://github.com/Sukhendu2002/
 * @since      1.0.0
 *
 * @package    Wp_Book
 * @subpackage Wp_Book/includes
 */

/**
 * Class Wp_Book_Taxonomies
 *
 * Handles the custom taxonomies for the plugin.
 *
 * @package    Wp_Book
 * @subpackage Wp_Book/includes
 * @author     Sukhendu Sekhar Guria <dev.sukhendu@gmail.com>
 */
class Wp_Book_Taxonomies {
	/**
	 * Register the custom taxonomies for the plugin.
	 *
	 * @since    1.0.0
	 */
	public static function register_taxonomies() {
		// Hierarchical Taxonomy (Book Category).
		$category_labels = array(
			'name'              => _x( 'Book Categorys', 'taxonomy general name', 'wp-book' ),
			'singular_name'     => _x( 'Book Category', 'taxonomy singular name', 'wp-book' ),
			'search_items'      => __( 'Search Book Categorys', 'wp-book' ),
			'all_items'         => __( 'All Book Categorys', 'wp-book' ),
			'parent_item'       => __( 'Parent Book Category', 'wp-book' ),
			'parent_item_colon' => __( 'Parent Book Category:', 'wp-book' ),
			'edit_item'         => __( 'Edit Book Category', 'wp-book' ),
			'update_item'       => __( 'Update Book Category', 'wp-book' ),
			'add_new_item'      => __( 'Add New Book Category', 'wp-book' ),
			'new_item_name'     => __( 'New Book Category Name', 'wp-book' ),
			'menu_name'         => __( 'Book Category', 'wp-book' ),
		);
		$category_args   = array(
			'labels'             => $category_labels,
			'description'        => __( 'Custom Hierarchical Taxonomy Book Category', 'wp-book' ),
			'hierarchical'       => true,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'show_in_nav_menus'  => true,
			'show_tagcloud'      => true,
			'show_in_quick_edit' => true,
			'show_admin_column'  => false,
			'show_in_rest'       => true,
			'rewrite'            => array( 'slug' => 'book_category' ),
		);
		register_taxonomy( 'book_category', array( 'book' ), $category_args );

		// Non-hierarchical Taxonomy (Book Tag).
		$tag_labels = array(
			'name'              => _x( 'Book Tags', 'taxonomy general name', 'wp-book' ),
			'singular_name'     => _x( 'Book Tag', 'taxonomy singular name', 'wp-book' ),
			'search_items'      => __( 'Search Book Tags', 'wp-book' ),
			'all_items'         => __( 'All Book Tags', 'wp-book' ),
			'parent_item'       => null,
			'parent_item_colon' => null,
			'edit_item'         => __( 'Edit Book Tag', 'wp-book' ),
			'update_item'       => __( 'Update Book Tag', 'wp-book' ),
			'add_new_item'      => __( 'Add New Book Tag', 'wp-book' ),
			'new_item_name'     => __( 'New Book Tag Name', 'wp-book' ),
			'menu_name'         => __( 'Book Tag', 'wp-book' ),
		);
		$tag_args   = array(
			'labels'             => $tag_labels,
			'description'        => __( 'Custom Non-Hierarchical Taxonomy Book Tag', 'wp-book' ),
			'hierarchical'       => false,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'show_in_nav_menus'  => true,
			'show_tagcloud'      => true,
			'show_in_quick_edit' => true,
			'show_admin_column'  => false,
			'show_in_rest'       => true,
			'rewrite'            => array( 'slug' => 'book_tag' ),
		);
		register_taxonomy( 'book_tag', array( 'book' ), $tag_args );
	}
}
