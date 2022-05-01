<?php

namespace Fragen\Category_Colors;

/**
 * Class Frontend
 *
 * @package Fragen\Category_Colors
 */
class Frontend {
	protected $teccc     = null;
	protected $options   = [];
	protected $cache_key = null;
	protected $uploads   = null;

	protected $legendTargetHook   = 'tribe_events_after_header';
	protected $legendFilterHasRun = false;
	protected $legendExtraView    = [ 'month' ];
	public $currentDisplay        = null;

	public function __construct( Main $teccc ) {
		$this->teccc   = $teccc;
		$this->options = Admin::fetch_options( $teccc );

		require_once $teccc->functions_dir . '/templatetags.php';
		$this->uploads = wp_upload_dir();
	}

	/**
	 * Load hooks and generate CSS.
	 *
	 * @return void
	 */
	public function run() {
		add_action( 'parse_query', [ $this, 'get_current_event_display' ] );
		add_action( $this->legendTargetHook, [ $this, 'show_legend' ] );
		add_action( 'tribe_template_before_include', [ $this, 'set_legend_target_hook' ], 10, 3 );
		add_action( 'wp_enqueue_scripts', [ $this, 'add_scripts_styles' ], PHP_INT_MAX - 100 );
	}

	/**
	 * Get current event display from `parse_query` filter.
	 *
	 * @param \WP_Query $query
	 *
	 * @return void
	 */
	public function get_current_event_display( \WP_Query $query ) {
		if ( isset( $query->query_vars['eventDisplay'] ) ) {
			$this->currentDisplay = $query->query_vars['eventDisplay'];
		}
	}

	/**
	 * Set legend target hook.
	 *
	 * @param string                          $file     File path.
	 * @param array                           $name     Array of view data.
	 * @param \Tribe\Events\Views\V2\Template $template Template object.
	 *
	 * @return bool|void
	 */
	public function set_legend_target_hook( $file, $name, $template ) {
		if ( ! $template instanceof \Tribe\Events\Views\V2\Template ) {
			return false;
		}
		$this->currentDisplay = $template->get_view()->get_slug();
		$hook_name            = false;
		if ( ! in_array( $this->currentDisplay, $this->legendExtraView, true ) ) {
			return false;
		}
		switch ( $this->currentDisplay ) {
			case 'month':
				$hook_name = 'events/v2/month/top-bar';
				break;
			case 'list':
				$hook_name = 'events/v2/list/top-bar';
				break;
			case 'day':
				$hook_name = 'events/v2/day/top-bar';
				break;
			case 'photo':
				$hook_name = 'events-pro/v2/photo/top-bar';
				break;
			case 'week':
				$hook_name = 'events-pro/v2/week/top-bar';
				break;
			case 'map':
				$hook_name = 'events-pro/v2/map/top-bar';
				break;
			case 'summary':
				$hook_name = 'events-pro/v2/summary/top-bar';
				break;
		}
		if ( $hook_name ) {
			$this->legendTargetHook = "tribe_template_before_include:{$hook_name}";
			add_action( $this->legendTargetHook, [ $this, 'show_legend' ] );
		}
	}

	/**
	 * Enqueue stylesheets and scripts as appropriate.
	 */
	public function add_scripts_styles() {
		wp_register_style( 'teccc-nofile-stylesheet', false );
		wp_enqueue_style( 'teccc-nofile-stylesheet' );
		wp_add_inline_style( 'teccc-nofile-stylesheet', $this->generate_css() );

		// Optionally add legend superpowers
		if ( isset( $this->options['legend_superpowers'] ) &&
			'1' === $this->options['legend_superpowers'] &&
			! wp_is_mobile()
		) {
			wp_register_script( 'legend_superpowers', $this->teccc->resources_url . '/legend-superpowers.js', [ 'jquery' ], Main::$version, true );
			wp_enqueue_script( 'legend_superpowers' );
		}
	}

