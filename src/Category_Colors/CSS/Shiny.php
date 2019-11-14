<?php
namespace Fragen\Category_Colors\CSS;

class Shiny {
	public static function add_link_css( $slug ) {
		$css = array();

		$css[] = "article.tribe_events_cat-{$slug} h3 a,";
		$css[] = "article.tribe_events_cat-{$slug} h3 a:link,";
		$css[] = "article.tribe-events-calendar-month__multiday-event.tribe_events_cat-{$slug} h3,";
		//$css[] = "article.tribe_events_cat-{$slug} .tribe-events-calendar-month__calendar-event-datetime";

		$css[] = '';
		$css   = implode( "\n", $css );
		echo $css;
	}

	public static function add_background_css( $slug ) {
		$css = array();

		// $css[] = "article.tribe_events_cat-{$slug} h3,";
		$css[] = "article.tribe-events-calendar-month__calendar-event.tribe_events_cat-{$slug} h3,";
		// $css[] = "article.tribe-events-calendar-month__multiday-event.tribe_events_cat-{$slug} a.tribe-events-calendar-month__multiday-event-inner,";
		// $css[] = "article.tribe-events-calendar-month__multiday-event.tribe-events-calendar-month__multiday-event--start.tribe_events_cat-{$slug} a.tribe-events-calendar-month__multiday-event-inner,";
		$css[] = "article.tribe_events_cat-{$slug} .tribe-events-calendar-month__multiday-event-bar-inner,";
		// $css[] = "article.tribe_events_cat-{$slug} .tribe-events-calendar-month__calendar-event-details,";
		$css[] = "article.tribe-events-calendar-month__calendar-event.tribe_events_cat-{$slug} .tribe-events-calendar-month__calendar-event-datetime";
		$css[] = '.tribe-events article.tribe-events-calendar-month__calendar-event-datetime';

		$css[] = '';
		$css   = implode( "\n", $css );
		echo $css;
	}
}
