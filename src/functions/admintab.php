<?php
/**
 * The Events Calendar: Category Colors
 *
 * @author   Andy Fragen
 * @license  MIT
 * @link     https://github.com/afragen/the-events-calendar-category-colors
 * @package  the-events-calendar-category-colors
 */

/**
 * Return The Events Calendar Settings tab data.
 */
namespace Fragen\Category_Colors;

return [
	'priority'      => 40,
	'show_save'     => false,
	'parent_option' => 'teccc_options',
	'fields'        => [
		'info-start'         => [
			'type' => 'html',
			'html' => '<div id="modern-tribe-info">',
		],
		'title'              => [
			'type' => 'html',
			'html' => '<h2>' . esc_html__( 'Category Colors Settings', 'the-events-calendar-category-colors' ) . '</h2>',
		],
		'blurb'              => [
			'type' => 'html',
			'html' => '<p>' . sprintf(
				wp_kses_post(
					__( 'The Events Calendar: Category Colors plugin was inspired by the tutorial <i>Coloring Your Category Events</i>.', 'the-events-calendar-category-colors' )
				)
			) . '</p>',
		],
		'legend'             => [
			'type' => 'html',
			'html' => '<p>' . sprintf(
				wp_kses_post( __( 'Instructions for <strong>filters</strong>, <strong>hooks</strong>, <strong>settings functions</strong>, and <strong>help</strong> are on <a href="https://github.com/afragen/the-events-calendar-category-colors/wiki">The Events Calendar: Category Colors wiki</a>.', 'the-events-calendar-category-colors' ) )
			) . '</p>',
		],
		'info-end'           => [
			'type' => 'html',
			'html' => '</div>',
		],
		'form-elements'      => [
			'type' => 'html',
			'html' => Admin::options_elements(),
		],
		'minicolors-console' => [
			'type' => 'html',
			'html' => '<div id="console"></div>',
		],
		'save-button'        => [
			'type' => 'html',
			'html' => '<p class="submit"><input type="submit" class="button-primary" value="' . esc_html__( 'Save Changes', 'the-events-calendar-category-colors' ) . '" /></p>',
		],
	],
];
