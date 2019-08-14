<?php
/**
 * Plugin Name:       The Events Calendar Category Colors
 * Plugin URI:        https://github.com/afragen/the-events-calendar-category-colors
 * Description:       This plugin adds event category background coloring to <a href="http://wordpress.org/plugins/the-events-calendar/">The Events Calendar</a> plugin.
 * Version:           6.1.2.2
 * Text Domain:       the-events-calendar-category-colors
 * Domain Path:       /languages
 * Author:            Andy Fragen, Barry Hughes
 * Author URI:        http://thefragens.com
 * License:           GNU General Public License v2
 * License URI:       http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * GitHub Plugin URI: https://github.com/afragen/the-events-calendar-category-colors
 * Requires PHP:      5.4
 * Requires WP:       4.6
 */

/*
 * Exit if called directly.
 * PHP version check and exit.
 */
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( version_compare( '5.4.0', PHP_VERSION, '>=' ) ) {
	echo '<div class="error notice is-dismissible"><p>';
	printf(
		/* translators: 1: minimum PHP version required, 2: Upgrade PHP URL */
		wp_kses_post( __( 'The Events Calendar Category Colors cannot run on PHP versions older than %1$s. <a href="%2$s">Learn about updating your PHP.</a>', 'the-events-calendar-category-colors' ) ),
		'5.4.0',
		esc_url( __( 'https://wordpress.org/support/update-php/' ) )
	);
	echo '</p></div>';

	return false;
}

// We'll use PHP 5.3 syntax to get the plugin directory.
define( 'TECCC_DIR', __DIR__ );
define( 'TECCC_FILE', __FILE__ );
define( 'TECCC_CLASSES', TECCC_DIR . '/src' );
define( 'TECCC_INCLUDES', TECCC_DIR . '/includes' );
define( 'TECCC_VIEWS', TECCC_DIR . '/views' );
define( 'TECCC_RESOURCES', plugin_dir_url( TECCC_FILE ) . 'resources' );
define( 'TECCC_LANG', basename( TECCC_DIR ) . '/languages' );

require_once TECCC_CLASSES . '/Category_Colors/Bootstrap.php';
