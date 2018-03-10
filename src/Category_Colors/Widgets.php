<?php

namespace Fragen\Category_Colors;

class Widgets extends Frontend {

	public static function add_widget_link_css( $slug ) {
		$css = array();
		if ( class_exists( 'Tribe__Events__Pro__Main' ) ) {
			$css[] = '.tribe-events-adv-list-widget li.tribe-events-category-' . $slug . ' h2 a:link,';
			$css[] = '.tribe-events-adv-list-widget li.tribe-events-category-' . $slug . ' h2 a:visited,';
			$css[] = '.tribe-mini-calendar-list-wrapper .tribe-events-category-' . $slug . ' h2 a:link,';
			$css[] = '.tribe-mini-calendar-list-wrapper .tribe-events-category-' . $slug . ' h2 a:visited,';
			$css[] = '.tribe-venue-widget-list li.tribe-events-category-' . $slug . ' a:link,';
			$css[] = '.tribe-venue-widget-list li.tribe-events-category-' . $slug . ' a:visited,';
		} else {
			// 3.9
			$css[] = '.tribe-events-list-widget li.tribe-events-category-' . $slug . ' a:link,';
			$css[] = '.tribe-events-list-widget li.tribe-events-category-' . $slug . ' a:visited,';
			// 3.10
			$css[] = 'li.tribe-events-list-widget-events.tribe-events-category-' . $slug . ' a:link,';
			$css[] = 'li.tribe-events-list-widget-events.tribe-events-category-' . $slug . ' a:visited,';
		}
		$css[] = '';
		$css   = implode( "\n", $css );
		echo $css;
	}

	public static function add_widget_background_css( $slug ) {
		$css = array();
		if ( class_exists( 'Tribe__Events__Pro__Main' ) ) {
			$css[] = '.tribe-events-adv-list-widget .tribe-events-category-' . $slug . ' h2 a:link,';
			$css[] = '.tribe-events-adv-list-widget .tribe-events-category-' . $slug . ' h2 a:visited,';
			$css[] = '.tribe-mini-calendar-list-wrapper .tribe-events-category-' . $slug . ' h2 a:link,';
			$css[] = '.tribe-mini-calendar-list-wrapper .tribe-events-category-' . $slug . ' h2 a:visited,';
			$css[] = '.tribe-venue-widget-list li.tribe-events-category-' . $slug . ' a:link,';
			$css[] = '.tribe-venue-widget-list li.tribe-events-category-' . $slug . ' a:visited,';
			$css[] = '.tribe-mini-calendar td.tribe-events-has-events.tribe-events-category-' . $slug . ',';
		} else {
			$css[] = '.tribe-events-list-widget li.tribe-events-category-' . $slug . ' a:link,'; // 3.9
			$css[] = '.tribe-events-list-widget li.tribe-events-category-' . $slug . ' a:visited,'; // 3.9
			$css[] = 'li.tribe-events-list-widget-events.tribe-events-category-' . $slug . ' a:link,'; // 3.10
			$css[] = 'li.tribe-events-list-widget-events.tribe-events-category-' . $slug . ' a:visited,'; // 3.10
		}
		$css[] = '';
		$css   = implode( "\n", $css );
		echo $css;
	}

	public static function add_widget_display_css( $slug ) {
		$css = array();
		if ( class_exists( 'Tribe__Events__Pro__Main' ) ) {
			$css[] = '.tribe-events-adv-list-widget .tribe-events-category-' . $slug . ' h2 a:link,';
			$css[] = '.tribe-mini-calendar-list-wrapper .tribe-events-category-' . $slug . ' h2 a:link,';
			$css[] = '.tribe-venue-widget-list li.tribe-events-category-' . $slug . ' a:link,';
		} else {
			// 3.9
			$css[] = '.tribe-events-list-widget li.tribe-events-category-' . $slug . ' a:link,';
			// 3.10
			$css[] = 'li.tribe-events-list-widget-events.tribe-events-category-' . $slug . ' a:link,';
		}
		$css[] = '';
		$css   = implode( "\n", $css );
		echo $css;
	}

}
