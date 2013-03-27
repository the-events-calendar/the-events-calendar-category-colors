<?php
class TribeEventsCategoryColorsPublic {
	protected $teccc = null;
	protected $options = array();

	public function __construct(TribeEventsCategoryColors $teccc) {
		$this->teccc = $teccc;
		$this->options = get_option('teccc_options');

		add_action('pre_get_posts', array($this, 'add_colored_categories'));
	}


	public function add_colored_categories($query) {
		if (isset($query->query_vars['post_type']) and $query->query_vars['post_type'] == 'tribe_events')
			if (isset($query->query_vars['eventDisplay']) and $query->query_vars['eventDisplay'] == 'month')
				$this->add_effects();
	}


	public function add_effects() {
		add_action('wp_head', array($this, 'add_css'));
		add_filter('tribe_events_calendar_before_the_grid', array($this, 'show_legend'));
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


	public function show_legend() {
		//Needs to work both inside and outside of class
		$teccc_options = get_option('teccc_options');
		if (!(isset($teccc_options['add_legend']) and $teccc_options['add_legend'] === '1')) { return; }
		
		$content = TribeEventsCategoryColors::view('legend', array(
			'options' => $teccc_options,
			'teccc' => TribeEventsCategoryColors::instance(),
			'tec' => TribeEvents::instance()
			));

		return $content;
	}

	public function remove_default_legend() {
		echo ">>>remove_default_legend";
		remove_filter( 'tribe_events_calendar_before_the_grid', array($this, 'show_legend'));
	}
		
	public function remove_default_legend2() {
		add_action('teccc_legend', array($this, 'remove_legend'));
	}

}