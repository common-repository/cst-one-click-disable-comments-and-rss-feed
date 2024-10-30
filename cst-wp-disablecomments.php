<?php

/**
 * The plugin bootstrap file
 *
    This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://creativestorming.com
 * @since             1.0.0
 * @package           Cst_Wp_Disablecomments
 *
 * @wordpress-plugin
 * Plugin Name:       CST One Click Disable Comments and RSS Feed
 * Plugin URI:        https://creativestorming.com/en/wordpress-plugins-product/cst-wp-one-click-disable-comments-and-disable-rss-feed/
 * Description:       Disable all comments system and all RSS Feed in one click
 * Version:           1.1.1
 * Author:            Creative Storming
 * Author URI:        https://creativestorming.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       cst-wp-disablecomments
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-cst-wp-disablecomments-activator.php
 */
function activate_cst_wp_disablecomments() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-cst-wp-disablecomments-activator.php';
	Cst_Wp_Disablecomments_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-cst-wp-disablecomments-deactivator.php
 */
function deactivate_cst_wp_disablecomments() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-cst-wp-disablecomments-deactivator.php';
	Cst_Wp_Disablecomments_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_cst_wp_disablecomments' );
register_deactivation_hook( __FILE__, 'deactivate_cst_wp_disablecomments' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-cst-wp-disablecomments.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function cst_wp_disablecomments_run_plugin_name() {

	$plugin = new Cst_Wp_Disablecomments();
	$plugin->run();

}
cst_wp_disablecomments_run_plugin_name();
