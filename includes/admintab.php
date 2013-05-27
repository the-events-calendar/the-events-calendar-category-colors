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
			'html' => '<h2>'.__('Category Colors Settings', 'teccc').'</h2>'
		),
		'blurb' => array(
			'type' => 'html',
			'html' => '<p>'.__('The Events Calendar Category Colors plugin was inspired by the tutorial <a href="http://tri.be/coloring-your-category-events/">Coloring Your Category Events</a>.', 'teccc').'</p>'
		),
 		'legend' => array(
 			'type' => 'html',
 			'html' => '<p>'.__('The Category Colors legend is inserted using the new <i>tribe_events_calendar_before_the_grid</i> filter. To remove it from this default location and add it back using any of the new filters, add the following line to your theme\'s functions.php file.</p><p><code>teccc_reposition_legend( \'tribe_events_calendar_filter_of_choice\' );</code></p><p>Obviously you will need to replace <code>tribe_events_calendar_filter_of_choice</code> with a real filter. Please refer to new TEC filter guide for options.</p><p>If you want to make minor additions to the default Category Colors legend CSS you may add them by using the action hook <code>teccc_add_legend_css</code> in your theme\'s functions.php file.</p><p><code>add_action( \'teccc_add_legend_css\', \'my_extra_legend_css\' );</code>', 'teccc').'</p>'
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
			'html' => '<p class="submit"><input type="submit" class="button-primary" value="' . __('Save Changes', 'teccc') . '" /></p>'
		)
	)
);