	/**
	 * Create CSS for stylesheet, standard and minified.
	 *
	 * @return mixed|string
	 */
	public function generate_css() {
		// TODO: remove after a couple of updates.
		$css_dir = apply_filters( 'teccc_uploads_dir', $this->uploads['basedir'] );
		$css_dir = untrailingslashit( $css_dir );
		foreach ( glob( "{$css_dir}/teccc*.css" ) as $file ) {
			if ( file_exists( $file ) ) {
				unlink( $file );
			}
		}

		$refresh = isset( $_GET['refresh_css'] );
		$cache   = get_option( 'teccc_css' );

		// Return if cache not expired.
		if ( ! $refresh && time() < $cache['timeout'] ) {
				return $cache['css'];
		}

		// Else generate the CSS afresh.
		$css = $this->teccc->view(
			'category.css',
			[
				'options' => $this->options,
				'teccc'   => $this->teccc,
			],
			false
		);
		if ( ! $css ) {
			return false;
		}
		$css_min = $this->minify_css( $css );

		$css_data = [
			'timeout' => strtotime( '+4 weeks' ),
			'css'     => $css,
		];

		update_option( 'teccc_css', $css_data, false );

		return $css;
	}

	/**
	 * Minify CSS.
	 *
	 * Removes comments, spaces after commas and colons, spaces around braces, and reduce whitespace.
	 *
	 * @link https://gist.github.com/manastungare/2625128
	 *
	 * @param  string $css
	 * @return string $css Minified CSS.
	 */
	private function minify_css( $css ) {
		/**
		 * 1. Remove comments.
		 * 2. Remove tabs and line breaks.
		 * 3. Remove space after colons.
		 * 4. Remove space around braces and commas.
		 * 5. Reduce multiple spaces to single space.
		 */
		// $css = preg_replace( '!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css );
		$css = preg_replace( "/[\n\r\t]/", '', $css );
		$css = str_replace( ': ', ':', $css );
		$css = preg_replace( '/\s?(,|{|})\s?/', '$1', $css );
		$css = preg_replace( '/ {2,}/', ' ', $css );

		return $css;
	}

	/**
	 * Displays legend.
	 *
	 * @return bool|string
	 */
	public function show_legend() {
		$v2_viewable   = false !== strpos( $this->legendTargetHook, $this->currentDisplay );
		$is_extra_view = in_array( $this->currentDisplay, $this->legendExtraView, true );

		if ( ! $v2_viewable && ! $is_extra_view ) {
			return false;
		}
		if ( $this->legendFilterHasRun ) {
			return false;
		}

		if (
			! isset( $this->options['add_legend'] )
			|| null === $this->options['add_legend']
			|| ! in_array( $this->currentDisplay, $this->options['add_legend'], true )
		) {
			return false;
		}

		$content = $this->teccc->view(
			'legend',
			[
				'options' => $this->options,
				'teccc'   => $this->teccc,
				'view'    => $this->currentDisplay,
			],
			false
		);

		$this->legendFilterHasRun = true;

		/**
		 * Filter legend html to return modified version.
		 * Useful for appending text to legend.
		 *
		 * @return string $content
		 */
		echo apply_filters( 'teccc_legend_html', $content );
	}

	/**
	 * Move legend to different position.
	 *
	 * @deprecated 6.8.4.3
	 * @param $tribeViewFilter
	 *
	 * @return bool
	 */
	public function reposition_legend( $tribeViewFilter ) {
		// If the legend has already run they are probably doing something wrong.
		if ( $this->legendFilterHasRun ) {
			_doing_it_wrong(
				__CLASS__ . '::' . __METHOD__,
				'You are attempting to reposition the legend after it has already been rendered.',
				'1.6.4'
			);
		}

		// Change the target filter (even if they are _doing_it_wrong, in case they have a special use case).
		$this->legendTargetHook = $tribeViewFilter;

		// Indicate if they were doing it wrong (or not).
		return ! $this->legendFilterHasRun;
	}

	/**
	 * Remove default legend.
	 *
	 * @deprecated 6.8.4.3
	 *
	 * @return bool
	 */
	public function remove_default_legend() {
		// If the legend has already run they are probably doing something wrong.
		if ( $this->legendFilterHasRun ) {
			_doing_it_wrong(
				__CLASS__ . '::' . __METHOD__,
				'You are attempting to remove the default legend after it has already been rendered.',
				'1.6.4'
			);
		}

		// Remove the hook regardless of whether they are _doing_it_wrong or not (in case of creative usage).
		$this->legendTargetHook = null;

		// Indicate if they were doing it wrong (or not).
		return ! $this->legendFilterHasRun;
	}

	/**
	 * Add legend to additional views.
	 *
	 * @param $view
	 */
	public function add_legend_view( $view ) {
		// 'list', 'day', 'week', 'photo', 'map' as parameters.
		$this->legendExtraView[] = $view;
	}
}
