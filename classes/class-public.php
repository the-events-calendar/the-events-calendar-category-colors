<?php
class Tribe_Events_Category_Colors_Public {

	const CSS_HANDLE = 'teccc_css';

	protected $teccc   = null;
	protected $options = array();
	private $query   = null;

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

		add_action( 'wp_enqueue_scripts', array( $this, 'add_scripts_styles' ), PHP_INT_MAX );
	}


	public function add_colored_categories( $query ) {
		if ( isset( $_GET[self::CSS_HANDLE] ) ) {
			$this->do_css();
		}

		// Show legend
		add_action( $this->legendTargetHook, array( $this, 'show_legend' ) );

		$this->query = $query;
		//$this->add_effects();
	}


	/**
	 * Enqueues scripts, legends, etc.
	 */
	public function add_effects() {
		// Enqueue stylesheet
		//add_action( 'wp_enqueue_scripts', array( $this, 'add_css' ), PHP_INT_MAX );

		// Show legend
		//add_action( $this->legendTargetHook, array( $this, 'show_legend' ) );

		// Add legend superpowers
		//if ( isset( $this->options['legend_superpowers'] ) && '1' === $this->options['legend_superpowers'] && ! wp_is_mobile() ) {
			//wp_enqueue_script( 'legend_superpowers', TECCC_RESOURCES . '/legend-superpowers.js', array( 'jquery' ), Tribe_Events_Category_Colors::$version, true );
		//}
	}

	public function add_scripts_styles() {
		// Register stylesheet
		wp_register_style( 'teccc_stylesheet', add_query_arg( self::CSS_HANDLE, $this->options_hash(), get_site_url( null ) ), false, Tribe_Events_Category_Colors::$version );

		$query = $this->query;
		$post_types = array( 'tribe_events', 'tribe_organizer', 'tribe_venue' );
		if ( isset( $query->query_vars['post_type'] ) && in_array( $query->query_vars['post_type'], $post_types, true ) ) {
			wp_enqueue_style( 'teccc_stylesheet' );
		}
		if ( isset( $this->options['color_widgets'] ) && '1' === $this->options['color_widgets'] ) {
			wp_enqueue_style( 'teccc_stylesheet' );
		}

		// Add legend superpowers
		if ( isset( $this->options['legend_superpowers'] ) && '1' === $this->options['legend_superpowers'] && ! wp_is_mobile() ) {
			wp_enqueue_script( 'legend_superpowers', TECCC_RESOURCES . '/legend-superpowers.js', array( 'jquery' ), Tribe_Events_Category_Colors::$version, true );
		}
	}

	/**
	 * By generating a unique hash of the plugin options if these change so will the
	 * stylesheet URL, forcing the browser to grab an updated copy.
	 *
	 * @return string
	 */
	protected function options_hash() {
		//remove $options['terms'] as it errors the join
		$options = $this->options;
		unset( $options['terms'] );

		return hash( 'md5', join( '|', (array) $options ) );
	}

	/**
	 * Enqueue the stylesheet.
	 */
	public function add_css() {
		//wp_enqueue_style( 'teccc_stylesheet', add_query_arg( self::CSS_HANDLE, $this->options_hash(), get_site_url( null ) ), false, Tribe_Events_Category_Colors::$version );
	}

	/**
	 * Create stylesheet.
	 */
	public function do_css() {
		// Use RFC 1123 date format for the expiry time
		$next_year = date( DateTime::RFC1123, strtotime( '+1 year', time() ) );
		$one_year  = 31536000;
		$hash      = $this->options_hash();

		header( "Content-type: text/css" );
		header( "Expires: $next_year" );
		header( "Cache-Control: public, max-age=$one_year" );
		header( "Pragma: public" );
		header( "Etag: $hash" );

		echo $this->generate_css();

		exit();
	}

	/**
	 * Create CSS for stylesheet
	 *
	 * @return mixed|string
	 */
	protected function generate_css() {
		// Look out for fresh_css requests
		$args = parse_url( $_SERVER['HTTP_REFERER'], PHP_URL_QUERY );
		$refresh_css = ( false !== strpos( $args, 'refresh_css' ) ) ? true : false;
		$refresh_css = ( $_GET['refresh_css'] ) ? true : false;


		// Return cached CSS if available and if fresh CSS hasn't been requested
		$cache_key = 'teccc_' . $this->options_hash();
		$css = get_transient( $cache_key );
		if ( ! empty( $css ) && ! $refresh_css ) {
			return $css;
		}

		// Else generate the CSS afresh
		ob_start();

		$this->teccc->view( 'category.css', array(
			'options' => $this->options,
			'teccc'   => $this->teccc
		) );

		$css = ob_get_clean();

		// Store in transient
		set_transient( $cache_key, $css, 4 * WEEK_IN_SECONDS );

		return $css;
	}

	/**
	 * Displays legend.
	 *
	 * @param string $existingContent
	 */
	public function show_legend( $existingContent = '' ) {
		$tribe         = TribeEvents::instance();
		$eventDisplays = array( 'month' );
		$eventDisplays = array_merge( $eventDisplays, $this->legendExtraView );
		$tribe_view    = get_query_var( 'eventDisplay' );
		if ( isset( $tribe->displaying ) && get_query_var( 'eventDisplay' ) !== $tribe->displaying ) {
			$tribe_view = $tribe->displaying;
		}
		if ( ( 'tribe_events' === get_query_var( 'post_type' ) ) && ! in_array( $tribe_view, $eventDisplays, true ) ) {
			return false;
		}
		if ( ! ( isset( $this->options['add_legend'] ) && '1' === $this->options['add_legend'] ) ) {
			return false;
		}

		$content = $this->teccc->view( 'legend', array(
			'options' => $this->options,
			'teccc'   => Tribe_Events_Category_Colors::instance(),
			'tec'     => TribeEvents::instance()
		), false );

		$this->legendFilterHasRun = true;
		echo $existingContent . apply_filters( 'teccc_legend_html', $content );
	}


	/**
	 * Move legend to different position.
	 *
	 * @param $tribeViewFilter
	 *
	 * @return bool
	 */
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


	/**
	 * Remove default legend.
	 *
	 * @return bool
	 */
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

	/**
	 * Add legend to additional views.
	 *
	 * @param $view
	 */
	public function add_legend_view( $view ) {
		//takes 'upcoming', 'day', 'week', 'photo' as parameters
		$this->legendExtraView[] = $view;
	}

}