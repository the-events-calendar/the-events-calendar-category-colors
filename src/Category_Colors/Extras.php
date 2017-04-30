<?php

namespace Fragen\Category_Colors;

class Extras extends Frontend {

	public static function add_map_link_css( $slug ) {
		if ( ! class_exists( 'Tribe__Events__Pro__Main' ) ) {
			return false;
		}
		$css   = array();
		$css[] = '.tribe-events-category-' . $slug . ' .tribe-events-map-event-title a:link,';
		$css[] = '.tribe-events-category-' . $slug . ' .tribe-events-map-event-title a:visited,';
		$css[] = '';
		$css   = implode( "\n", $css );
		echo $css;
	}

	public static function add_map_background_css( $slug ) {
		if ( ! class_exists( 'Tribe__Events__Pro__Main' ) ) {
			return false;
		}
		$css   = array();
		$css[] = '.tribe-events-category-' . $slug . ' .tribe-events-map-event-title a:link,';
		$css[] = '.tribe-events-category-' . $slug . ' .tribe-events-map-event-title a:visited,';
		$css[] = '';
		$css   = implode( "\n", $css );
		echo $css;
	}

	public static function add_map_display_css( $slug ) {
		if ( ! class_exists( 'Tribe__Events__Pro__Main' ) ) {
			return false;
		}
		$css   = array();
		$css[] = '.tribe-events-category-' . $slug . ' .tribe-events-map-event-title a:link,';
		$css[] = '';
		$css   = implode( "\n", $css );
		echo $css;
	}

	public static function add_week_background_css( $slug ) {
		if ( ! class_exists( 'Tribe__Events__Pro__Main' ) ) {
			return false;
		}
		$css = array();
		//$css[] = '#tribe-events-content div.tribe-events-category-' . $slug . ' h3.entry-title.summary,';
		$css[] = '#tribe-events-content div.tribe-events-category-' . $slug . '.hentry.vevent .tribe-events-tooltip h4.entry-title,';
		$css[] = '.tribe-grid-body .tribe-events-week-hourly-single:hover.tribe-events-category-' . $slug . ',';
		$css[] = '.tribe-grid-body .tribe-events-week-hourly-single.tribe-events-category-' . $slug . ','; //3.10
		$css[] = '.tribe-grid-allday .tribe-events-week-allday-single.tribe-events-category-' . $slug . ','; //3.10
		$css[] = '';
		$css   = implode( "\n", $css );
		echo $css;
	}

	public static function fix_default_week_background() {
		if ( ! class_exists( 'Tribe__Events__Pro__Main' ) ) {
			return false;
		}
		$css   = array();
		$css[] = '.tribe-grid-body div[id*="tribe-events-event-"][class*="tribe-events-category-"].tribe-events-week-hourly-single';
		$css[] = '{ border-right: 1px solid #000; }';
		$css[] = '';
		$css   = implode( "\n", $css );
		echo $css;
	}

	public static function fix_transparent_week_background( $slug ) {
		if ( ! class_exists( 'Tribe__Events__Pro__Main' ) ) {
			return false;
		}
		$options = get_option( 'teccc_options' );
		$css     = array();
		$css[]   = '.tribe-grid-body .tribe-events-week-hourly-single.tribe-events-category-' . $slug . ',';
		$css[]   = '.tribe-grid-body .tribe-events-week-hourly-single.tribe-events-category-' . $slug . ':hover';
		$css[]   = '{ background-color: #fff; }';
		$css[]   = '';
		$css     = implode( "\n", $css );

		if ( 'transparent' === $options[ $slug . '-background' ] ) {
			echo $css;
		}
	}

	public static function add_week_link_css( $slug ) {
		if ( ! class_exists( 'Tribe__Events__Pro__Main' ) ) {
			return false;
		}
		$css   = array();
		$css[] = '#tribe-events-content div.tribe-events-category-' . $slug . '.hentry.vevent h3.entry-title a,';
		$css[] = '#tribe-events-content div.tribe-events-category-' . $slug . '.hentry.vevent .tribe-events-tooltip h4.entry-title.summary,';
		$css[] = '.tribe-grid-body .tribe-events-category-' . $slug . ' a,';
		$css[] = '.tribe-grid-body .type-tribe_events.tribe-events-category-' . $slug . ' a,';
		$css[] = '.tribe-grid-allday .tribe-events-category-' . $slug . ' a,';
		$css[] = '';
		$css   = implode( "\n", $css );
		echo $css;
	}

	public static function add_mobile_css() {
		$teccc = Main::instance();

		$css = $teccc->view( 'mobile.css', array(
			'breakpoint' => tribe_get_mobile_breakpoint(),
		), false );


		/**
		 * Add CSS to mobile.css.php file for inclusion in category.css.php.
		 *
		 * @since 4.4.6
		 * @return string $css Default string returned is mobile.css.php.
		 */
		echo apply_filters( 'teccc_mobile_css', $css );
	}

	public static function fix_category_link_css( $slug ) {
		/**
		 * Filter to add CSS selector that is overriding link color.
		 *
		 * @since 4.5.0
		 *
		 * @param string .tribe-events-category-{$slug}
		 *
		 * @return string string is returned not echoed.
		 *                default return string is empty.
		 */
		echo apply_filters( 'teccc_fix_category_link_color', null, '.tribe-events-category-' . $slug );
	}

	public static function fix_category_background_css( $slug ) {
		/**
		 * Filter to add CSS selector that is overriding background color.
		 *
		 * @since 4.6.0
		 *
		 * @param string .tribe-events-category-{$slug}
		 *
		 * @return string string is returned not echoed.
		 *                default return string is empty.
		 */
		echo apply_filters( 'teccc_fix_category_background_color', null, '.tribe-events-category-' . $slug );
	}

}
