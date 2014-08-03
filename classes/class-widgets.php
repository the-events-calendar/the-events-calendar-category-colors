<?php
class Tribe_Events_Category_Colors_Widgets extends Tribe_Events_Category_Colors_Public {

	public static function add_widget_link_css( $slug ) {
		$css = array();
		if ( class_exists( 'TribeEventsPro' ) ) {
			$css[] = '.tribe-events-adv-list-widget li.tribe-events-category-' .  $slug . ' h4 a:link,';
			$css[] = '.tribe-events-adv-list-widget li.tribe-events-category-' .  $slug . ' h4 a:visited,';
			$css[] = '.tribe-mini-calendar-list-wrapper .tribe-events-category-' .  $slug . ' h2 a:link,';
			$css[] = '.tribe-mini-calendar-list-wrapper .tribe-events-category-' .  $slug . ' h2 a:visited,';
			$css[] = '.tribe-venue-widget-list li.tribe-events-category-' . $slug . ' a:link,';
			$css[] = '.tribe-venue-widget-list li.tribe-events-category-' . $slug . ' a:visited,';
		} else {
			$css[] = '.tribe-events-list-widget li.tribe-events-category-' .  $slug . ' a:link,';
			$css[] = '.tribe-events-list-widget li.tribe-events-category-' .  $slug . ' a:visited,';
		}
		$css[] = '';
		$css   = implode( "\n", $css );
		echo $css;
	}

	public static function add_widget_background_css( $slug ) {
		$css = array();
		if ( class_exists( 'TribeEventsPro' ) ) {
			$css[] = '.tribe-events-adv-list-widget li.tribe-events-category-' .  $slug . ' h4 a:link,';
			$css[] = '.tribe-events-adv-list-widget li.tribe-events-category-' .  $slug . ' h4 a:visited,';
			$css[] = '.tribe-mini-calendar-list-wrapper .tribe-events-category-' .  $slug . ' h2 a:link,';
			$css[] = '.tribe-mini-calendar-list-wrapper .tribe-events-category-' .  $slug . ' h2 a:visited,';
			$css[] = '.tribe-venue-widget-list li.tribe-events-category-' . $slug . ' a:link,';
			$css[] = '.tribe-venue-widget-list li.tribe-events-category-' . $slug . ' a:visited,';
		} else {
			$css[] = '.tribe-events-list-widget li.tribe-events-category-' .  $slug . ' a:link,';
			$css[] = '.tribe-events-list-widget li.tribe-events-category-' .  $slug . ' a:visited,';
		}
		$css[] = '';
		$css   = implode( "\n", $css );
		echo $css;
	}

	public static function add_widget_display_css( $slug ) {
		$css = array();
		if ( class_exists( 'TribeEventsPro' ) ) {
			$css[] = '.tribe-events-adv-list-widget li.tribe-events-category-' .  $slug . ' h4 a:link,';
			$css[] = '.tribe-mini-calendar-list-wrapper .tribe-events-category-' .  $slug . ' h2 a:link,';
			$css[] = '.tribe-venue-widget-list li.tribe-events-category-' . $slug . ' a:link,';
		} else {
			$css[] = '.tribe-events-list-widget li.tribe-events-category-' .  $slug . ' a:link,';
		}
		$css[] = '';
		$css   = implode( "\n", $css );
		echo $css;
	}

}