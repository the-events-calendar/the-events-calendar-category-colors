<?php

namespace TECCC;

class TEC_ECP_Autoloader {

	public function __construct() {
		spl_autoload_register( array( $this, 'autoload' ) );
	}

	/**
	 * Autoloader
	 *
	 * @param $class
	 */
	protected function autoload( $class ) {
		$classes = array();

		foreach ( glob( dirname( __FILE__ ) . '/*.php' ) as $file ) {
			$class_name                           = str_replace( '.php', '', basename( $file ) );
			$classes[ strtolower( $class_name ) ] = $file;
		}

		// @note - remove when we no longer worry about ECP 3.9 or lower
		foreach ( glob( dirname( __FILE__ ) . '/310-classes/*.php' ) as $file ) {
			$class_name                           = str_replace( '.php', '', basename( $file ) );
			$classes[ strtolower( $class_name ) ] = $file;
		}

		$cn = strtolower( $class );

		if ( isset( $classes[ $cn ] ) ) {
			require_once( $classes[ $cn ] );
		}
	}
}

new TEC_ECP_Autoloader();
