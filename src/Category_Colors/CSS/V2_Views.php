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
 * Class V2_Views
 */
class V2_Views {

	/**
	 * Echo CSS
	 *
	 * @param array $css Array of CSS.
	 *
	 * @return void
	 */
	private static function echo_css( $css ) {
		$css[] = '';
		$css   = implode( "\n", $css );
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo $css;
	}

	/**
	 * Add link CSS
	 *
	 * @param string $slug Slug.
	 *
	 * @return void
	 */
	public static function add_link_css( $slug ) {
		$css = [];

		$css[] = ".teccc-legend li.tribe_events_cat-{$slug} a,";
		$css[] = ".tribe-common article.tribe_events_cat-{$slug} h3 a,";
		$css[] = ".tribe-common article.tribe_events_cat-{$slug} h3 a:link,";
		$css[] = ".tribe-common article.tribe_events_cat-{$slug} h3 a:visited,";

		// $css[] = "article.tribe-events-calendar-month__multiday-event.tribe_events_cat-{$slug} .tribe-events-calendar-month__multiday-event-bar-inner h3,";
		$css[] = "article.tribe-events-calendar-month__multiday-event.tribe_events_cat-{$slug} h3,";
		// $css[] = "article.tribe_events_cat-{$slug} .tribe-events-calendar-month__calendar-event-datetime";
		self::echo_css( $css );
	}

	/**
	 * Add background CSS
	 *
	 * @param string $slug Slug.
	 *
	 * @return void
	 */
	public static function add_background_css( $slug ) {
		$css   = [];
		$css[] = ".teccc-legend li.tribe_events_cat-{$slug},";
		$css[] = "article.tribe_events_cat-{$slug} header.tribe-events-widget-events-list__event-header h3,";
		$css[] = "article.tribe-events-calendar-month__calendar-event.tribe_events_cat-{$slug} h3,";
		$css[] = "article.tribe-events-calendar-month__multiday-event.tribe_events_cat-{$slug} .tribe-events-calendar-month__multiday-event-bar-inner,";
		// $css[] = ".tribe-events-calendar-month__multiday-event-wrapper article.tribe-events-calendar-month__multiday-event.tribe_events_cat-{$slug},";
		$css[] = "article.tribe-events-calendar-month-mobile-events__mobile-event.tribe_events_cat-{$slug} h3,";
		$css[] = "article.tribe-events-calendar-day__event.tribe_events_cat-{$slug} h3,";
		$css[] = "article.tribe-events-calendar-list__event.tribe_events_cat-{$slug} h3,";
		$css[] = "article.tribe-events-pro-photo__event.tribe_events_cat-{$slug} h3,";
		$css[] = "article.tribe-events-pro-map__event-card.tribe_events_cat-{$slug} h3,";
		$css[] = "article.tribe-events-pro-week-grid__event.tribe_events_cat-{$slug} h3,";
		$css[] = "article.tribe-events-pro-week-mobile-events__event.tribe_events_cat-{$slug} h3,";
		$css[] = "article.tribe-events-pro-week-grid__multiday-event.tribe_events_cat-{$slug} h3,";

		// $css[] = "article.tribe-events-calendar-day__event.tribe_events_cat-{$slug} header.tribe-events-calendar-day__event-header h3.tribe-events-calendar-day__event-title";
		// $css[] = "article.tribe-events-calendar-month__multiday-event.tribe_events_cat-{$slug} a.tribe-events-calendar-month__multiday-event-inner,";
		// $css[] = "article.tribe-events-calendar-month__multiday-event.tribe-events-calendar-month__multiday-event--start.tribe_events_cat-{$slug} a.tribe-events-calendar-month__multiday-event-inner,";
		// $css[] = "article.tribe_events_cat-{$slug} .tribe-events-calendar-month__multiday-event-bar-inner,";
		// $css[] = "article.tribe_events_cat-{$slug} .tribe-events-calendar-month__calendar-event-details,";
		// $css[] = "article.tribe-events-calendar-month__calendar-event.tribe_events_cat-{$slug} .tribe-events-calendar-month__calendar-event-datetime,";
		// $css[] = '.tribe-events article.tribe-events-calendar-month__calendar-event-datetime';
		self::echo_css( $css );
	}

	/**
	 * Add v2 multiday background color.
	 *
	 * @return void
	 */
	public static function add_v2_multiday_background_color() {
		$css[] = '.tribe-events .tribe-events-calendar-month__multiday-event-bar,';
		$css[] = '.tribe-events .tribe-events-calendar-month__multiday-event-bar-inner,';
		$css[] = '.tribe-events-calendar-month__multiday-event-wrapper,';
		$css[] = '.tribe-events-pro .tribe-events-pro-week-grid__multiday-event-bar,';
		$css[] = '.tribe-events-pro .tribe-events-pro-week-grid__multiday-event-bar-inner,';
		$css[] = '.tribe-events-pro .tribe-events-pro-week-grid__multiday-event-wrapper';
		$css[] = '{ background-color: #F7F6F6; }';
		self::echo_css( $css );
	}
}
