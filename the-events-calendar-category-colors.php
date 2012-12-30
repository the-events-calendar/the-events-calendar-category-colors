<?php
/*
 * Plugin Name: The Events Calendar Category Colors
 * Plugin URI: https://github.com/afragen/events-calendar-category-colors/
 * Description: This plugin adds event category background coloring to <a href="http://wordpress.org/extend/plugins/the-events-calendar/">The Events Calendar</a> plugin.
 * Version: 1.6.1
 * Text Domain: events-calendar-category-colors
 * Author: Andy Fragen, Barry Hughes
 * Author URI: http://thefragens.com/blog/
 * License: GNU General Public License v2
 * License URI: http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 *
 * The Events Calendar Category Colors
 *
 * This plugin adds background coloring to The Events Calendar plugin.
 *
 * @package      the-events-calendar-pro-alarm
 * @link         https://github.com/afragen/events-calendar-category-colors/
 * @link         http://wordpress.org/extend/plugins/the-events-calendar-category-colors/
 * @author       Andy Fragen <andy@thefragens.com>
 * @copyright    Copyright (c) 2012, Andrew Fragen
 *
 * The Events Calendar Category Colors is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License version 2, as published by the
 * Free Software Foundation.
 *
 * You may NOT assume that you can use any other version of the GPL.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details
 *
 * You should have received a copy of the GNU General Public License along with
 * this program; if not, write to:
 *
 *      Free Software Foundation, Inc.
 *      51 Franklin St, Fifth Floor
 *      Boston, MA  02110-1301  USA
 *
 * The license for this software can also likely be found here:
 * http://www.gnu.org/licenses/gpl-2.0.html*
 */


// We'll use PHP 5.2 syntax to get the plugin directory
define('TECCC_DIR', dirname(__FILE__));
define('TECCC_CLASSES', TECCC_DIR.'/classes');
define('TECCC_INCLUDES', TECCC_DIR.'/includes');
define('TECCC_VIEWS', TECCC_DIR.'/views');
define('TECCC_RESOURCES', plugin_dir_url(__FILE__).'resources');

// Load the base class
require_once TECCC_CLASSES.'/categorycolors.php';

// Set-up Action and Filter Hooks
register_activation_hook(__FILE__, array('TribeEventsCategoryColors', 'add_defaults'));
register_uninstall_hook(__FILE__, array('TribeEventsCategoryColors', 'delete_plugin_options'));

// Launch
TribeEventsCategoryColors::instance();