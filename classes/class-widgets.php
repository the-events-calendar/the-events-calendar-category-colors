<?php
class Tribe_Events_Category_Colors_Widgets {
	protected $teccc = null;	

	public function add_widget_link_css( $slug ) {
		$css = array();
		if ( class_exists( 'TribeEventsPro' ) ) {
			$css[] = '.tribe-events-adv-list-widget .tribe-events-category-' .  $slug . ' a:link,';
			$css[] = '.tribe-events-adv-list-widget .tribe-events-category-' .  $slug . ' a:visited,';
			$css[] = '.tribe-mini-calendar-list-wrapper .tribe-events-category-' .  $slug . ' a:link,';
			$css[] = '.tribe-mini-calendar-list-wrapper .tribe-events-category-' .  $slug . ' a:visited,';
		} else {
			$css[] = '.tribe-events-list-widget .tribe-events-category-' .  $slug . ' a:link,';
			$css[] = '.tribe-events-list-widget .tribe-events-category-' .  $slug . ' a:visited,';
		}
		$css[] = '';
		$css = implode( "\n", $css );
		echo $css;
	
	}
	
	public function add_widget_background_css( $slug ) {
		$css = array();
		if ( class_exists( 'TribeEventsPro' ) ) {
			$css[] = '.tribe-events-adv-list-widget .tribe-events-category-' .  $slug . ' a:link,';
			$css[] = '.tribe-events-adv-list-widget .tribe-events-category-' .  $slug . ' a:visited,';
			$css[] = '.tribe-mini-calendar-list-wrapper .tribe-events-category-' .  $slug . ' a:link,';
			$css[] = '.tribe-mini-calendar-list-wrapper .tribe-events-category-' .  $slug . ' a:visited,';
		} else {
			$css[] = '.tribe-events-list-widget .tribe-events-category-' .  $slug . ' a:link,';
			$css[] = '.tribe-events-list-widget .tribe-events-category-' .  $slug . ' a:visited,';
		}
		$css[] = '';
		$css = implode( "\n", $css );
		echo $css;
	}
	
	public function add_widget_display_css( $slug ) {
		$css = array();
		if ( class_exists( 'TribeEventsPro' ) ) {
			$css[] = '.tribe-events-adv-list-widget .tribe-events-category-' .  $slug . ' a:link,';
			$css[] = '.tribe-mini-calendar-list-wrapper .tribe-events-category-' .  $slug . ' a:link,';
		} else {
			$css[] = '.tribe-events-list-widget .tribe-events-category-' .  $slug . ' a:link,';
		}
		$css[] = '';
		$css = implode( "\n", $css );
		echo $css;
	}
	
}