<?php
/**
 * Handle admin side widget functionality.
 *
 * @link       https://github.com/Sukhendu2002/
 * @since      1.0.0
 *
 * @package    Wp_Book
 * @subpackage Wp_Book/admin
 */

/**
 * Handle admin side widget functionality.
 *
 * @package    Wp_Book
 * @subpackage Wp_Book/admin
 * @author     Sukhendu Sekhar Guria <dev.sukhendu@gmail.com>
 */
class Wp_Book_Admin_Widget {
	/**
	 * Register the dashboard widget.
	 *
	 * @since    1.0.0
	 */
	public function dashboard_widget_content() {
		$categories = $this->get_top_book_categories();

		if ( empty( $categories ) ) {
			echo 'No book categories found.';
			return;
		}

		echo '<ul>';
		foreach ( $categories as $category ) {
			echo '<li>
                <a 
                href="' . esc_url( admin_url( 'edit.php?post_type=book&book_category=' . $category->slug ) ) . '">' . esc_html( $category->name ) . '</a>
                (' . esc_html( $category->count ) . ')
            </li>';
		}
		echo '</ul>';
	}

	/**
	 * Get the top book categories.
	 *
	 * @return array
	 * @since 1.0.0
	 */
	private function get_top_book_categories() {
		$categories = get_categories(
			array(
				'taxonomy' => 'book_category',
				'orderby'  => 'count',
				'order'    => 'DESC',
				'number'   => 5,
			)
		);

		return $categories;
	}
}
