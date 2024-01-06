<?php
/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://github.com/Sukhendu2002/
 * @since      1.0.0
 *
 * @package    Wp_Book
 * @subpackage Wp_Book/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Wp_Book
 * @subpackage Wp_Book/includes
 * @author     Sukhendu Sekhar Guria <dev.sukhendu@gmail.com>
 */
class Wp_Book {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Wp_Book_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'WP_BOOK_VERSION' ) ) {
			$this->version = WP_BOOK_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'wp-book';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();
		$this->register_shortcodes();
		$this->register_post_type();
		$this->register_taxonomies();
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Wp_Book_Loader. Orchestrates the hooks of the plugin.
	 * - Wp_Book_i18n. Defines internationalization functionality.
	 * - Wp_Book_Admin. Defines all hooks for the admin area.
	 * - Wp_Book_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( __DIR__ ) . 'includes/class-wp-book-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( __DIR__ ) . 'includes/class-wp-book-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( __DIR__ ) . 'admin/class-wp-book-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( __DIR__ ) . 'public/class-wp-book-public.php';

		/**
		 * This class is responsible for registering custom post type.
		 */
		require_once plugin_dir_path( __DIR__ ) . 'includes/class-wp-book-custom-post-type.php';

		/**
		 * This class is responsible for registering custom taxonomies.
		 */
		require_once plugin_dir_path( __DIR__ ) . 'includes/class-wp-book-taxonomies.php';
		/**
		 * This class is responsible for handling database operations.
		 */
		require_once plugin_dir_path( __DIR__ ) . 'includes/class-wp-book-db.php';
		/**
		 * This class is responsible for handling database operations.
		 */
		require_once plugin_dir_path( __DIR__ ) . 'includes/class-wp-book-shortcode.php';

		$this->loader = new Wp_Book_Loader();
	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Wp_Book_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Wp_Book_i18n();
		$plugin_db   = '';
		if ( class_exists( 'Wp_Book_Db' ) ) {
			$plugin_db = new Wp_Book_Db();
		}
		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );
		$this->loader->add_action( 'plugins_loaded', $plugin_db, 'bookmeta_init' );
	}
	/**
	 * Define the custom post type for this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function register_post_type() {

		$plugin_post_type = new Wp_Book_Custom_Post_Type();
		$this->loader->add_action( 'init', $plugin_post_type, 'register_custom_post_type' );
	}

	/**
	 * Define the custom taxonomies for this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function register_taxonomies() {
		$plugin_taxonomies = new Wp_Book_Taxonomies();
		$this->loader->add_action( 'init', $plugin_taxonomies, 'register_taxonomies' );
	}

	/**
	 * Define the custom taxonomies for this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function register_shortcodes() {
		$plugin_shortcodes = new Wp_Book_Shortcode();
		$this->loader->add_action( 'init', $plugin_shortcodes, 'wp_book_shortcode_init' );
	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Wp_Book_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		$this->loader->add_action( 'add_meta_boxes', $plugin_admin, 'add_meta_box' );
		$this->loader->add_action( 'save_post', $plugin_admin, 'save_meta_data' );
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'add_settings_page' );
		$this->loader->add_action( 'admin_init', $plugin_admin, 'register_settings' );
		$this->loader->add_action( 'wp_dashboard_setup', $plugin_admin, 'add_dashboard_widget' );
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Wp_Book_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
		$this->loader->add_action( 'widgets_init', $plugin_public, 'register_widget' );
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Wp_Book_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}
}
