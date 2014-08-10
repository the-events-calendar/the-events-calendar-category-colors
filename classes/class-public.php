<?php
class Tribe_Events_Category_Colors_Public {

	protected $teccc   = null;
	protected $options = array();

	protected $legendTargetHook   = 'tribe_events_after_header';
	protected $legendFilterHasRun = false;
	protected $legendExtraView    = array();


	public function __construct( Tribe_Events_Category_Colors $teccc ) {
		$this->teccc   = $teccc;
		$this->options = get_option( 'teccc_options' );
		require TECCC_INCLUDES . '/templatetags.php';
		require_once TECCC_CLASSES . '/class-widgets.php';
		require_once TECCC_CLASSES . '/class-extras.php';

		add_action( 'pre_get_posts', array( $this, 'add_colored_categories' ) );
	}


	public function add_colored_categories( $query ) {
		if ( ! isset( $query->query_vars['post_type'] ) ) {
			return false;
		}

		$post_types = array( 'tribe_events', 'tribe_organizer', 'tribe_venue' );
		if ( in_array( $query->query_vars['post_type'], $post_types, true ) ) {
			$this->add_effects();
		}
	}


	public function add_effects() {
		add_action( 'tribe_events_before_template', array( $this, 'add_css' ) );

		//For Events Calendar PRO only
		add_action( 'tribe_events_single_organizer_before_organizer', array( $this, 'add_css' ) );
		add_action( 'tribe_events_single_venue_before_the_meta', array( $this, 'add_css' ) );

		if ( isset( $this->options['color_widgets'] ) and '1' === $this->options['color_widgets'] ) {
			add_action( 'tribe_events_before_list_widget', array( $this, 'add_css' ) );
			add_action( 'tribe_events_mini_cal_after_the_grid', array( $this, 'add_css' ) );
			add_action( 'tribe_events_venue_widget_before_the_title', array( $this, 'add_css' ) );
		}
		add_action( $this->legendTargetHook, array( $this, 'show_legend' ) );
		
		if ( isset( $this->options['legend_superpowers'] ) and '1' === $this->options['legend_superpowers'] and ! wp_is_mobile() ) {
			wp_enqueue_script( 'legend_superpowers', TECCC_RESOURCES . '/legend-superpowers.js', array( 'jquery' ), Tribe_Events_Category_Colors::$version, true );
		}

	}


	public function add_css() {
		$this->teccc->view( 'category.css', array(
			'options' => $this->options,
			'teccc'   => $this->teccc
		) );

		remove_action( 'pre_get_posts', array( $this, 'add_colored_categories' ) );
	}


	public function show_legend( $existingContent = '' ) {
		$tribe         = TribeEvents::instance();
		$teccc_options = get_option( 'teccc_options' );
		$eventDisplays = array( 'month' );
		$eventDisplays = array_merge( $eventDisplays, $this->legendExtraView );
		$tribe_view    = get_query_var( 'eventDisplay' );
		if ( isset( $tribe->displaying ) && $tribe->displaying !== get_query_var( 'eventDisplay' ) ) {
			$tribe_view = $tribe->displaying;
		}
		if ( ( 'tribe_events' === get_query_var( 'post_type' ) ) and ! in_array( $tribe_view, $eventDisplays, true ) ) { return false; }
		if ( ! ( isset( $teccc_options['add_legend'] ) and '1' === $teccc_options['add_legend'] ) ) {
			return false;
		}

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
		if ( $this->legendFilterHasRun ) {
			_doing_it_wrong( 'Tribe_Events_Category_Colors_Public::reposition_legend',
			'You are attempting to reposition the legend after it has already been rendered.', '1.6.4' );
		}

		// Change the target filter (even if they are _doing_it_wrong, in case they have a special use case)
		$this->legendTargetHook = $tribeViewFilter;

		// Indicate if they were doing it wrong (or not)
		return ( ! $this->legendFilterHasRun );
	}


	public function remove_default_legend() {
		// If the legend has already run they are probably doing something wrong
		if( $this->legendFilterHasRun ) {
			_doing_it_wrong( 'Tribe_Events_Category_Colors_Public::reposition_legend',
			'You are attempting to remove the default legend after it has already been rendered.', '1.6.4' );
		}

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