<?php
/**
 * The Events Calendar: Category Colors
 *
 * @author   Andy Fragen
 * @license  MIT
 * @link     https://github.com/afragen/the-events-calendar-category-colors
 * @package  the-events-calendar-category-colors
 */

namespace Fragen\Category_Colors;

/**
 * Class Bootstrap
 */
class Bootstrap {
	/**
	 * Start it up.
	 *
	 * @return void
	 */
	public function run() {
		// Autoloading.
		require_once TECCC_DIR . '/vendor/autoload.php';

		// Set-up Action and Filter Hooks.
		register_activation_hook( TECCC_FILE, [ 'Fragen\Category_Colors\Main', 'add_defaults' ] );

		add_action(
			'init',
			function () {
				load_plugin_textdomain( 'the-events-calendar-category-colors', false, TECCC_DIR . '/languages' );
			}
		);
		// Launch.
		Main::instance()->run();
	}
}
