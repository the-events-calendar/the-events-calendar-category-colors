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
 * Class Base_CSS
 */
class Base_CSS {

	/**
	 * Add link CSS
	 *
	 * @param string $slug Slug.
	 *
	 * @return void
	 */
	public static function add_link_css( $slug ) {
		$css = [];

		$css[] = "#tribe-events-content table.tribe-events-calendar .tribe-event-featured.tribe-events-category-{$slug} .tribe-events-month-event-title a,";
		$css[] = ".teccc-legend .tribe-events-category-{$slug} a,";
		$css[] = ".tribe-events-calendar .tribe-events-category-{$slug} a,";
		$css[] = "#tribe-events-content .teccc-legend .tribe-events-category-{$slug} a,";
		$css[] = "#tribe-events-content .tribe-events-calendar .tribe-events-category-{$slug} a,";
		$css[] = ".type-tribe_events.tribe-events-category-{$slug} h2 a,";
		$css[] = ".tribe-events-category-{$slug} > div.hentry.vevent > h3.entry-title a,";
		$css[] = ".tribe-events-mobile.tribe-events-category-{$slug} h4 a";

		$css[] = '';
		$css   = implode( "\n", $css );
		echo $css;
	}

	public static function add_background_css( $slug ) {
		$css = [];

		$css[] = ".events-archive.events-gridview #tribe-events-content table .type-tribe_events.tribe-events-category-{$slug},";
		$css[] = ".teccc-legend .tribe-events-category-{$slug},";
		$css[] = ".tribe-events-calendar .tribe-events-category-{$slug},";
		$css[] = "#tribe-events-content .tribe-events-category-{$slug} > .tribe-events-tooltip h3,";
		$css[] = ".type-tribe_events.tribe-events-category-{$slug} h2,";
		$css[] = ".tribe-events-category-{$slug} > div.hentry.vevent > h3.entry-title,";
		$css[] = ".tribe-events-mobile.tribe-events-category-{$slug} h4";

		$css[] = '';
		$css   = implode( "\n", $css );
		echo $css;
	}
}
