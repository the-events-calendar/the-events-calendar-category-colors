<?php
/*
Plugin Name: The Events Calendar Category Colors
Plugin URI: https://github.com/afragen/events-calendar-category-colors/
Description: This plugin adds event category background coloring to <a href="http://wordpress.org/extend/plugins/the-events-calendar/">The Events Calendar</a> plugin.
Version: 3.2.1
Text Domain: events-calendar-category-colors
Author: Andy Fragen, Barry Hughes
Author URI: http://thefragens.com/blog/
License: GNU General Public License v2
License URI: http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
*/


// We'll use PHP 5.2 syntax to get the plugin directory
define( 'TECCC_DIR', dirname(__FILE__) );
define( 'TECCC_CLASSES', TECCC_DIR . '/classes' );
define( 'TECCC_INCLUDES', TECCC_DIR . '/includes' );
define( 'TECCC_VIEWS', TECCC_DIR . '/views' );
define( 'TECCC_RESOURCES', plugin_dir_url(__FILE__) . 'resources' );
define( 'TECCC_LANG', basename(dirname(__FILE__)) . '/languages' );

// Load the base class
require_once TECCC_CLASSES.'/class-categorycolors.php';

// Set-up Action and Filter Hooks
register_activation_hook( __FILE__, array( 'Tribe_Events_Category_Colors', 'add_defaults' ) );
register_uninstall_hook( __FILE__, array( 'Tribe_Events_Category_Colors', 'delete_plugin_options' ) );

// Launch
Tribe_Events_Category_Colors::instance();