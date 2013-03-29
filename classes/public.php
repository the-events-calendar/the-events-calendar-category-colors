<?php
class TribeEventsCategoryColorsPublic {
	protected $teccc = null;
	protected $options = array();

	protected $legendTargetFilter = 'tribe_events_calendar_before_the_grid';
	protected $legendFilterHasRun = false;


	public function __construct(TribeEventsCategoryColors $teccc) {
		$this->teccc = $teccc;
		$this->options = get_option('teccc_options');
		require TECCC_INCLUDES.'/templatetags.php';

		add_action('pre_get_posts', array($this, 'add_colored_categories'));
	}


	public function add_colored_categories($query) {
		$eventDisplays = array('month', 'upcoming', 'day', 'photo');
		if (isset($query->query_vars['post_type']) and $query->query_vars['post_type'] == 'tribe_events')
			if (isset($query->query_vars['eventDisplay']) and in_array($query->query_vars['eventDisplay'], $eventDisplays))
				$this->add_effects();
	}


	public function add_effects() {
		add_action('wp_head', array($this, 'add_css'));
		add_filter($this->legendTargetFilter, array($this, 'show_legend'));
		do_action('teccc_legend');
		
		if (isset($this->options['legend_superpowers']) and $this->options['legend_superpowers'] === '1')
			wp_enqueue_script('legend_superpowers', TECCC_RESOURCES.'/legend-superpowers.js', array(jquery), TribeEventsCategoryColors::VERSION, true );

	}


	public function add_css() {
		$this->teccc->view('category.css', array(
			'options' => $this->options,
			'teccc' => $this->teccc
		));
	}


	public function show_legend($existingContent = '') {
		//Needs to work both inside and outside of class
		$teccc_options = get_option('teccc_options');
		if (!(isset($teccc_options['add_legend']) and $teccc_options['add_legend'] === '1')) { return; }
		
		$content = $this->teccc->view('legend', array(
			'options' => $teccc_options,
			'teccc' => TribeEventsCategoryColors::instance(),
			'tec' => TribeEvents::instance()
		));

		$this->legendFilterHasRun = true;
		return $existingContent.$content;
	}


	public function reposition_legend($tribeViewFilter) {
		// If the legend has already run they are probably doing something wrong
		if ($this->legendFilterHasRun) _doing_it_wrong('TribeEventsCategoryColorsPublic::reposition_legend',
			'You are attempting to reposition the legend after it has already been rendered.', '1.6.4');

		// Change the target filter (even if they are _doing_it_wrong, in case they have a special use case)
		$this->legendTargetFilter = $tribeViewFilter;

		// Indicate if they were doing it wrong (or not)
		return (!$this->legendFilterHasRun);
	}


	public function remove_default_legend() {
		// If the legend has already run they are probably doing something wrong
		if ($this->legendFilterHasRun) _doing_it_wrong('TribeEventsCategoryColorsPublic::reposition_legend',
			'You are attempting to remove the default legend after it has already been rendered.', '1.6.4');

		// Remove the hook regardless of whether they are _doing_it_wrong or not (in case of creative usage)
		$this->legendTargetFilter = null;

		// Indicate if they were doing it wrong (or not)
		return (!$this->legendFilterHasRun);
	}
}