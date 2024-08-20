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
 * Version:           7.3.2
 * Text Domain:       the-events-calendar-category-colors
 * Domain Path:       /languages
 * Author:            Andy Fragen, Barry Hughes
 * Author URI:        http://thefragens.com
 * License:           GNU General Public License v2
 * License URI:       http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * GitHub Plugin URI: https://github.com/the-events-calendar/the-events-calendar-category-colors
 * Requires PHP:      7.1
 * Requires at least: 5.2
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

// Autoloading.
require_once __DIR__ . '/vendor/autoload.php';

// Define constants.
define( 'TECCC_DIR', __DIR__ );
define( 'TECCC_FILE', __FILE__ );

add_action(
	'plugins_loaded',
	function () {
		if ( ! class_exists( 'Tribe__Events__Main' ) ) {
			return;
		}
		( new Bootstrap() )->run();
	},
	15
);
