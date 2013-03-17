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
			'html' => '<h2>Category Colors Settings</h2>'
		),
		'blurb' => array(
			'type' => 'html',
			'html' => '<p>The Events Calendar Category Colors plugin was inspired by the tutorial <a href="http://tri.be/coloring-your-category-events/">Coloring Your Category Events</a>.</p>'
		),
 		'legend' => array(
 			'type' => 'html',
 			'html' => '<p>The Category Colors legend is inserted using the new <i>tribe_events_calendar_before_the_grid</i> filter. To remove it from this default location and add it back using any of the new filters, add the following lines to your theme\'s functions.php file.</p><p><code>remove_filter(\'tribe_events_calendar_before_the_grid\', array(\'TribeEventsCategoryColorsPublic\', \'show_legend\'), 99);</code><br /><code>add_filter(\'tribe_events_calendar_filter_of_choice\', array(\'TribeEventsCategoryColorsPublic\', \'show_legend\'));</code></p><p>Obviously you will need to replace <i>tribe_events_calendar_filter_of_choice</i> with a real filter. Please refer to new TEC filter guide for options.</p>'
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
