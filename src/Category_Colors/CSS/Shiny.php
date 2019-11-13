<?php
namespace Fragen\Category_Colors\CSS;

class Shiny {
	public static function add_link_css( $slug ) {
		$css = array();

		$css[] = "article.tribe_events_cat-{$slug} h3 a,";
		$css[] = "article.tribe-events-calendar-month__multiday-event.tribe_events_cat-{$slug} h3,";

		$css[] = '';
		$css   = implode( "\n", $css );
		echo $css;
	}

	public static function add_background_css( $slug ) {
		$css = array();

		$css[] = "article.tribe_events_cat-{$slug} h3,";
		$css[] = "article.tribe-events-calendar-month__multiday-event.tribe_events_cat-{$slug} a.tribe-events-calendar-month__multiday-event-inner,";
		// $css[] = "article.tribe-events-calendar-month__multiday-event.tribe-events-calendar-month__multiday-event--start.tribe_events_cat-{$slug} a.tribe-events-calendar-month__multiday-event-inner,";
		$css[] = "article.tribe_events_cat-{$slug} .tribe-events-calendar-month__multiday-event-bar-inner,";

		$css[] = '';
		$css   = implode( "\n", $css );
		echo $css;
	}
}
