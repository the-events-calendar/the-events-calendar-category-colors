<?php
return array(
	'priority' => 70,
	'show_save' => false,
	'parent_option' => 'teccc_options',
	'fields' => array(
		'info-start' => array(
			'type' => 'html',
			'html' => '<div id="modern-tribe-info">'
		),
		'title' => array(
			'type' => 'html',
			'html' => '<h2>'.__('Category Colors Settings', 'events-calendar-category-colors').'</h2>'
		),
		'blurb' => array(
			'type' => 'html',
			'html' => '<p>'.__('The Events Calendar Category Colors plugin was inspired by the tutorial <i>Coloring Your Category Events</i>.', 'events-calendar-category-colors').'</p>'
		),
 		'legend' => array(
 			'type' => 'html',
 			'html' => '<p>'.__('Instructions for <strong>filters</strong>, <strong>hooks</strong>, <strong>settings functions</strong>, and <strong>help</strong> are on <a href="https://github.com/afragen/events-calendar-category-colors/wiki">The Events Calendar Category Colors wiki</a>.', 'events-calendar-category-colors').'</p>'
 		),
		'info-end' => array(
			'type' => 'html',
			'html' => '</div>'
		),
		'form-elements' => array(
			'type' => 'html',
			'html' => Tribe_Events_Category_Colors_Admin::options_elements()
		),
		'minicolors-console' => array(
			'type' => 'html',
			'html' => '<div id="console"></div>'
		),
		'save-button' => array(
			'type' => 'html',
			'html' => '<p class="submit"><input type="submit" class="button-primary" value="' . __('Save Changes', 'events-calendar-category-colors') . '" /></p>'
		)
	)
);
