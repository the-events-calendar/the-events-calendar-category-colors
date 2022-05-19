<?php
/**
 * The Events Calendar Category Colors
 *
 * @author   Andy Fragen
 * @license  MIT
 * @link     https://github.com/afragen/the-events-calendar-category-colors
 * @package  the-events-calendar-category-colors
 */

namespace Fragen\Category_Colors\CSS;

/**
 * Class Pro
 */
class Pro {

	/**
	 * Echo CSS
	 *
	 * @param array $css Array of CSS.
	 *
	 * @return string
	 */
	private static function echo_css( $css ) {
		if ( ! class_exists( 'Tribe__Events__Pro__Main' ) ) {
			return false;
		}
		$css[] = '';
		$css   = implode( "\n", $css );
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo $css;
	}

	/**
	 * Add map link CSS
	 *
	 * @param string $slug Slug.
	 *
	 * @return void
	 */
	public static function add_map_link_css( $slug ) {
		$css   = [];
		$css[] = ".tribe-events-category-{$slug} .tribe-events-map-event-title a:link,";
		$css[] = ".tribe-events-category-{$slug} .tribe-events-map-event-title a:visited,";
		self::echo_css( $css );
	}

	/**
	 * Add map background CSS
	 *
	 * @param string $slug Slug.
	 *
	 * @return void
	 */
	public static function add_map_background_css( $slug ) {
		$css   = [];
		$css[] = ".tribe-events-category-{$slug} .tribe-events-map-event-title a:link,";
		$css[] = ".tribe-events-category-{$slug} .tribe-events-map-event-title a:visited,";
		$css[] = "article.tribe-events-pro-map__event-card.tribe_events_cat-{$slug} h3,";
		$css[] = "article.tribe-events-pro-photo__event.tribe_events_cat-{$slug} h3,";
		self::echo_css( $css );
	}

	/**
	 * Add week background CSS
	 *
	 * @param string $slug Slug.
	 *
	 * @return void
	 */
	public static function add_week_background_css( $slug ) {
		$css   = [];
		$css[] = ".tribe-grid-body .tribe-events-week-hourly-single:hover.tribe-events-category-{$slug},";
		$css[] = ".tribe-grid-body .tribe-events-week-hourly-single.tribe-events-category-{$slug},";
		$css[] = ".tribe-grid-allday .tribe-events-week-allday-single.tribe-events-category-{$slug},";

		$css[] = "article.tribe-events-pro-week-grid__event.tribe_events_cat-{$slug} h3,";
		$css[] = "article.tribe-events-pro-week-mobile-events__event.tribe_events_cat-{$slug} h3,";
		$css[] = "article.tribe-events-pro-week-grid__multiday-event.tribe_events_cat-{$slug} h3,";
		$css[] = "article.tribe-events-pro-week-grid__multiday-event.tribe_events_cat-{$slug} .tribe-events-pro-week-grid__multiday-event-bar-inner h3,";
		$css[] = "article.tribe-events-pro-week-grid__multiday-event.tribe_events_cat-{$slug} .tribe-events-pro-week-grid__multiday-event-bar-inner,";
		self::echo_css( $css );
	}

	/**
	 * Fix default week background
	 *
	 * @return void
	 */
	public static function fix_default_week_background() {
		$css   = [];
		$css[] = '.tribe-grid-body div[id*="tribe-events-event-"][class*="tribe-events-category-"].tribe-events-week-hourly-single';
		$css[] = '{ border-right: 1px solid #000; }';
		self::echo_css( $css );
	}

	/**
	 * Fix transparent week background
	 *
	 * @param string $slug Slug.
	 *
	 * @return void
	 */
	public static function fix_transparent_week_background( $slug ) {
		$options = get_option( 'teccc_options' );
		$css     = [];
		$css[]   = ".tribe-grid-body .tribe-events-week-hourly-single.tribe-events-category-{$slug},";
		$css[]   = ".tribe-grid-body .tribe-events-week-hourly-single.tribe-events-category-{$slug}:hover";
		$css[]   = '{ background-color: #fff; }';

		if ( 'transparent' === $options[ $slug . '-background' ] ) {
			self::echo_css( $css );
		}
	}

	/**
	 * Add v2 multiday week background color.
	 *
	 * Override view-skeleton.css.
	 *
	 * @return void
	 */
	public static function fix_multiday_week_background_color() {
		$css   = [];
		$css[] = '.tribe-events-pro .tribe-events-pro-week-grid__multiday-event-bar,';
		// $css[] = '.tribe-events-pro .tribe-events-pro-week-grid__multiday-event-bar-inner,';
		$css[] = '.tribe-events-pro .tribe-events-pro-week-grid__multiday-event-wrapper';
		$css[] = '{ background-color: #F7F6F6 !important; }';
		self::echo_css( $css );
	}

	/**
	 * Fix double left border on all day week view event.
	 *
	 * @param string $slug
	 *
	 * @return void
	 */
	public static function fix_multiday_week_border_color( $slug ) {
		$css   = [];
		$css[] = "article.tribe-events-pro-week-grid__multiday-event.tribe_events_cat-{$slug} h3";
		$css[] = '{ border-left: 0px solid transparent !important; }';
		self::echo_css( $css );
	}

	/**
	 * Add week link CSS
	 *
	 * @param string $slug Slug.
	 *
	 * @return void
	 */
	public static function add_week_link_css( $slug ) {
		$css   = [];
		$css[] = "#tribe-events-content div.tribe-events-category-{$slug}.hentry.vevent h3.entry-title a,";
		$css[] = ".tribe-grid-body .tribe-events-category-{$slug} a,";
		$css[] = ".tribe-grid-body .type-tribe_events.tribe-events-category-{$slug} a,";
		$css[] = ".tribe-grid-allday .tribe-events-category-{$slug} a,";
		self::echo_css( $css );
	}

	/**
	 * Add summary background CSS
	 *
	 * @param string $slug Slug.
	 *
	 * @return void
	 */
	public static function add_summary_background_css( $slug ) {
		$css   = [];
		$css[] = ".tribe-common article.tribe_events_cat-{$slug} h3.tribe-events-pro-summary__event-title,";
		self::echo_css( $css );
	}
}
