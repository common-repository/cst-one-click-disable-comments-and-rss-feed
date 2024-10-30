<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://creativestorming.com
 * @since      1.0.0
 *
 * @package    Cst_Wp_Disablecomments
 * @subpackage Cst_Wp_Disablecomments/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Cst_Wp_Disablecomments
 * @subpackage Cst_Wp_Disablecomments/includes
 * @author     Creative Storming <support@creativestorming.com>
 */
class Cst_Wp_Disablecomments_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'cst-wp-disablecomments',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
