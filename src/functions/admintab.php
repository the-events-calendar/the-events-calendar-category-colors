<?php
/**
 * The Events Calendar: Category Colors
 *
 * @author   Andy Fragen
 * @license  MIT
 * @link     https://github.com/the-events-calendar/the-events-calendar-category-colors
 * @package  the-events-calendar-category-colors
 */

/**
 * Return The Events Calendar Settings tab data.
 */
namespace Fragen\Category_Colors;

use Fragen\Category_Colors\Settings as Settings;

$settings = [
	'priority'      => 40,
	'fields'        => [
		'tec-settings-category-colors-title' => [
			'type' => 'html',
			'html' => '<div class="tec-settings-form__header-block tec-settings-form__header-block--horizontal">'
					. '<h3 id="tec-settings-category-colors-title" class="tec-settings-form__section-header">'
					. _x( 'Category Colors Settings', 'Title for the category colors tab.', 'the-events-calendar-category-colors' )
					. '</h3>'
					. '<p>' . sprintf(
						wp_kses_post(
							__( 'The Events Calendar: Category Colors plugin was inspired by the tutorial <i>Coloring Your Category Events</i>.', 'the-events-calendar-category-colors' )
						)
					) . '</p>'
					.'<p>' . sprintf(
						wp_kses_post( __( 'Instructions for <strong>filters</strong>, <strong>hooks</strong>, <strong>settings functions</strong>, and <strong>help</strong> are on <a href="https://github.com/the-events-calendar/the-events-calendar-category-colors/wiki">The Events Calendar: Category Colors wiki</a>.', 'the-events-calendar-category-colors' ) )
					) . '</p>'
					. '</div>',
		],

	],
];

$settings_obj       = new Settings();
$settings_fields    = $settings_obj->do_settings();
$settings['fields'] = array_merge( $settings['fields'], $settings_fields );

$settings['fields']['minicolors-console'] = [
	'type' => 'html',
	'html' => '<div id="console"></div>',
];

return $settings;
