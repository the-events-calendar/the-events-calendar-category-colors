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
		'form-elements' => array(
			'type' => 'html',
			'html' => teccc_options_elements()
			), 		
		'save-button' => array(
			'type' => 'html',
			'html' => '<p class="submit"><input type="submit" class="button-primary" value="' . __('Save Changes') . '" /></p>'
			),
		'form-end' =>array(
			'type' => 'html',
			'html' => '</form>'
			)
		)
	);

?>