<?php
class Tribe_Events_Category_Colors_Widgets {
	protected $teccc = null;	

	public function add_widget_link_css( $slug ) {
		$css = array();
		$css[] = '.widget-area .widget .tribe-events-category-' .  $slug . ' a,';
		$css[] = '.widget-area .widget .tribe-events-category-' .  $slug . ' a:hover,';
		$css[] = '.widget-area .widget .tribe-events-category-' .  $slug . ' a:visited,';		
		$css[] = '';
		$css = implode( "\n", $css );
		echo $css;
	
	}
	
	public function add_widget_background_css( $slug ) {
		$css = array();
		$css[] = '.widget-area .widget .tribe-events-category-' .  $slug . ' a,';
		$css[] = '';
		$css = implode( "\n", $css );
		echo $css;
	}
	
	public function add_widget_display_css( $slug ) {
		$css = array();
		$css[] = '.widget-area .widget .tribe-events-category-' .  $slug . ' a,';
		$css[] = '';
		$css = implode( "\n", $css );
		echo $css;
	}
	
}