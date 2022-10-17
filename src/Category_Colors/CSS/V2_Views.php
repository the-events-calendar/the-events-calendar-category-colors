<?php
/**
 * The Events Calendar: Category Colors
 *
 * @author   Andy Fragen
 * @license  MIT
 * @link     https://github.com/afragen/the-events-calendar-category-colors
 * @package  the-events-calendar-category-colors
 */

namespace Fragen\Category_Colors\CSS;

/**
 * Class V2_Views
 */
class V2_Views {

	/**
	 * Echo CSS
	 *
	 * @param array  $css Array of CSS.
	 * @param string $comma Add a comma or not.
	 *
	 * @return void
	 */
	private static function echo_css( $css, $comma = '' ) {
		$css[] = '';
		$css   = implode( "\n", $css );
		$css   = empty( $comma ) ? $css : rtrim( $css ) . $comma;
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo $css;
	}

	/**
	 * Add link CSS
	 *
	 * @param string $slug Slug.
	 * @param string $comma Add a comma or not.
	 *
	 * @return void
	 */
	public static function add_link_css( $slug, $comma ) {
		$css = [];

		$css[] = ".teccc-legend li.tribe_events_cat-{$slug} a,";
		$css[] = ".tribe-common article.tribe_events_cat-{$slug} h3 a,";
		$css[] = ".tribe-common article.tribe_events_cat-{$slug} h3 a:link,";
		$css[] = ".tribe-common article.tribe_events_cat-{$slug} h3 a:visited,";
		$css[] = "article.tribe-events-calendar-month__multiday-event.tribe_events_cat-{$slug} h3";
		self::echo_css( $css, $comma );
	}

	/**
	 * Add background CSS
	 *
	 * @param string $slug Slug.
	 * @param string $comma Add a comma or not.
	 *
	 * @return void
	 */
	public static function add_background_css( $slug, $comma ) {
		$css   = [];
		$css[] = ".teccc-legend li.tribe_events_cat-{$slug},";
		$css[] = "article.tribe_events_cat-{$slug} header.tribe-events-widget-events-list__event-header h3,";
		$css[] = "article.tribe-events-calendar-month__calendar-event.tribe_events_cat-{$slug} h3,";
		$css[] = "article.tribe-events-calendar-month__multiday-event.tribe_events_cat-{$slug} .tribe-events-calendar-month__multiday-event-bar-inner,";
		$css[] = "article.tribe-events-calendar-month-mobile-events__mobile-event.tribe_events_cat-{$slug} h3,";
		$css[] = "article.tribe-events-calendar-day__event.tribe_events_cat-{$slug} h3,";
		$css[] = "article.tribe-events-calendar-list__event.tribe_events_cat-{$slug} h3,";
		$css[] = "article.tribe-events-calendar-latest-past__event.tribe_events_cat-{$slug} h3";
		self::echo_css( $css, $comma );
	}

	/**
	 * Add v2 multiday background color.
	 *
	 * @return void
	 */
	public static function add_v2_multiday_background_color() {
		$css[] = '.tribe-events .tribe-events-calendar-month__multiday-event-bar,';
		$css[] = '.tribe-events .tribe-events-calendar-month__multiday-event-bar-inner,';
		$css[] = '.tribe-events-calendar-month__multiday-event-wrapper';
		$css[] = '{ background-color: #F7F6F6; }';
		self::echo_css( $css );
	}

	/**
	 * Make event spacer transparent.
	 *
	 * @return void
	 */
	public static function fix_spacer_background() {
		$css[] = '.tribe-events-calendar-month__multiday-event-wrapper.tribe-events-calendar-month__multiday-event--empty';
		$css[] = '{ background-color: transparent !important; }';
		self::echo_css( $css );
	}
}
