<?php
/**
 * The Events Calendar: Category Colors
 *
 * @author   Andy Fragen
 * @license  GPL v2
 * @link     https://github.com/the-events-calendar/the-events-calendar-category-colors
 * @package  the-events-calendar-category-colors
 */

/**
 * Plugin Name:       The Events Calendar: Category Colors
 * Plugin URI:        https://github.com/the-events-calendar/the-events-calendar-category-colors
 * Description:       This plugin adds event category background coloring to <a href="http://wordpress.org/plugins/the-events-calendar/">The Events Calendar</a> plugin.
 * Version:           7.4.2
 * Text Domain:       the-events-calendar-category-colors
 * Domain Path:       /languages
 * Author:            Andy Fragen, Barry Hughes
 * Author URI:        http://thefragens.com
 * License:           GNU General Public License v2
 * License URI:       http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * GitHub Plugin URI: https://github.com/the-events-calendar/the-events-calendar-category-colors
 * Requires at least: 6.3
 * Requires PHP:      7.4
 * Requires Plugins:  the-events-calendar
 */

namespace Fragen\Category_Colors;

/*
 * Exit if called directly.
 * PHP version check and exit.
 */
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Define constants.
define( 'TECCC_DIR', __DIR__ );
define( 'TECCC_FILE', __FILE__ );

add_action(
	'plugins_loaded',
	function () {
		// Check if The Events Calendar is loaded
		if ( ! class_exists( 'Tribe__Events__Main' ) ) {
			return;
		}

		// Check TEC version - Category Colors is built into TEC 6.14.0+
		// So this plugin should only run for TEC versions 5.0 to 6.13.x
		// Use global namespace for TEC class
		if ( defined( '\Tribe__Events__Main::VERSION' ) ) {
			$tec_version = \Tribe__Events__Main::VERSION;

			// Don't load if TEC is too old (< 5.0)
			if ( version_compare( $tec_version, '5.0', '<' ) ) {
				return;
			}

			// Don't load if TEC 6.14.0+ (has built-in category colors)
			if ( version_compare( $tec_version, '6.14.0', '>=' ) ) {
				add_action( 'admin_notices', function() {
					echo '<div class="notice notice-info is-dismissible"><p>';
					echo esc_html__( 'The Events Calendar: Category Colors plugin is not needed with The Events Calendar 6.14.0 or higher, as this functionality is now built-in.', 'the-events-calendar-category-colors' );
					echo '</p></div>';
				} );
				return;
			}
		}

		// Autoloading - only after version checks pass
		require_once __DIR__ . '/vendor/autoload.php';

		( new Bootstrap() )->run();
	},
	15
);
