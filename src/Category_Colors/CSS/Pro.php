<?php
namespace Fragen\Category_Colors\CSS;

class Pro {
	private static function echo_css( $css ) {
		if ( ! class_exists( 'Tribe__Events__Pro__Main' ) ) {
			return false;
		}
		$css[] = '';
		$css   = implode( "\n", $css );
		echo $css;
	}

	public static function add_map_link_css( $slug ) {
		$css   = array();
		$css[] = ".tribe-events-category-{$slug} .tribe-events-map-event-title a:link,";
		$css[] = ".tribe-events-category-{$slug} .tribe-events-map-event-title a:visited,";
		self::echo_css( $css );
	}

	public static function add_map_background_css( $slug ) {
		$css   = array();
		$css[] = ".tribe-events-category-{$slug} .tribe-events-map-event-title a:link,";
		$css[] = ".tribe-events-category-{$slug} .tribe-events-map-event-title a:visited,";
		self::echo_css( $css );
	}

	public static function add_week_background_css( $slug ) {
		$css   = array();
		$css[] = "#tribe-events-content div.tribe-events-category-{$slug}.hentry.vevent .tribe-events-tooltip h4.entry-title,";
		$css[] = ".tribe-grid-body .tribe-events-week-hourly-single:hover.tribe-events-category-{$slug},";
		$css[] = ".tribe-grid-body .tribe-events-week-hourly-single.tribe-events-category-{$slug},";
		$css[] = ".tribe-grid-allday .tribe-events-week-allday-single.tribe-events-category-{$slug},";
		self::echo_css( $css );
	}

	public static function fix_default_week_background() {
		$css   = array();
		$css[] = '.tribe-grid-body div[id*="tribe-events-event-"][class*="tribe-events-category-"].tribe-events-week-hourly-single';
		$css[] = '{ border-right: 1px solid #000; }';
		self::echo_css( $css );
	}

	public static function fix_transparent_week_background( $slug ) {
		$options = get_option( 'teccc_options' );
		$css     = array();
		$css[]   = ".tribe-grid-body .tribe-events-week-hourly-single.tribe-events-category-{$slug},";
		$css[]   = ".tribe-grid-body .tribe-events-week-hourly-single.tribe-events-category-{$slug}:hover";
		$css[]   = '{ background-color: #fff; }';

		if ( 'transparent' === $options[ $slug . '-background' ] ) {
			self::echo_css( $css );
		}
	}

	public static function add_week_link_css( $slug ) {
		$css   = array();
		$css[] = "#tribe-events-content div.tribe-events-category-{$slug}.hentry.vevent h3.entry-title a,";
		$css[] = "#tribe-events-content div.tribe-events-category-{$slug}.hentry.vevent .tribe-events-tooltip h4.entry-title.summary,";
		$css[] = ".tribe-grid-body .tribe-events-category-{$slug} a,";
		$css[] = ".tribe-grid-body .type-tribe_events.tribe-events-category-{$slug} a,";
		$css[] = ".tribe-grid-allday .tribe-events-category-{$slug} a,";
		self::echo_css( $css );
	}

	public static function add_deprecated_week_background_css( $slug ) {
		$css = array();
		self::echo_css( $css );
	}
}
