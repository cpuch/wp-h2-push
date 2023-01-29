<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://github.com/cpuch
 * @since      1.0.0
 *
 * @package    Wp_H2_Push
 * @subpackage Wp_H2_Push/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Wp_H2_Push
 * @subpackage Wp_H2_Push/includes
 * @author     Cedric Puchalver <cedric.puchalver@gmail.com>
 */
class Wp_H2_Push_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'wp-h2-push',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
