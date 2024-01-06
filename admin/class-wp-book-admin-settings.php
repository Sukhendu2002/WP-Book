<?php
/**
 * Handles the creation and saving of the custom admin settings for Books.
 *
 * @link       https://github.com/Sukhendu2002/
 * @since      1.0.0
 *
 * @package    Wp_Book
 * @subpackage Wp_Book/admin
 */

/**
 * Class Wp_Book_Settings
 *
 * @package    Wp_Book
 * @subpackage Wp_Book/admin
 * @author     Sukhendu Sekhar Guria <dev.sukhendu@gmail.com>
 */
class Wp_Book_Admin_Settings {

	/**
	 * Add the custom settings page.
	 *
	 * @since 1.0.0
	 */
	public function add_settings_page() {
		add_submenu_page(
			'edit.php?post_type=book',
			'Book Settings',
			'Settings',
			'manage_options',
			'wp_book_settings',
			array( $this, 'render_settings_page' )
		);
	}

	/**
	 * Render the contents of the settings page.
	 *
	 * @since 1.0.0
	 */
	public function render_settings_page() {
		?>
		<div class="wrap">
			<h1>Book Settings</h1>
			<form method="post" action="options.php">
				<?php
				settings_fields( 'wp_book_settings' );
				do_settings_sections( 'wp_book_settings' );
				submit_button();
				?>
			</form>
		</div>
		<?php
	}

	/**
	 * Register the settings.
	 *
	 * @since 1.0.0
	 */
	public function register_settings() {
		register_setting(
			'wp_book_settings',
			'wp_book_currency',
			array( 'sanitize_callback' => 'sanitize_text_field' )
		);

		register_setting(
			'wp_book_settings',
			'wp_book_books_per_page',
			array( 'sanitize_callback' => 'absint' )
		);

		add_settings_section(
			'wp_book_general',
			'General Settings',
			array( $this, 'render_general_section' ),
			'wp_book_settings'
		);

		add_settings_field(
			'wp_book_currency',
			'Currency',
			array( $this, 'render_currency_field' ),
			'wp_book_settings',
			'wp_book_general'
		);

		add_settings_field(
			'wp_book_books_per_page',
			'Number of Books Displayed Per Page',
			array( $this, 'render_books_per_page_field' ),
			'wp_book_settings',
			'wp_book_general'
		);
	}

	/**
	 * Render the contents of the general settings section.
	 *
	 * @since 1.0.0
	 */
	public function render_general_section() {
		echo '<p>Configure general settings for the Book plugin.</p>';
	}

	/**
	 * Render the currency field.
	 *
	 * @since 1.0.0
	 */
	public function render_currency_field() {
		$currency_options = array(
			'$' => 'Dollar ($)',
			'€' => 'Euro (€)',
			'£' => 'Pound Sterling (£)',
			'¥' => 'Yen (¥)',
			'₹' => 'Indian Rupee (₹)',
		);

		$selected_currency = get_option( 'wp_book_currency', '₹' );
		?>
		<select name="wp_book_currency">
			<?php
			foreach ( $currency_options as $code => $label ) {
				printf(
					'<option value="%s" %s>%s</option>',
					esc_attr( $code ),
					selected( $selected_currency, $code, false ),
					esc_html( $label )
				);
			}
			?>
		</select>
		<p class="description">Select the currency.</p>
		<?php
	}

	/**
	 * Render the books per page field.
	 *
	 * @since 1.0.0
	 */
	public function render_books_per_page_field() {
		$books_per_page = get_option( 'wp_book_books_per_page', 10 );
		?>
		<input type="number" name="wp_book_books_per_page" value="<?php echo esc_attr( $books_per_page ); ?>" min="1">
		<p class="description">Enter the number of books displayed per page.</p>
		<?php
	}
}
