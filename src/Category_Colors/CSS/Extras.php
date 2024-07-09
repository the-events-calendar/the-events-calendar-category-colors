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

use Fragen\Category_Colors\Main;

/**
 * Class Extras
 */
class Extras {

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
	 * Add list link CSS
	 *
	 * @param string $slug Slug.
	 * @param string $comma Add a comma or not.
	 *
	 * @return void
	 */
	public static function add_list_link_css( $slug, $comma ) {
		$css   = [];
		$css[] = ".tribe-events-category-{$slug} h2.tribe-events-list-event-title.entry-title a,";
		$css[] = ".tribe-events-category-{$slug} h2.tribe-events-list-event-title a,";
		$css[] = ".tribe-events-category-{$slug} h3.tribe-events-list-event-title a,";
		$css[] = ".tribe-event-featured .tribe-events-category-{$slug} h3.tribe-events-list-event-title a,";
		$css[] = ".tribe-events-list .tribe-events-loop .tribe-event-featured.tribe-events-category-{$slug} h3.tribe-events-list-event-title a";
		self::echo_css( $css, $comma );
	}

	/**
	 * Add list background CSS
	 *
	 * @param string $slug Slug.
	 * @param string $comma Add a comma or not.
	 *
	 * @return void
	 */
	public static function add_list_background_css( $slug, $comma ) {
		$css   = [];
		$css[] = ".tribe-events-category-{$slug} h3.tribe-events-list-event-title";
		self::echo_css( $css, $comma );
	}

	/**
	 * Add featured event link CSS
	 *
	 * @param string $slug Slug.
	 * @param string $comma Add a comma or not.
	 *
	 * @return void
	 */
	public static function add_featured_event_link_css( $slug, $comma ) {
		$css   = [];
		$css[] = ".tribe-events-list .tribe-events-loop .tribe-event-featured.tribe-events-category-{$slug} h3.tribe-events-list-event-title a:hover,";
		$css[] = "#tribe-events-content table.tribe-events-calendar .type-tribe_events.tribe-events-category-{$slug}.tribe-event-featured h3.tribe-events-month-event-title a:hover";
		self::echo_css( $css, $comma );
	}

	/**
	 * Add featured event border CSS
	 *
	 * @param string $slug    Slug.
	 * @param array  $options Array of options.
	 *
	 * @return void
	 */
	public static function add_featured_event_border_css( $slug, $options ) {
		$css   = [];
		$css[] = ".tribe-events-calendar .tribe-event-featured.tribe-events-category-{$slug},";
		$css[] = "#tribe-events-content table.tribe-events-calendar .type-tribe_events.tribe-event-featured.tribe-events-category-{$slug},";
		$css[] = ".tribe-grid-body div[id*='tribe-events-event-'][class*='tribe-events-category-'].tribe-events-week-hourly-single.tribe-event-featured";
		$css[] = "{ border-right: 5px solid {$options['featured-event']} }";
		self::echo_css( $css );
	}

	/**
	 * Add new featured event styling for TEC 6.x
	 *
	 * @param array $options Array of options.
	 *
	 * @return void
	 */
	public static function add_new_featured_event( $options ) {
		$css   = [];
		$css[] = '.tribe-common--breakpoint-medium.tribe-events .tribe-events-calendar-list__event-datetime-featured-text,';
		$css[] = '.tribe-events-calendar-month-mobile-events__mobile-event-datetime-featured-text,';
		$css[] = '.tribe-events-calendar-day__event-datetime-featured-text,';
		$css[] = '.tribe-common-c-svgicon--featured';
		$css[] = "{ color: {$options['featured-event']} !important; }";
		$css[] = '';
		$css[] = '.tribe-events-calendar-list__event-date-tag-datetime:after, ';
		$css[] = '.tribe-events-widget-events-list__event-date-tag-datetime:after, ';
		$css[] = '.tribe-events .tribe-events-calendar-day__event--featured:after,';
		$css[] = '.tribe-events .tribe-events-calendar-month__calendar-event--featured:before';
		$css[] = "{ background-color: {$options['featured-event']} !important; }";
		self::echo_css( $css );
	}

	/**
	 * Add mobile CSS
	 *
	 * @return void
	 */
	public static function add_mobile_css() {
		$css = Main::instance()->view(
			'mobile.css',
			[
				'breakpoint' => tribe_get_mobile_breakpoint(),
			],
			false
		);

		/**
		 * Add CSS to mobile.css.php file for inclusion in category.css.php.
		 *
		 * @since 4.4.6
		 * @return string $css Default string returned is mobile.css.php.
		 */
		echo wp_kses_post( apply_filters( 'teccc_mobile_css', $css ) );
	}

	/**
	 * Fix category link CSS
	 *
	 * @param string $slug Slug.
	 *
	 * @return void
	 */
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
		echo wp_kses_post( apply_filters( 'teccc_fix_category_link_color', '', '.tribe-events-category-' . $slug ) );
	}

	/**
	 * Fix category background CSS
	 *
	 * @param string $slug Slug.
	 *
	 * @return void
	 */
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
		echo wp_kses_post( apply_filters( 'teccc_fix_category_background_color', '', '.tribe-events-category-' . $slug ) );
	}

	/**
	 * Add deprecated background CSS
	 *
	 * @param string $slug Slug.
	 * @param string $comma Add a comma or not.
	 *
	 * @return void
	 */
	public static function add_deprecated_background_css( $slug, $comma ) {
		$css   = [];
		$css[] = "#tribe-events-content .tribe-events-category-{$slug} > .tribe-events-tooltip h4,";
		$css[] = ".tribe-events-category-{$slug} h2";
		self::echo_css( $css, $comma );
	}

	/**
	 * Add deprecated link CSS
	 *
	 * @param string $slug Slug.
	 * @param string $comma Add a comma or not.
	 *
	 * @return void
	 */
	public static function add_deprecated_link_css( $slug, $comma ) {
		$css   = [];
		$css[] = ".tribe-events-category-{$slug} h2 a,";
		$css[] = ".tribe-events-category-{$slug} h2.tribe-events-list-event-title.entry-title a";
		self::echo_css( $css, $comma );
	}

	/**
	 * Override customizer
	 *
	 * @param string $slug Slug.
	 * @param string $comma Add a comma or not.
	 *
	 * @return void
	 */
	public static function override_customizer( $slug, $comma ) {
		$css   = [];
		$css[] = ".tribe-events-shortcode .tribe-events-month table .type-tribe_events.tribe-events-category-{$slug}";
		self::echo_css( $css, $comma );
	}
}
