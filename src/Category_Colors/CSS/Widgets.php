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
 * Class Widgets
 */
class Widgets {

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
	 * Add widget link CSS
	 *
	 * @param string $slug Slug.
	 * @param string $comma Add a comma or not.
	 *
	 * @return void
	 */
	public static function add_widget_link_css( $slug, $comma ) {
		$css = [];
		if ( class_exists( 'Tribe__Events__Pro__Main' ) ) {
			$css[] = ".tribe-events-adv-list-widget .tribe-events-category-{$slug} h2 a:link,";
			$css[] = ".tribe-events-adv-list-widget .tribe-events-category-{$slug} h2 a:visited,";
			$css[] = ".tribe-mini-calendar-list-wrapper .tribe-events-category-{$slug} h2 a:link,";
			$css[] = ".tribe-mini-calendar-list-wrapper .tribe-events-category-{$slug} h2 a:visited,";
			$css[] = ".tribe-events-category-{$slug}.tribe-event-featured .tribe-mini-calendar-event .tribe-events-title a,";
			$css[] = ".tribe-venue-widget-list li.tribe-events-category-{$slug} h4 a:link,";
			$css[] = ".tribe-venue-widget-list li.tribe-events-category-{$slug} h4 a:visited";
		} else {
			$css[] = ".tribe-events-list-widget li.tribe-events-category-{$slug} a:link,"; // 3.9
			$css[] = ".tribe-events-list-widget li.tribe-events-category-{$slug} a:visited,"; // 3.9
			$css[] = "li.tribe-events-list-widget-events.tribe-events-category-{$slug} a:link,"; // 3.10
			$css[] = "li.tribe-events-list-widget-events.tribe-events-category-{$slug} a:visited"; // 3.10
		}
		self::echo_css( $css, $comma );
	}

	/**
	 * Add widget background CSS
	 *
	 * @param string $slug Slug.
	 * @param string $comma Add a comma or not.
	 *
	 * @return void
	 */
	public static function add_widget_background_css( $slug, $comma ) {
		$css = [];
		if ( class_exists( 'Tribe__Events__Pro__Main' ) ) {
			$css[] = ".tribe-mini-calendar td.tribe-events-has-events.tribe-events-category-{$slug},";
			$css[] = ".tribe-events-adv-list-widget .tribe-events-category-{$slug} h2,";
			$css[] = ".tribe-venue-widget-list li.tribe-events-category-{$slug} h4";
		} else {
			$css[] = ".tribe-events-list-widget li.tribe-events-category-{$slug} h4,";
			$css[] = "li.tribe-events-list-widget-events.tribe-events-category-{$slug} h4";
		}
		self::echo_css( $css, $comma );
	}
}
