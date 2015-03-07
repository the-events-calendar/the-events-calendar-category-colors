<?php
/*
Plugin Name:       The Events Calendar Category Colors
Plugin URI:        https://github.com/afragen/the-events-calendar-category-colors
Description:       This plugin adds event category background coloring to <a href="http://wordpress.org/plugins/the-events-calendar/">The Events Calendar</a> plugin.
Version:           4.0.0
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


// We'll use PHP 5.3 syntax to get the plugin directory
define( 'TECCC_DIR', __DIR__ );
define( 'TECCC_FILE', __FILE__ );
define( 'TECCC_CLASSES', TECCC_DIR . '/src' );
define( 'TECCC_INCLUDES', TECCC_DIR . '/includes' );
define( 'TECCC_VIEWS', TECCC_DIR . '/views' );
define( 'TECCC_RESOURCES', plugin_dir_url( __FILE__ ) . 'resources' );
define( 'TECCC_LANG', basename( dirname( __FILE__ ) ) . '/languages' );

function teccc_load_failure() {
	global $pagenow;

	// Only show message on the plugin admin screen
	if ( 'plugins.php' !== $pagenow ) {
		return;
	}

	// @todo more work may be needed for proper l10n here
	$msg = __( 'The Events Calendar Category Colors could not run as it&#146;s minimum requirements were not met.', 'the-events-calendar-category-colors' );
	echo '<div class="error"> <p>' . $msg . '</p> </div>';
}

function teccc_init() {
	global $teccc;

	// Check for PHP 5.3 compatibility
	if ( version_compare( PHP_VERSION, '5.3', '<' ) ) {
		add_action( 'admin_notices', 'teccc_load_failure' );
		return;
	}

	// Back compat classes
	$compatibility = array(
		'Tribe__Events__Events' => TECCC_CLASSES . '/Back_Compat/Events.php',
		'Tribe__Events__Settings_Tab' => TECCC_CLASSES . '/Back_Compat/Settings_Tab.php',
		'Tribe__Events__Pro__Events_Pro' => TECCC_CLASSES . '/Back_Compat/Events_Pro.php',
	);

	// Plugin namespace root
	$root = array(
		'Fragen\Category_Colors' => TECCC_CLASSES . '/Category_Colors',
	);

	// Autoloading
	require_once( TECCC_CLASSES . '/Category_Colors/Autoloader.php' );
	$class_loader = 'Fragen\Category_Colors\Autoloader';
	new $class_loader( $root, $compatibility );

	// Set-up Action and Filter Hooks
	register_activation_hook( __FILE__, array( 'Fragen\Category_Colors\Main', 'add_defaults' ) );

	// Launch
	$launch_method = array( 'Fragen\Category_Colors\Main', 'instance' );
	$teccc = call_user_func( $launch_method );
}

add_action( 'plugins_loaded', 'teccc_init', 15 );
