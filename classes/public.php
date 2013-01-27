<?php
class TribeEventsCategoryColorsPublic {
	protected $teccc = null;
	protected $options = array();


	public function __construct(TribeEventsCategoryColors $teccc) {
		$this->teccc = $teccc;
		$this->options = get_option('teccc_options');

		require_once TECCC_INCLUDES.'/templatetags.php';

		add_action('pre_get_posts', array($this, 'add_colored_categories'));
	}


	public function add_colored_categories($query) {
		if (isset($query->query_vars['post_type']) and $query->query_vars['post_type'] == 'tribe_events')
			if (isset($query->query_vars['eventDisplay']) and $query->query_vars['eventDisplay'] == 'month')
				$this->add_effects();
	}


	public function add_effects() {
		add_action('wp_head', array($this, 'add_css'));

		//if (isset($this->options['add_legend']) and $this->options['add_legend'] === '1')
			add_filter('tribe_events_calendar_before_the_grid', array($this, 'show_legend'));

		if (isset($this->options['legend_superpowers']) and $this->options['legend_superpowers'] === '1')
			wp_enqueue_script('legend_superpowers', TECCC_RESOURCES.'/legend-superpowers.js', array(jquery), TribeEventsCategoryColors::VERSION, true );

	}


	public function add_css() {
		$this->teccc->view('category.css', array(
			'options' => $this->options,
			'teccc' => $this->teccc
		));
	}


	public function legend_implementation() {
		if (isset($this->options['legend_superpowers']) and $this->options['legend_superpowers'] === '1')
			$legend = true;

		$this->teccc->view('legend', array(
			'tec' => TribeEvents::instance(),
			'teccc' => $this->teccc,
			'legendData' => isset($legend) ? true : false
		));
	}

	
	public static function show_legend() {
		$teccc = TribeEventsCategoryColors::instance();
		$tec = TribeEvents::instance();
		$teccc->options = get_option('teccc_options');
		
		$content = $teccc->view('legend', array(
			'options' => (array) get_option('teccc_options', array()),
			'teccc' => $teccc,
			'tec' => $tec
			), false);

		if (isset($teccc->options['add_legend']) and $teccc->options['add_legend'] === '1')
			return $content;
	}

}