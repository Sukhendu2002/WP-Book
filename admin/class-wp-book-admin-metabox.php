<?php
/**
 * Class Wp_Book_Admin_Metabox
 *
 * Handles the creation and saving of the custom meta box for book information in the admin section.
 *
 * @link       https://github.com/Sukhendu2002/
 * @since      1.0.0
 *
 * @package    Wp_Book
 * @subpackage Wp_Book/admin
 */

/**
 * Class Wp_Book_Admin_Metabox
 *
 * Handles the creation and saving of the custom meta box for book information in the admin section.
 *
 * @package    Wp_Book
 * @subpackage Wp_Book/admin
 * @author     Sukhendu Sekhar Guria <dev.sukhendu@gmail.com>
 */
class Wp_Book_Admin_Metabox {
	/**
	 * Post types to add meta box.
	 *
	 * @var array
	 */
	private $screens = array( 'book' );

	/**
	 * Meta box fields.
	 *
	 * @var string
	 */
	private $fields = array(
		array(
			'label' => 'Author Name',
			'id'    => 'wpbook_authorname',
			'type'  => 'text',
		),
		array(
			'label' => 'Price',
			'id'    => 'wpbook_price',
			'type'  => 'text',
		),
		array(
			'label' => 'Publisher',
			'id'    => 'wpbook_publisher',
			'type'  => 'text',
		),
		array(
			'label' => 'Year',
			'id'    => 'wpbook_year',
			'type'  => 'text',
		),
		array(
			'label' => 'Edition',
			'id'    => 'wpbook_edition',
			'type'  => 'text',
		),
		array(
			'label' => 'URL',
			'id'    => 'wpbook_url',
			'type'  => 'text',
		),
	);

		/**
		 * Add the custom meta box.
		 *
		 * @since 1.0.0
		 */
	public function add_meta_box() {
		foreach ( $this->screens as $s ) {
			add_meta_box(
				'BookInfo',
				__( 'Book Info', 'wp-book' ),
				array( $this, 'meta_box_callback' ),
				$s,
				'side',
				'high'
			);
		}
	}

		/**
		 * Callback function to add nonce and render meta box.
		 *
		 * @param WP_Post $post Post object.
		 */
	public function meta_box_callback( $post ) {
		wp_nonce_field( 'BookInfo_data', 'BookInfo_nonce' );
		echo 'Information about Books';
		$this->field_generator( $post );
	}

		/**
		 * Generate HTML for table rows.
		 *
		 * @param mixed $post Post object.
		 */
	public function field_generator( $post ) {
		$output = '';
		foreach ( $this->fields as $field ) {
			$label      = '<label for="' . $field['id'] . '">' . $field['label'] . '</label>';
			$meta_value = get_metadata( 'book', $post->ID, $field['id'], true );
			if ( empty( $meta_value ) ) {
				if ( isset( $field['default'] ) ) {
					$meta_value = $field['default'];
				}
			}
			switch ( $field['type'] ) {
				default:
					$input = sprintf(
						'<input %s id="%s" name="%s" type="%s" value="%s">',
						'color' !== $field['type'] ? 'style="width: 100%"' : '',
						$field['id'],
						$field['id'],
						$field['type'],
						$meta_value
					);
			}
			$output .= $this->format_rows( $label, $input );
		}
		echo '<table class="form-table"><tbody>' . $output . '</tbody></table>';
	}

	/**
	 * Format table rows.
	 *
	 * @param mixed $label Label.
	 * @param mixed $input Input.
	 */
	public function format_rows( $label, $input ) {
		return '<div style="margin-top: 10px;"><strong>' . $label . '</strong></div><div>' . $input . '</div>';
	}


	/**
	 * Save the meta data when the post is saved.
	 *
	 * @param int $post_id Post ID.
	 *
	 * @since 1.0.0
	 */
	public function save_meta_data( $post_id ) {
		if ( ! isset( $_POST['BookInfo_nonce'] ) ) {
			return $post_id;
		}
		$nonce = sanitize_text_field( wp_unslash( $_POST['BookInfo_nonce'] ) );
		if ( ! wp_verify_nonce( $nonce, 'BookInfo_data' ) ) {
			return $post_id;
		}
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return $post_id;
		}
		foreach ( $this->fields as $field ) {
			$id = '';
			if ( isset( $_POST[ $field['id'] ] ) ) {
				$id = sanitize_text_field( wp_unslash( $_POST[ $field['id'] ] ) );
				update_metadata( 'book', $post_id, $field['id'], $id );
			}
		}
	}
}
