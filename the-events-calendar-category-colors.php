<?php
/*
Plugin Name:       The Events Calendar Category Colors
Plugin URI:        https://github.com/afragen/the-events-calendar-category-colors
Description:       This plugin adds event category background coloring to <a href="http://wordpress.org/plugins/the-events-calendar/">The Events Calendar</a> plugin.
Version:           4.4.5
Text Domain:       the-events-calendar-category-colors
Author:            Andy Fragen, Barry Hughes
Author URI:        http://thefragens.com
License:           GNU General Public License v2
License URI:       http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
GitHub Plugin URI: https://github.com/afragen/the-events-calendar-category-colors
GitHub Branch:     master
Requires PHP:      5.3
Requires WP:       3.8
*/

/**
 * Exit if called directly.
 * PHP version check and exit.
 */
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( 'WPUpdatePhp' ) ) {
	require_once ( plugin_dir_path( __FILE__ ) . '/vendor/wp-update-php/src/WPUpdatePhp.php' );
}
$updatePhp = new WPUpdatePhp( '5.3.0' );
if ( method_exists( $updatePhp, 'set_plugin_name' ) ) {
	$updatePhp->set_plugin_name( 'The Events Calendar Category Colors' );
}
if ( ! $updatePhp->does_it_meet_required_php_version( PHP_VERSION ) ) {
	return false;
}

// We'll use PHP 5.3 syntax to get the plugin directory
define( 'TECCC_DIR', __DIR__ );
define( 'TECCC_FILE', __FILE__ );
define( 'TECCC_CLASSES', TECCC_DIR . '/src' );
define( 'TECCC_INCLUDES', TECCC_DIR . '/includes' );
define( 'TECCC_VIEWS', TECCC_DIR . '/views' );
define( 'TECCC_RESOURCES', plugin_dir_url( __FILE__ ) . 'resources' );
define( 'TECCC_LANG', basename( dirname( __FILE__ ) ) . '/languages' );

/**
 * Initialization of plugin.
 */
function teccc_init() {
	global $teccc;

	// Back compat classes
	$compatibility = array(
		'Tribe__Events__Main'            => TECCC_CLASSES . '/Back_Compat/Events.php',
		'Tribe__Settings_Tab'            => TECCC_CLASSES . '/Back_Compat/Settings_Tab.php',
		'Tribe__Events__Pro__Main'       => TECCC_CLASSES . '/Back_Compat/Events_Pro.php',
		'Tribe__Events__Filterbar__View' => TECCC_CLASSES . '/Back_Compat/FilterView.php',
	);

	// Plugin namespace root
	$root = array(
		'Fragen\Category_Colors'         => TECCC_CLASSES . '/Category_Colors',
	);

	// Autoloading
	require_once( TECCC_CLASSES . '/Category_Colors/Autoloader.php' );
	$loader = 'Fragen\\Category_Colors\\Autoloader';
	new $loader( $root, $compatibility );

	// Set-up Action and Filter Hooks
	register_activation_hook( __FILE__, array( 'Fragen\\Category_Colors\\Main', 'add_defaults' ) );

	// Launch
	$launch_method = array( 'Fragen\\Category_Colors\\Main', 'instance' );
	$teccc = call_user_func( $launch_method );
}

add_action( 'plugins_loaded', 'teccc_init', 15 );
