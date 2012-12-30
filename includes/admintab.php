<?php
return array(
	'priority' => 70,
	'show_save' => false,
	'parent_option' => 'teccc_options',
	'fields' => array(
		'miniColors-load' => array(
			'type' => 'html',
			'html' => TribeEventsCategoryColorsAdmin::mini_colors()
		),
		'info-start' => array(
			'type' => 'html',
			'html' => '<div id="modern-tribe-info">'
		),
		'title' => array(
			'type' => 'html',
			'html' => '<h2>Category Colors Settings</h2>'
		),
		'blurb' => array(
			'type' => 'html',
			'html' => '<p>The Events Calendar Category Colors plugin was inspired by the tutorial <a href="http://tri.be/coloring-your-category-events/">Coloring Your Category Events</a>.</p>'
		),
		'legend' => array(
			'type' => 'html',
			'html' => '<p>To include a Category Color legend above your calendar you will need to place a copy of ecp-page-template.php in your theme\'s <strong>events</strong> directory, similar to <code>my-theme/events/ecp-page-template.php</code>. This file is found in The Events Calendar plugin\'s <strong>views</strong> directory. Please refer to <a href="http://tri.be/themers-guide-to-the-events-calendar/">Themer\'s Guide for The Events Calendar</a> for reference.</p><p>Within your copy of ecp-page-template.php you will need to insert <code>&lt;?php teccc_legend_hook(); ?&gt;</code> where you want the legend to appear.'
		),
		'transparent' => array(
			'type' => 'html',
			'html' => '<p>When unsetting a transparent value to choose a color, you will need to save the unchecked state of <strong>Transparent</strong>, set the color and save again.</p>'
		),
		'info-end' => array(
			'type' => 'html',
			'html' => '</div>'
		),
		'form-elements' => array(
			'type' => 'html',
			'html' => TribeEventsCategoryColorsAdmin::options_elements()
		),
		'minicolors-console' => array(
			'type' => 'html',
			'html' => '<div id="console"></div>'
		),
		'save-button' => array(
			'type' => 'html',
			'html' => '<p class="submit"><input type="submit" class="button-primary" value="' . __('Save Changes') . '" /></p>'
		)
	)
);
