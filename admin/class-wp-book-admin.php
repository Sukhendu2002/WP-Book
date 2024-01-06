<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://github.com/Sukhendu2002/
 * @since      1.0.0
 *
 * @package    Wp_Book
 * @subpackage Wp_Book/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wp_Book
 * @subpackage Wp_Book/admin
 * @author     Sukhendu Sekhar Guria <dev.sukhendu@gmail.com>
 */
class Wp_Book_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Instance of the class that handles the custom meta box.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      Wp_Book_Admin_Metabox    $plugin_admin_metabox    Instance of the class that handles the custom meta box.
	 */
	private $plugin_admin_metabox;

	/**
	 * Instance of the class that handles the settings page.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      Wp_Book_Admin_Settings    $plugin_admin_settings    Instance of the class that handles the settings page.
	 */
	private $plugin_admin_settings;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string $plugin_name       The name of this plugin.
	 * @param      string $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;
		$this->load_dependencies();
		if ( class_exists( 'Wp_Book_Admin_Metabox' ) ) {
			$this->plugin_admin_metabox = new Wp_Book_Admin_Metabox();
		}
		if ( class_exists( 'Wp_Book_Admin_Settings' ) ) {
			$this->plugin_admin_settings = new Wp_Book_Admin_Settings();
		}
	}

	/**
	 * Load the required dependencies for this plugin.
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for registering the custom meta box.
		 */
		require_once plugin_dir_path( __DIR__ ) . 'admin/class-wp-book-admin-metabox.php';
		/**
		 * The class responsible for registering the settings page.
		 */
		require_once plugin_dir_path( __DIR__ ) . 'admin/class-wp-book-admin-settings.php';
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wp_Book_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_Book_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wp-book-admin.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wp_Book_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_Book_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wp-book-admin.js', array( 'jquery' ), $this->version, false );
	}

	/**
	 * Add the custom meta box.
	 *
	 * @since 1.0.0
	 */
	public function add_meta_box() {

		$this->plugin_admin_metabox->add_meta_box();
	}

	/**
	 * Save the custom meta box data.
	 *
	 * @since 1.0.0
	 * @param int $post_id Post ID.
	 */
	public function save_meta_data( $post_id ) {

		$this->plugin_admin_metabox->save_meta_data( $post_id );
	}

	/**
	 * Register the settings page.
	 *
	 * @since 1.0.0
	 */
	public function add_settings_page() {

		$this->plugin_admin_settings->add_settings_page();
	}

	/**
	 * Register the settings.
	 *
	 * @since 1.0.0
	 */
	public function register_settings() {

		$this->plugin_admin_settings->register_settings();
	}
}
