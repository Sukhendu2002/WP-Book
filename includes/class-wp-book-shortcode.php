<?php
/**
 * Handle the shortcode.
 *
 * @link       https://github.com/Sukhendu2002/
 * @since      1.0.0
 *
 * @package    Wp_Book
 * @subpackage Wp_Book/public
 */

/**
 * Class Wp_Book_Public_Shortcode
 *
 * Handle the shortcode.
 *
 * @package    Wp_Book
 * @subpackage Wp_Book/public
 * @author     Sukhendu Sekhar Guria <dev.sukhendu@gmail.com>
 */
class Wp_Book_Shortcode {

	/**
	 * Create a Shortcode [book].
	 *
	 * @return void.
	 */
	public function wp_book_shortcode_init() {
		add_shortcode( 'book', array( $this, 'wp_book_shortcode' ) );
	}

	/**
	 * Shortcode callback function.
	 *
	 * @param array $atts Shortcode attributes.
	 */
	public function wp_book_shortcode( $atts ) {

		$atts = shortcode_atts(
			array(
				'id'          => 0,
				'author_name' => '',
				'publisher'   => '',
				'year'        => '',
				'edition'     => '',
				'price'       => '',
				'url'         => '',

			),
			$atts,
			'book'
		);

		$args = array(
			'post_type'      => 'book',
			'post_status'    => 'publish',
			'posts_per_page' => get_option( 'wp_book_books_per_page' ),
		);

		$query = new WP_Query( $args );
		if ( $query->have_posts() ) {
			$content = '<div class="wp-book">';
			while ( $query->have_posts() ) {
				$query->the_post();
				$currency = get_option( 'wp_book_currency' );
				$price    = get_metadata( 'book', get_the_ID(), 'wpbook_price', true );

				if ( '$' === $currency && '' !== $price ) {
					$price = $price * 0.014;
				} elseif ( '€' === $currency && '' !== $price ) {
					$price = $price * 0.012;
				} elseif ( '£' === $currency && '' !== $price ) {
					$price = $price * 0.011;
				} elseif ( '¥' === $currency && '' !== $price ) {
					$price = $price * 1.49;
				}

				$content .= '<div class="wp-book-card">';
				$content .= '<div class="wp-book-card-title"><a href="' . esc_url( get_permalink() ) . '">' . esc_html( get_the_title() ) . '</a></div>';
				$content .= '<div class="wp-book-card-info">
					<span class="wp-book-card-label">Author: </span> ' . get_metadata( 'book', get_the_ID(), 'wpbook_authorname', true ) . '
				</div>';
				$content .= '<div class="wp-book-card-info">
					<span class="wp-book-card-label">Publisher: </span> ' . get_metadata( 'book', get_the_ID(), 'wpbook_publisher', true ) . '
				</div>';
				$content .= '<div class="wp-book-card-info">
					<span class="wp-book-card-label">Price(' . $currency . '): </span> ' . $price . '
				</div>';
				$content .= '<div class="wp-book-card-info">
					<span class="wp-book-card-label">Year: </span> ' . get_metadata( 'book', get_the_ID(), 'wpbook_year', true ) . '
				</div>';
				$content .= '<div class="wp-book-card-info">
					<span class="wp-book-card-label">Edition: </span> ' . get_metadata( 'book', get_the_ID(), 'wpbook_edition', true ) . '
				</div>';
				$content .= '<div class="wp-book-card-info">
					<span class="wp-book-card-label">URL: </span><a
						href="' . get_metadata( 'book', get_the_ID(), 'wpbook_url', true ) . '"
						target="_blank"
					>Link</a>
				</div>';
				$content .= '</div>';
			}
			$content .= '</div>';
			wp_reset_postdata();
		} else {
			$content = __( 'No books found', 'wp-book' );
		}

		return $content;
	}
}
