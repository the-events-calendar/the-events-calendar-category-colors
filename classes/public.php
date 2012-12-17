<?php
class TribeEventsCategoryColorsPublic {
	protected $teccc = null;
	protected $options = array();


	public function __construct(TribeEventsCategoryColors $teccc) {
		$this->teccc = $teccc;
		$this->options = get_option('teccc_options');

		require_once TECCC_INCLUDES.'/templatetags.php';

		add_action('pre_get_posts', array($this, 'add_colored_categories'));
		add_filter('post_class', array($this, 'remove_tribe_cat_once'), 1);
	}


	public function add_colored_categories($query) {
		if ($query->query_vars['post_type'] == 'tribe_events')
			if ($query->query_vars['eventDisplay'] == 'month')
				$this->add_effects();
	}


	public function add_effects() {
		add_action('wp_head', array($this, 'add_css'));

		if (isset($this->options['add_legend']) and $this->options['add_legend'] === '1')
			add_action('teccc_legend_hook', array($this, 'legend_implementation'));

		if (isset($this->options['legend_superpowers']) and $this->options['legend_superpowers'] === '1') {
			wp_enqueue_script('jquery');
			add_action('wp_footer', array($this, 'add_superpower_logic'));
		}
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


	public function add_superpower_logic() {
		echo '<script type="text/javascript" src="'
			.TECCC_RESOURCES.'/legend-superpowers.js'
			.'"></script>"';
	}


	/**
	 * Removes the Tribe post_class filter on the first occasion that filter is
	 * used, then sets it up again for future calls.
	 *
	 * @todo Improve efficacy by detecting the start and end of Tribe templates, if possible
	 *
	 * @param array $classes
	 * @return array
	 */
	public function remove_tribe_cat_once(array $classes) {
		$options = get_option('teccc_options');

		if( tribe_is_month() && !is_tax() ) { // The Main Calendar Page
			//insert only if needed
			if ( ! $options['calendar_colored'] ) { return $classes; }
			static $count = 0;
			if ($count++ === 0) {
				remove_filter('post_class', array(TribeEvents::instance(), 'post_class'));
			}
			else {
				add_filter('post_class', array(TribeEvents::instance(), 'post_class'));
				remove_filter('post_class', array($this, 'remove_tribe_cat_once'));
			}
		}

		return $classes;
	}
}