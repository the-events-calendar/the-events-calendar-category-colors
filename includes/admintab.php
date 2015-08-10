<?php
namespace Fragen\Category_Colors;

return array(
	'priority'      => 40,
	'show_save'     => false,
	'parent_option' => 'teccc_options',
	'fields' => array(
		'info-start' => array(
			'type' => 'html',
			'html' => '<div id="modern-tribe-info">'
		),
		'title' => array(
			'type' => 'html',
			'html' => '<h2>' . esc_html__('Category Colors Settings', 'the-events-calendar-category-colors') . '</h2>'
		),
		'blurb' => array(
			'type' => 'html',
			'html' => '<p>' . sprintf( esc_html__('The Events Calendar Category Colors plugin was inspired by the tutorial %sColoring Your Category Events%s.', 'the-events-calendar-category-colors'), '<i>', '</i>' ). '</p>'
		),
 		'legend' => array(
 			'type' => 'html',
 			'html' => '<p>' . sprintf( esc_html__('Instructions for %1$sfilters%2$s, %1$shooks%2$s, %1$ssettings functions%2$s, and %1$shelp%2$s are on %3$sThe Events Calendar Category Colors wiki%4$s.', 'the-events-calendar-category-colors'), '<strong>', '</strong>', '<a href="https://github.com/afragen/the-events-calendar-category-colors/wiki">', '</a>' ). '</p>'
 		),
		'info-end' => array(
			'type' => 'html',
			'html' => '</div>'
		),
		'form-elements' => array(
			'type' => 'html',
			'html' => Admin::options_elements()
		),
		'minicolors-console' => array(
			'type' => 'html',
			'html' => '<div id="console"></div>'
		),
		'save-button' => array(
			'type' => 'html',
			'html' => '<p class="submit"><input type="submit" class="button-primary" value="' . esc_html__('Save Changes', 'the-events-calendar-category-colors') . '" /></p>'
		)
	)
);
