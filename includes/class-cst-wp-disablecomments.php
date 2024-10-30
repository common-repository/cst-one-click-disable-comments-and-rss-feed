<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://creativestorming.com
 * @since      1.0.0
 *
 * @package    Cst_Wp_Disablecomments
 * @subpackage Cst_Wp_Disablecomments/includes
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
 * @package    Cst_Wp_Disablecomments
 * @subpackage Cst_Wp_Disablecomments/includes
 * @author     Creative Storming <support@creativestorming.com>
 */
class Cst_Wp_Disablecomments {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Cst_Wp_Disablecomments_Loader    $loader    Maintains and registers all hooks for the plugin.
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

		$this->plugin_name = 'cst-wp-disablecomments';
		$this->version = '1.0.0';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Cst_Wp_Disablecomments_Loader. Orchestrates the hooks of the plugin.
	 * - Cst_Wp_Disablecomments_i18n. Defines internationalization functionality.
	 * - Cst_Wp_Disablecomments_Admin. Defines all hooks for the admin area.
	 * - Cst_Wp_Disablecomments_Public. Defines all hooks for the public side of the site.
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
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-cst-wp-disablecomments-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-cst-wp-disablecomments-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-cst-wp-disablecomments-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-cst-wp-disablecomments-public.php';

		$this->loader = new Cst_Wp_Disablecomments_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Cst_Wp_Disablecomments_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Cst_Wp_Disablecomments_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Cst_Wp_Disablecomments_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

        $this->loader->add_action( 'admin_menu', $plugin_admin, 'add_options_page' );
        $this->loader->add_action( 'admin_menu', $plugin_admin, 'cst_wp_disablecomments_admin_menu' );
        $this->loader->add_action( 'admin_init', $plugin_admin, 'register_setting' );
        $this->loader->add_action( 'admin_init', $plugin_admin, 'cst_wp_disablecomments_post_types_support' );
        $this->loader->add_action( 'admin_init', $plugin_admin, 'cst_wp_disablecomments_admin_menu_redirect' );
        $this->loader->add_action( 'admin_init', $plugin_admin, 'cst_wp_disablecomments_dashboard' );
        $this->loader->add_action( 'wp_before_admin_bar_render', $plugin_admin, 'cst_wp_disablecomments_admin_bar' );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Cst_Wp_Disablecomments_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

        $this->loader->add_action( 'init', $plugin_public, 'cst_wp_disablecomments_hide_default_rss_links_comments' );
        $this->loader->add_action( 'widgets_init', $plugin_public, 'cst_wp_disablecomments_hide_default_widget_comments', 11, 2 );
        $this->loader->add_action( 'do_feed_rss', $plugin_public, 'cst_wp_disablecomments_hide_default_rss_comments', 1, 2 );
        $this->loader->add_action( 'do_feed_rdf', $plugin_public, 'cst_wp_disablecomments_hide_default_rss_comments', 1, 2 );
        $this->loader->add_action( 'do_feed_rss2', $plugin_public, 'cst_wp_disablecomments_hide_default_rss_comments', 1, 2 );
        $this->loader->add_action( 'do_feed_atom', $plugin_public, 'cst_wp_disablecomments_hide_default_rss_comments', 1, 2 );
        $this->loader->add_action( 'do_feed', $plugin_public, 'cst_wp_disablecomments_hide_default_rss_comments', 1, 2 );
        $this->loader->add_action( 'do_feed_rss2_comments', $plugin_public, 'cst_wp_disablecomments_hide_default_rss_comments', 1, 2 );
        $this->loader->add_action( 'do_feed_atom_comments', $plugin_public, 'cst_wp_disablecomments_hide_default_rss_comments', 1, 2 );
        $this->loader->add_filter( 'comments_open', $plugin_public, 'cst_wp_disablecomments_status', 20, 2 );
		$this->loader->add_filter( 'pings_open', $plugin_public, 'cst_wp_disablecomments_status', 20, 2 );

		$this->loader->add_filter( 'comments_array', $plugin_public, 'cst_wp_disablecomments_hide_existing_comments', 10, 2 );

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
	 * @return    Cst_Wp_Disablecomments_Loader    Orchestrates the hooks of the plugin.
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
