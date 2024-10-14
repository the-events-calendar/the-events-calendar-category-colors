<?php
/**
 * The Events Calendar: Category Colors
 *
 * @author   Andy Fragen
 * @license  MIT
 * @link     https://github.com/the-events-calendar/the-events-calendar-category-colors
 * @package  the-events-calendar-category-colors
 */

?>

@media only screen and (max-width: <?php esc_attr_e( $breakpoint ); ?>px) {
	.tribe-events-calendar td .hentry,
	.tribe-events-calendar td .type-tribe_events {
		display: block;
	}

	h3.entry-title.summary,
	h3.tribe-events-month-event-title,
	.tribe-events-calendar .tribe-events-has-events:after {
		display: none;
	}

	.tribe-events-calendar .mobile-trigger .tribe-events-tooltip {
		display: none !important;
	}
}
