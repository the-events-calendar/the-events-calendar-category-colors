<?php
class Tribe_Events_Category_Colors_Extras extends Tribe_Events_Category_Colors_Public {

	public static function add_agenda_link_css( $slug ) {
		if ( ! class_exists( 'TribeAgenda' ) ) {
			return false;
		}
		$css   = array();
		$css[] = '.tribe-events-category-' . $slug . ' .agenda-event-heading a:link,';
		$css[] = '.tribe-events-category-' . $slug . ' .agenda-event-heading a:visited,';
		$css[] = '';
		$css   = implode( "\n", $css );
		echo $css;
	}

	public static function add_agenda_background_css( $slug ) {
		if ( ! class_exists( 'TribeAgenda' ) ) {
			return false;
		}
		$css   = array();
		$css[] = '.tribe-events-category-' . $slug . ' .agenda-event-heading,';
		$css[] = '.tribe-events-category-' . $slug . ' .agenda-event-heading:hover,';
		$css[] = '';
		$css   = implode( "\n", $css );
		echo $css;
	}

	public static function add_agenda_display_css( $slug ) {
		if ( ! class_exists( 'TribeAgenda' ) ) {
			return false;
		}
		$css   = array();
		$css[] = '.tribe-events-category-' .  $slug . ' .agenda-event-heading,';
		$css[] = '';
		$css   = implode( "\n", $css );
		echo $css;
	}

	public static function add_map_link_css( $slug ) {
		if ( ! class_exists( 'TribeEventsPro' ) ) {
			return false;
		}
		$css   = array();
		$css[] = '.tribe-events-category-' . $slug . ' .tribe-events-map-event-title a:link,';
		$css[] = '.tribe-events-category-' . $slug . ' .tribe-events-map-event-title a:visited,';
		$css[] = '';
		$css   = implode( "\n", $css );
		echo $css;
	}
	
	public static function add_map_background_css( $slug ) {
		if ( ! class_exists( 'TribeEventsPro' ) ) {
			return false;
		}
		$css   = array();
		$css[] = '.tribe-events-category-' . $slug . ' .tribe-events-map-event-title a:link,';
		$css[] = '.tribe-events-category-' . $slug . ' .tribe-events-map-event-title a:visited,';
		$css[] = '';
		$css   = implode( "\n", $css );
		echo $css;
	}

	public static function add_map_display_css( $slug ) {
		if ( ! class_exists( 'TribeEventsPro' ) ) {
			return false;
		}
		$css   = array();
		$css[] = '.tribe-events-category-' . $slug . ' .tribe-events-map-event-title a:link,';
		$css[] = '';
		$css   = implode( "\n", $css );
		echo $css;
	}

	public static function add_week_background_css( $slug ) {
		if ( ! class_exists( 'TribeEventsPro' ) ) {
			return false;
		}
		$css   = array();
		//$css[] = '#tribe-events-content div.tribe-events-category-' . $slug . '.hentry.vevent h3.entry-title,';
		$css[] = '#tribe-events-content div.tribe-events-category-'. $slug . '.hentry.vevent .tribe-events-tooltip h4.entry-title,';
		$css[] = '';
		$css   = implode( "\n", $css );
		echo $css;
	}

	public static function fix_default_week_background() {
		if ( ! class_exists( 'TribeEventsPro' ) ) {
			return false;
		}
		$css   = array();
		$css[] = '.tribe-grid-body div[id*="tribe-events-event-"][class*="tribe-events-category-"] .hentry.vevent,';
		$css[] = '.tribe-grid-body div[id*="tribe-events-event-"][class*="tribe-events-category-"] .hentry.vevent:hover,';
		$css[] = '.tribe-grid-allday div[id*="tribe-events-event-"][class*="tribe-events-category-"].hentry.vevent div';
		$css[] = '{ background-color: #fff; }';
		//$css[] = '.tribe-events-grid div[id*="tribe-events-event-"]';
		//$css[] = '{ visibility: visible; }';
		$css[] = '';
		$css   = implode( "\n", $css );
		echo $css;
	}

	public static function add_week_link_css( $slug ) {
		if ( ! class_exists( 'TribeEventsPro' ) ) {
			return false;
		}
		$css   = array();
		$css[] = '#tribe-events-content div.tribe-events-category-' . $slug . '.hentry.vevent h3.entry-title a,';
		$css[] = '#tribe-events-content div.tribe-events-category-' . $slug . '.hentry.vevent .tribe-events-tooltip h4.entry-title.summary,';
		$css[] = '';
		$css   = implode( "\n", $css );
		echo $css;
	}

}