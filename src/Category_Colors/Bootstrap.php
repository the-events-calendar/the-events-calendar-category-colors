<?php

namespace Fragen\Category_Colors;

add_action(
	'plugins_loaded',
	function() {
		if ( ! class_exists( 'Tribe__Events__Main' ) ) {
			return;
		}
		( new Bootstrap() )->run();
	},
	15
);

add_action(
	'init',
	function() {
		load_plugin_textdomain( 'the-events-calendar-category-colors', false, TECCC_LANG );

	}
);

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
		// Autoloading
		require_once TECCC_DIR . '/vendor/autoload.php';

		// Set-up Action and Filter Hooks
		register_activation_hook( TECCC_FILE, array( 'Fragen\Category_Colors\Main', 'add_defaults' ) );

		// Launch
		Main::instance();
	}

}
