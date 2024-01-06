<?php
/**
 * Handle the database operations
 *
 * @package WP_Book
 * @subpackage WP_Book/includes
 * @since 1.0.0
 */

/**
 * Class to handle the database operations
 *
 * @since      1.0.0
 * @package    Wp_Book
 * @subpackage Wp_Book/includes
 * @author     Sukhendu Sekhar Guria <dev.sukhendu@gmail.com>
 */
class Wp_Book_Db {
	/**
	 * Create the table for storing the book meta
	 *
	 * @since    1.0.0
	 */
	public function create_bookmeta_table() {

		global $wpdb;
		$charset_collate = $wpdb->get_charset_collate();
		$table_name      = $wpdb->prefix . 'bookmeta';

		$sql = "CREATE TABLE $table_name (
            meta_id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
            book_id bigint(20) UNSIGNED NOT NULL,
            meta_key varchar(255) DEFAULT NULL,
            meta_value longtext,
            PRIMARY KEY  (meta_id),
            KEY book_id (book_id),
            KEY meta_key (meta_key(191))
        ) $charset_collate;";

		require_once ABSPATH . 'wp-admin/includes/upgrade.php';
		dbDelta( $sql );
	}

	/**
	 * Drop the table for storing the book meta
	 *
	 * @since    1.0.0
	 */
	public function drop_bookmeta_table() {
		global $wpdb;
		$table_name = $wpdb->prefix . 'bookmeta';
		$sql        = "DROP TABLE IF EXISTS $table_name";
		$wpdb->query( $sql );
	}
}
