<?php

namespace Fragen\Category_Colors\CSS;

class Widgets {

	public static function add_widget_link_css( $slug ) {
		$css = array();
		if ( class_exists( 'Tribe__Events__Pro__Main' ) ) {
			$css[] = ".tribe-events-adv-list-widget .tribe-events-category-{$slug} h2 a:link,";
			$css[] = ".tribe-events-adv-list-widget .tribe-events-category-{$slug} h2 a:visited,";
			$css[] = ".tribe-mini-calendar-list-wrapper .tribe-events-category-{$slug} h2 a:link,";
			$css[] = ".tribe-mini-calendar-list-wrapper .tribe-events-category-{$slug} h2 a:visited,";
			$css[] = ".tribe-events-category-{$slug}.tribe-event-featured .tribe-mini-calendar-event .tribe-events-title a,";
			$css[] = ".tribe-venue-widget-list li.tribe-events-category-{$slug} h4 a:link,";
			$css[] = ".tribe-venue-widget-list li.tribe-events-category-{$slug} h4 a:visited,";
		} else {
			$css[] = ".tribe-events-list-widget li.tribe-events-category-{$slug} a:link,"; // 3.9
			$css[] = ".tribe-events-list-widget li.tribe-events-category-{$slug} a:visited,"; // 3.9
			$css[] = "li.tribe-events-list-widget-events.tribe-events-category-{$slug} a:link,"; // 3.10
			$css[] = "li.tribe-events-list-widget-events.tribe-events-category-{$slug} a:visited,"; // 3.10
		}
		$css[] = '';
		$css   = implode( "\n", $css );
		echo $css;
	}

	public static function add_widget_background_css( $slug ) {
		$css = array();
		if ( class_exists( 'Tribe__Events__Pro__Main' ) ) {
			$css[] = ".tribe-mini-calendar td.tribe-events-has-events.tribe-events-category-{$slug},";
			$css[] = ".tribe-events-adv-list-widget .tribe-events-category-{$slug} h2,";
			$css[] = ".tribe-venue-widget-list li.tribe-events-category-{$slug} h4,";
		} else {
			$css[] = ".tribe-events-list-widget li.tribe-events-category-{$slug} h4,";
			$css[] = "li.tribe-events-list-widget-events.tribe-events-category-{$slug} h4,";
		}
		$css[] = '';
		$css   = implode( "\n", $css );
		echo $css;
	}

}
