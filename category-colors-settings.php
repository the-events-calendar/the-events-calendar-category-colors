<?php
	$categoryColorsTab = array(
	'priority' => 70,
	'show_save' => false,
	'parent_option' => 'teccc_options',
	'fields' => array(
		'info-start' => array(
			'type' => 'html',
			'html' => '<h3>Category Colors Settings</h3>'
			),
		'blurb' => array(
			'type' => 'html',
			'html' => '<p>The Events Calendar Category Colors plugin was inspired by the tutorial <a href="http://tri.be/coloring-your-category-events/">Coloring Your Category Events</a>.</p>'
			),
		'legend' => array(
			'type' => 'html',
			'html' => '<p>To include a Category Color legend above your calendar you will need to place a copy of ecp-page-template.php in your theme\'s "events" directory, similar to <code>my-theme/events/ecp-page-template.php</code>. This file is found in The Events Calendar plugin\'s "views" directory. Please refer to <a href="http://tri.be/themers-guide-to-the-events-calendar/">Themer\'s Guide for The Events Calendar</a> for reference.</p><p>Within your copy of ecp-page-template.php you will need to insert <code>&lt;?php teccc_legend_hook(); ?&gt;</code> where you want the legend to appear.'
			),
		'form-elements' => array(
			'type' => 'html',
			'html' => teccc_options_elements()
			), 		
		'save-button' => array(
			'type' => 'html',
			'html' => '<p class="submit"><input type="submit" class="button-primary" value="' . __('Save Changes') . '" /></p>'
			)
		)
	);

?>