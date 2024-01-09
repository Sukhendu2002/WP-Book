<?php
/**
 * Custom widget to display books of a selected category in the sidebar.
 *
 * @link       https://github.com/Sukhendu2002/
 * @since      1.0.0
 *
 * @package    Wp_Book
 * @subpackage Wp_Book/public
 */

/**
 * Custom widget to display books of a selected category in the sidebar.
 *
 * @package    Wp_Book
 * @subpackage Wp_Book/public
 * @author     Sukhendu Sekhar Guria <dev.sukhendu@gmail.com>
 */
class Wp_Book_Public_Widget extends WP_Widget {
	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
			'wp_book_widget',
			__( 'WP Book Widget', 'wp-book' ),
			array(
				'description'                 => __( 'A custom widget to display books of a selected category in the sidebar.', 'wp-book' ),
				'customize_selective_refresh' => true,
				'classname'                   => 'wp_book_widget',
			)
		);
	}

	/**
	 * Front-end display of the widget.
	 *
	 * @param array $args Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {

		echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}

		$category    = isset( $instance['category'] ) ? $instance['category'] : '';
		$books_query = new WP_Query(
			array(
				'post_type'      => 'book',
				'posts_per_page' => -1,
				'tax_query'      => array(
					array(
						'taxonomy' => 'book_category',
						'field'    => 'slug',
						'terms'    => $category,
					),
				),
			)
		);

		if ( $books_query->have_posts() ) {
			echo '<ul>';
			while ( $books_query->have_posts() ) {
				$books_query->the_post();
				echo '<li><a href="' . esc_url( get_permalink() ) . '">' . esc_html( get_the_title() ) . '</a></li>';
			}
			echo '</ul>';
			wp_reset_postdata();
		} else {
			echo '<p>No books found in the selected category.</p>';
		}

		echo $args['after_widget']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}

	/**
	 * Back-end widget form.
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : '';
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">Title:</label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>

		<?php
		$categories = get_categories(
			array(
				'taxonomy'   => 'book_category',
				'hide_empty' => true,
			)
		);
		$category   = ! empty( $instance['category'] ) ? $instance['category'] : '';

		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'category' ) ); ?>">Select Category:</label>
			<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'category' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'category' ) ); ?>">
				<option value="">Select</option>
				<?php
				foreach ( $categories as $cat ) {
					echo '<option value="' . esc_attr( $cat->slug ) . '" ' . selected( $category, $cat->slug, false ) . '>' . esc_html( $cat->name ) . '</option>';
				}
				?>
			</select>
		</p>
		<?php
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance             = array();
		$instance['title']    = sanitize_text_field( $new_instance['title'] );
		$instance['category'] = sanitize_text_field( $new_instance['category'] );
		return $instance;
	}
}
