<?php
class Tribe_Events_Category_Colors_Widgets {
	protected $teccc = null;

	public function __construct() {
	
	}
	

	public function add_widget_link_css( $slug ) {
		$css = array();
		if( class_exists( 'TribeEventsPro') ) {
			$css[] = '.tribe-mini-calendar-event h2.tribe-events-category-' .  $slug .' a,';
			$css[] = '.tribe-mini-calendar-event h2.tribe-events-category-' .  $slug . ' a:hover,';
			$css[] = '.tribe-mini-calendar-event h2.tribe-events-category-' .  $slug . ' a:visited,';
			$css[] = '.tribe-events-adv-list-widget h4.tribe-events-category-' .  $slug . ' a,';
			$css[] = '.tribe-events-adv-list-widget h4.tribe-events-category-' .  $slug . ' a:hover,';
			$css[] = '.tribe-events-adv-list-widget h4.tribe-events-category-' .  $slug . ' a:visited,';
		} else {
			$css[] = '.tribe-events-list-widget h4.tribe-events-category-' .  $slug . ' a,';
			$css[] = '.tribe-events-list-widget h4.tribe-events-category-' .  $slug . ' a:hover,';
			$css[] = '.tribe-events-list-widget h4.tribe-events-category-' .  $slug . ' a:visited,';
		}
		$css[] = '';
		$css = implode( "\n", $css );
		echo $css;
	
	}
	
	public function add_widget_background_css( $slug ) {
		$css = array();
		if( class_exists( 'TribeEventsPro' ) ) {
			$css[] = '.tribe-mini-calendar-event h2.tribe-events-category-' .  $slug . ' a,';
			$css[] = '.tribe-events-adv-list-widget h4.tribe-events-category-' .  $slug . ' a,';
		} else {
			$css[] = '.tribe-events-list-widget h4.tribe-events-category-' .  $slug . ' a,';
		}
			$css[] = '';
		$css = implode( "\n", $css );
		echo $css;
	}
	
	public function add_widget_display_css( $slug ) {
		$css = array();
		if( class_exists( 'TribeEventsPro' ) ) {
			$css[] = '.tribe-mini-calendar-event h2.tribe-events-category-' .  $slug . ' a,';
			$css[] = '.tribe-events-adv-list-widget h4.tribe-events-category-' .  $slug . ' a,';
		} else {
			$css[] = '.tribe-events-list-widget h4.tribe-events-category-' .  $slug . ' a,';
		}
			$css[] = '';
		$css = implode( "\n", $css );
		echo $css;

	}
	
}