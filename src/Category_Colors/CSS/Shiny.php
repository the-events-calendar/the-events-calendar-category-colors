<?php
namespace Fragen\Category_Colors\CSS;

class Shiny {
	public static function add_link_css( $slug ) {
		$css = array();

		//$css[] = "#tribe-events-content table.tribe-events-calendar //.tribe-event-featured.tribe-events-category-{$slug} .tribe-events-month-event-title a,";
		//$css[] = ".teccc-legend .tribe-events-category-{$slug} a,";
		//$css[] = ".tribe-events-calendar .tribe-events-category-{$slug} a,";
		//$css[] = "#tribe-events-content .teccc-legend .tribe-events-category-{$slug} a,";
		//$css[] = "#tribe-events-content .tribe-events-calendar .tribe-events-category-{$slug} a,";
		//$css[] = ".type-tribe_events.tribe-events-category-{$slug} h2 a,";
		//$css[] = ".tribe-events-category-{$slug} > div.hentry.vevent > h3.entry-title a,";
		//$css[] = ".tribe-events-mobile.tribe-events-category-{$slug} h4 a";

		$css[] = "article.tribe_events_cat-{$slug} h3 a,";
		$css[] = "article.tribe-events-calendar-month__multiday-event.tribe_events_cat-{$slug} h3,";

		$css[] = '';
		$css   = implode( "\n", $css );
		echo $css;
	}

	public static function add_background_css( $slug ) {
		$css = array();

		//$css[] = ".events-archive.events-gridview #tribe-events-content table //.type-tribe_events.tribe-events-category-{$slug},";
		//$css[] = ".teccc-legend .tribe-events-category-{$slug},";
		//$css[] = ".tribe-events-calendar .tribe-events-category-{$slug},";
		//$css[] = "#tribe-events-content .tribe-events-category-{$slug} > .tribe-events-tooltip h3,";
		//$css[] = ".type-tribe_events.tribe-events-category-{$slug} h2,";
		//$css[] = ".tribe-events-category-{$slug} > div.hentry.vevent > h3.entry-title,";
        //$css[] = ".tribe-events-mobile.tribe-events-category-{$slug} h4";

		$css[] = "article.tribe_events_cat-{$slug} h3,";
		//$css[] = "article.tribe_events_cat-farmers-market a.tribe-events-calendar-month__multiday-event-inner,";
		$css[] = "article.tribe-events-calendar-month__multiday-event.tribe_events_cat-{$slug} a.tribe-events-calendar-month__multiday-event-inner,";
		//$css[] = "article.tribe-events-calendar-month__multiday-event.tribe-events-calendar-month__multiday-event--start.tribe_events_cat-{$slug} a.tribe-events-calendar-month__multiday-event-inner,";

		$css[] = '';
		$css   = implode( "\n", $css );
		echo $css;
	}
}
