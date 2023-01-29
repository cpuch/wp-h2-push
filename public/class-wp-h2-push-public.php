<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://github.com/cpuch
 * @since      1.0.0
 *
 * @package    Wp_H2_Push
 * @subpackage Wp_H2_Push/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Wp_H2_Push
 * @subpackage Wp_H2_Push/public
 * @author     Cedric Puchalver <cedric.puchalver@gmail.com>
 */
class Wp_H2_Push_Public {

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
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * 
	 */
	public function http2_push_scripts_styles() {

		// Bail out early if HTTP 1.x*.
		$protocol = wp_get_server_protocol();

		if ( preg_match( "/\bHTTP\/1.[01]\b/", $protocol ) ) {
			return;
		}

		global $wp_version, $wp_scripts, $wp_styles;

		// Assets to push.
		$links = [];

		// Get all loaded scripts.
		foreach ( $wp_scripts->queue as $script ) {

			if ( ! empty( $wp_scripts->registered[$script]->src ) ) {

				// Set script path.
				$src = str_replace( site_url(), '', $wp_scripts->registered[$script]->src );

				// Set script version.
				$ver = ( $wp_scripts->registered[$script]->ver ) ? $wp_scripts->registered[$script]->ver : $wp_version;

				// Add script link to pushed assets.
				$links[] = "<" . site_url( add_query_arg( 'ver', $ver, $src ) ) . ">; rel=preload; as=script";
			}

		}

		// Get all loaded styles.
		foreach ( $wp_styles->queue as $style ) {

			if ( ! empty( $wp_styles->registered[$style]->src ) ) {

				// Set style path.
				$src = str_replace( site_url(), '', $wp_styles->registered[$style]->src );

				// Set style version.
				$ver = ( $wp_styles->registered[$style]->ver ) ? $wp_styles->registered[$style]->ver : $wp_version;

				// Add style link to pushed assets.
				$links[] = "<" . site_url ( add_query_arg( 'ver', $ver, $src ) ) . ">; rel=preload; as=style";
			}

		}

		// Send HTTP header.
		header( "Link: " . implode( ", ", $links ), false );

	}

}
