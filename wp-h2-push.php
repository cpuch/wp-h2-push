<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://github.com/cpuch
 * @since             1.0.0
 * @package           Wp_H2_Push
 *
 * @wordpress-plugin
 * Plugin Name:       WP HTTP2 Push
 * Plugin URI:        https://github.com/cpuch/wp-h2-push
 * Description:       A simple plugin that enables HTTP/2 Server Push with multiple assets per Link header.
 * Version:           1.0.0
 * Author:            Cedric Puchalver
 * Author URI:        https://github.com/cpuch
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wp-h2-push
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'WP_H2_PUSH_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wp-h2-push-activator.php
 */
function activate_wp_h2_push() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-h2-push-activator.php';
	Wp_H2_Push_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wp-h2-push-deactivator.php
 */
function deactivate_wp_h2_push() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-h2-push-deactivator.php';
	Wp_H2_Push_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wp_h2_push' );
register_deactivation_hook( __FILE__, 'deactivate_wp_h2_push' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wp-h2-push.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wp_h2_push() {

	$plugin = new Wp_H2_Push();
	$plugin->run();

}
run_wp_h2_push();
