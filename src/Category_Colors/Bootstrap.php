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
		//global $teccc;

		// Back compat classes
		$compatibility = array(
			'Tribe__Events__Main'      => TECCC_CLASSES . '/Back_Compat/Events.php',
			'Tribe__Settings_Tab'      => TECCC_CLASSES . '/Back_Compat/Settings_Tab.php',
			'Tribe__Events__Pro__Main' => TECCC_CLASSES . '/Back_Compat/Events_Pro.php',
		);

		// Plugin namespace root
		$root = array(
			'Fragen\Category_Colors' => TECCC_CLASSES . '/Category_Colors',
		);

		// Autoloading
		require_once TECCC_DIR . '/src/Autoloader.php';
		new \Fragen\Autoloader( $root, $compatibility );

		// Load translation files. This is loaded in 'plugins_loaded'.
		load_plugin_textdomain( 'the-events-calendar-category-colors', false, TECCC_LANG );

		// Set-up Action and Filter Hooks
		register_activation_hook( TECCC_FILE, array( 'Fragen\Category_Colors\Main', 'add_defaults' ) );

		// Launch
		Main::instance();
	}

}
