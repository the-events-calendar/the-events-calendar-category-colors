<?php

// namespace must be unique to your plugin
namespace TECCC;

/**
 * Class Autoloader - generic autoload class
 *
 * Class aliases are in /classes/310-class-aliases for user still on TEC/ECP 3.9 or lower
 * To use with different plugins be sure to create a new namespace.
 *
 * @package   Autoloader
 * @author    Andy Fragen <andy@thefragens.com>
 * @license   GPL-2.0+
 * @link      http://github.com/afragen/autoloader
 * @copyright 2015 Andy Fragen
 *
 * @package TECCC
 */

class Autoloader {

	/**
	 * Constructor
	 */
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

		// 2 directories deep, add more as needed
		$directories = array( '', '*/', '*/*/' );

		foreach ( $directories as $directory ) {
			foreach ( glob( trailingslashit( __DIR__ ) . $directory . '*.php' ) as $file ) {
				$class_name                           = str_replace( '.php', '', basename( $file ) );
				$classes[ strtolower( $class_name ) ] = $file;
			}
		}

		$cn = strtolower( $class );

		if ( isset( $classes[ $cn ] ) ) {
			require_once( $classes[ $cn ] );
		}
	}
}

new Autoloader();
