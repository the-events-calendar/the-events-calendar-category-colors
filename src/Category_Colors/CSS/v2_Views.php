<?php
namespace Fragen\Category_Colors\CSS;

class v2_Views {
	public static function add_link_css( $slug ) {
		$css = [];

		$css[] = ".teccc-legend .tribe_events_cat-{$slug} a,";
		$css[] = ".tribe-common article.tribe_events_cat-{$slug} h3 a,";
		$css[] = ".tribe-common article.tribe_events_cat-{$slug} h3 a:link,";

		// $css[] = "article.tribe-events-calendar-month__multiday-event.tribe_events_cat-{$slug} .tribe-events-calendar-month__multiday-event-bar-inner h3,";
		$css[] = "article.tribe-events-calendar-month__multiday-event.tribe_events_cat-{$slug} h3,";
		// $css[] = "article.tribe_events_cat-{$slug} .tribe-events-calendar-month__calendar-event-datetime";

		$css[] = '';
		$css   = implode( "\n", $css );
		echo $css;
	}

	public static function add_background_css( $slug ) {
		$css = [];

		$css[] = ".teccc-legend .tribe_events_cat-{$slug},";
		$css[] = "article.tribe_events_cat-{$slug} header.tribe-events-widget-events-list__event-header h3,";
		$css[] = "article.tribe-events-calendar-month__calendar-event.tribe_events_cat-{$slug} h3,";
		$css[] = "article.tribe-events-calendar-month__multiday-event.tribe_events_cat-{$slug} .tribe-events-calendar-month__multiday-event-bar-inner,";
		// $css[] = ".tribe-events-calendar-month__multiday-event-wrapper article.tribe-events-calendar-month__multiday-event.tribe_events_cat-{$slug},";
		$css[] = "article.tribe-events-calendar-month-mobile-events__mobile-event.tribe_events_cat-{$slug} h3,";
		$css[] = "article.tribe-events-calendar-day__event.tribe_events_cat-{$slug} h3,";
		$css[] = "article.tribe-events-calendar-list__event.tribe_events_cat-{$slug} h3,";
		$css[] = "article.tribe-events-pro-photo__event.tribe_events_cat-{$slug} h3,";
		$css[] = "article.tribe-events-pro-map__event-card.tribe_events_cat-{$slug} h3,";
		$css[] = "article.tribe-events-pro-week-grid__event.tribe_events_cat-{$slug} h3,";
		$css[] = "article.tribe-events-pro-week-mobile-events__event.tribe_events_cat-{$slug} h3,";
		$css[] = "article.tribe-events-pro-week-grid__multiday-event.tribe_events_cat-{$slug} h3,";

		// $css[] = "article.tribe-events-calendar-day__event.tribe_events_cat-{$slug} header.tribe-events-calendar-day__event-header h3.tribe-events-calendar-day__event-title";
		// $css[] = "article.tribe-events-calendar-month__multiday-event.tribe_events_cat-{$slug} a.tribe-events-calendar-month__multiday-event-inner,";
		// $css[] = "article.tribe-events-calendar-month__multiday-event.tribe-events-calendar-month__multiday-event--start.tribe_events_cat-{$slug} a.tribe-events-calendar-month__multiday-event-inner,";
		// $css[] = "article.tribe_events_cat-{$slug} .tribe-events-calendar-month__multiday-event-bar-inner,";
		// $css[] = "article.tribe_events_cat-{$slug} .tribe-events-calendar-month__calendar-event-details,";
		// $css[] = "article.tribe-events-calendar-month__calendar-event.tribe_events_cat-{$slug} .tribe-events-calendar-month__calendar-event-datetime,";
		// $css[] = '.tribe-events article.tribe-events-calendar-month__calendar-event-datetime';

		$css[] = '';
		$css   = implode( "\n", $css );
		echo $css;
	}

	public static function add_v2_multiday_background_color() {
		$css[] = '.tribe-events .tribe-events-calendar-month__multiday-event-bar,';
		$css[] = '.tribe-events .tribe-events-calendar-month__multiday-event-bar-inner,';
		$css[] = '.tribe-events-calendar-month__multiday-event-wrapper,';
		$css[] = '.tribe-events-pro .tribe-events-pro-week-grid__multiday-event-bar,';
		$css[] = '.tribe-events-pro .tribe-events-pro-week-grid__multiday-event-bar-inner,';
		$css[] = '.tribe-events-pro .tribe-events-pro-week-grid__multiday-event-wrapper';
		$css[] = '{ background-color: #F7F6F6; }';

		$css[] = '';
		$css   = implode( "\n", $css );
		echo $css;
	}
}
