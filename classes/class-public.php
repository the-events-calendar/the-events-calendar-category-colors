<?php
class Tribe_Events_Category_Colors_Public {

	protected $teccc = null;
	protected $options = array();

	protected $legendTargetHook = 'tribe_events_after_header';
	protected $legendFilterHasRun = false;
	protected $legendExtraView = array();


	public function __construct( Tribe_Events_Category_Colors $teccc ) {
		$this->teccc = $teccc;
		$this->options = get_option( 'teccc_options' );
		require TECCC_INCLUDES . '/templatetags.php';
		require_once TECCC_CLASSES . '/class-widgets.php';
		require_once TECCC_CLASSES . '/class-extras.php';

		add_action( 'pre_get_posts', array( $this, 'add_colored_categories' ) );
	}


	public function add_colored_categories( $query ) {
		if ( ! isset( $query->query_vars['post_type'] ) or ! isset( $query->query_vars['eventDisplay'] ) ) return;

		$eventDisplays = array( 'month', 'upcoming', 'day', 'photo', 'week', 'all', 'agenda' );

		if ( $query->query_vars['post_type'] === 'tribe_events' and in_array( $query->query_vars['eventDisplay'], $eventDisplays, true ) ) {
			$this->add_effects();
		}
	}


	public function add_effects() {
		add_action( 'wp_head', array( $this, 'add_css' ) );
		add_action( 'tribe_before_widget', array( $this, 'add_css' ) );
		add_action( $this->legendTargetHook, array( $this, 'show_legend' ) );
		
		if ( isset( $this->options['legend_superpowers'] ) and $this->options['legend_superpowers'] === '1' )
			wp_enqueue_script( 'legend_superpowers', TECCC_RESOURCES . '/legend-superpowers.js', array( 'jquery' ), Tribe_Events_Category_Colors::VERSION, true );

	}


	public function add_css() {
		$this->teccc->view( 'category.css', array(
			'options' => $this->options,
			'teccc'   => $this->teccc
		) );

		remove_action( 'pre_get_posts', array( $this, 'add_colored_categories' ) );
	}


	public function show_legend( $existingContent = '' ) {
		$teccc_options = get_option( 'teccc_options' );
		$eventDisplays = array( 'month' );
		$eventDisplays = array_merge( $eventDisplays, $this->legendExtraView );
		if ( ( get_query_var( 'post_type' ) === 'tribe_events' ) and !in_array( get_query_var( 'eventDisplay' ), $eventDisplays, true ) ) return;
		if ( ! ( isset( $teccc_options['add_legend'] ) and $teccc_options['add_legend'] === '1') ) return;
		
		$content = $this->teccc->view( 'legend', array(
			'options' => $teccc_options,
			'teccc'   => Tribe_Events_Category_Colors::instance(),
			'tec'     => TribeEvents::instance()
		), false );

		$this->legendFilterHasRun = true;
		echo $existingContent . apply_filters( 'teccc_legend_html', $content );
	}


	public function reposition_legend( $tribeViewFilter ) {
		// If the legend has already run they are probably doing something wrong
		if ( $this->legendFilterHasRun ) _doing_it_wrong( 'Tribe_Events_Category_Colors_Public::reposition_legend',
			'You are attempting to reposition the legend after it has already been rendered.', '1.6.4' );

		// Change the target filter (even if they are _doing_it_wrong, in case they have a special use case)
		$this->legendTargetHook = $tribeViewFilter;

		// Indicate if they were doing it wrong (or not)
		return ( ! $this->legendFilterHasRun );
	}


	public function remove_default_legend() {
		// If the legend has already run they are probably doing something wrong
		if( $this->legendFilterHasRun ) _doing_it_wrong( 'Tribe_Events_Category_Colors_Public::reposition_legend',
			'You are attempting to remove the default legend after it has already been rendered.', '1.6.4' );

		// Remove the hook regardless of whether they are _doing_it_wrong or not (in case of creative usage)
		$this->legendTargetHook = null;

		// Indicate if they were doing it wrong (or not)
		return ( ! $this->legendFilterHasRun );
	}
	
	public function add_legend_view( $view ) {
		//takes 'upcoming', 'day', 'week', 'photo' as parameters
		$this->legendExtraView[] = $view;
	}

}