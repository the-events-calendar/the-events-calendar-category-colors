<?php
/**
 * The Events Calendar: Category Colors
 *
 * @author   Andy Fragen
 * @license  MIT
 * @link     https://github.com/afragen/the-events-calendar-category-colors
 * @package  the-events-calendar-category-colors
 */

namespace Fragen\Category_Colors;

use Tribe__Events__Main;

/**
 * Class Main
 */
class Main {
	const SLUG = 0;
	const NAME = 1;

	/**
	 * Variable
	 *
	 * @var string
	 */
	public static $version;

	/**
	 * Variable
	 *
	 * @var string
	 */
	public $functions_dir;

	/**
	 * Variable
	 *
	 * @var string
	 */
	public $views_dir;

	/**
	 * Variable
	 *
	 * @var string
	 */
	public $resources_url;

	/**
	 * Variable
	 *
	 * @var array
	 */
	public $text_colors = [
		'Default' => 'no_color',
		'Black'   => '#000',
		'White'   => '#fff',
		'Gray'    => '#999',
	];

	/**
	 * Variable
	 *
	 * @var array
	 */
	public $font_weights = [
		'Bold'   => 'bold',
		'Normal' => 'normal',
	];

	/**
	 * Variable
	 *
	 * @var array
	 */
	public $terms = [];

	/**
	 * Variable
	 *
	 * @var array
	 */
	public $all_terms = [];

	/**
	 * Variable
	 *
	 * @var array
	 */
	public $ignored_terms = [];

	/**
	 * Counter
	 *
	 * @var int
	 */
	public $count = 0;

	/**
	 * Category IDs (ints) and slugs (strings) to ignore.
	 *
	 * @var array
	 */
	public $ignore_list = [];

	/**
	 * Variable
	 *
	 * @var Frontend
	 */
	public $public;

	/**
	 * Variable
	 *
	 * @var bool
	 */
	protected static $object = false;

	/**
	 * The Main object can be created/obtained via this
	 * method - this prevents unnecessary work in rebuilding the object and
	 * querying to construct a list of categories, etc.
	 *
	 * @return bool|object Main
	 */
	public static function instance() {
		$class = __CLASS__;
		if ( false === self::$object ) {
			self::$object = new $class();
		}

		return self::$object;
	}

	/**
	 * Main constructor.
	 */
	public function __construct() {
		$this->functions_dir = TECCC_DIR . '/src/functions';
		$this->views_dir     = TECCC_DIR . '/src/views';
		$this->resources_url = plugin_dir_url( TECCC_FILE ) . 'src/resources';
		self::$version       = self::get_plugin_version( TECCC_FILE );
	}

	/**
	 * Let's get going.
	 *
	 * @return void
	 */
	public function run() {
		// We need to wait until the taxonomy has been registered before building our list.
		add_action( 'init', [ $this, 'load_categories' ], 20 );

		if ( ( ! defined( 'DOING_AJAX' ) ) && is_admin() ) {
			( new Admin( $this ) )->load_hooks();
		}

		$this->public = new Frontend( $this );
		$this->public->run();

		add_action( 'init', [ $this, 'show_legend_on_views' ] );
		add_action( 'update_option_teccc_options', [ $this->public, 'generate_css_on_update_option' ] );
	}

	/**
	 * Add legend on the selected views.
	 */
	public function show_legend_on_views() {
		$options = get_option( 'teccc_options' );

		if ( ! isset( $options['add_legend'] ) ) {
			return;
		}

		$views = [
			'list',
			'month',
			'day',
			'week',
			'photo',
			'map',
			'summary',
		];

		if ( ! is_array( $options['add_legend'] ) ) {
			$options = $this->update_view_options( $views, $options );
		}

		foreach ( $views as $view ) {
			if ( in_array( $view, (array) $options['add_legend'], true ) ) {
				teccc_add_legend_view( $view );
			}
		}
	}

	/**
	 * Load categories.
	 */
	public function load_categories() {
		add_filter( 'teccc_get_terms', [ $this, 'remove_terms' ] );
		$this->get_category_terms();
		$this->count = count( $this->terms );
	}

	/**
	 * Get category terms.
	 *
	 * @return bool
	 */
	protected function get_category_terms() {
		if ( ! empty( $this->terms ) ) {
			return false;
		}

		$options   = get_option( 'teccc_options' );
		$all_terms = get_terms( Tribe__Events__Main::TAXONOMY, [ 'hide_empty' => false ] );

		/**
		 * Add and remove terms via filters.
		 * Should help with WPML.
		 */
		$options = $this->add_terms( $options );
		$this->delete_terms( $all_terms );

		$terms = apply_filters( 'teccc_get_terms', $all_terms );

		/**
		 * Populate public variables.
		 * Represent each term as an array [slug, name] indexed by term ID
		 */
		$term_lists = [
			'all_terms' => &$all_terms,
			'terms'     => &$terms,
		];
		foreach ( $term_lists as $list => $arr ) {
			foreach ( $arr as $term ) {
				$this->{$list}[ $term->term_id ] = [ $term->slug, preg_replace( '/\s/', '&nbsp;', $term->name ) ];
			}
		}

		$this->ignored_terms = $this->get_ignored_terms( $this->ignore_list );

		$options['terms']     = $this->terms;
		$options['all_terms'] = $this->all_terms;
		update_option( 'teccc_options', $options );
	}

	/**
	 * Create array of ignored terms from $ignore_list.
	 *
	 * @param  array $ignore_list   Array of terms to ignore.
	 * @return array $ignored_terms Array of terms to ignore.
	 */
	public function get_ignored_terms( $ignore_list ) {
		$ignored_terms = [];
		if ( ! empty( $ignore_list ) ) {
			foreach ( $ignore_list as $ignored ) {
				$name = ucwords( str_replace( '-', ' ', $ignored ) );
				if ( ! empty( $name ) ) {
					$ignored_terms[] = [ $ignored, preg_replace( '/\s/', '&nbsp;', $name ) ];
				}
			}
		}

		return $ignored_terms;
	}

	/**
	 * Setup missing term data in Main.
	 *
	 * @param  array $options Array of options.
	 * @return void
	 */
	public function setup_terms( $options ) {
		$this->all_terms = ! empty( $this->all_terms ) ? $this->all_terms : $options['all_terms'];
		$hide            = isset( $options['hide'] ) ? $options['hide'] : [];
		if ( empty( $this->ignore_list ) ) {
			$this->ignore_list = array_merge( $this->ignore_list, (array) $hide );
			$this->ignore_list = array_unique( $this->ignore_list );
		}
		$this->ignored_terms = ! empty( $this->ignored_terms )
		? $this->ignored_terms
		: $this->get_ignored_terms( $this->ignore_list );
	}

	/**
	 * Add category terms via filter.
	 *
	 * @param array $options TECCC options.
	 *
	 * @return array
	 */
	public function add_terms( $options ) {
		$args      = [];
		$add_terms = apply_filters( 'teccc_add_terms', [] );
		foreach ( (array) $add_terms as $add_term ) {
			$args['name'] = ucwords( str_replace( '-', ' ', $add_term ) );
			$args['slug'] = $add_term;
			if ( ! term_exists( $args['name'], Tribe__Events__Main::TAXONOMY ) ) {
				wp_insert_term( $args['name'], Tribe__Events__Main::TAXONOMY, $args );
				$options[ $add_term . '-text' ]       = '#000';
				$options[ $add_term . '-background' ] = '#CFCFCF';
				$options[ $add_term . '-border' ]     = '#CFCFCF';
			}
		}

		return $options;
	}

	/**
	 * Delete category terms via filter.
	 *
	 * @param array $all_terms Array of terms.
	 */
	public function delete_terms( $all_terms ) {
		$delete_terms = apply_filters( 'teccc_delete_terms', [] );
		foreach ( (array) $delete_terms as $delete_term ) {
			foreach ( (array) $all_terms as $term ) {
				if ( $delete_term === $term->slug ) {
					wp_delete_term( $term->term_id, Tribe__Events__Main::TAXONOMY );
					break;
				}
			}
		}
	}

	/**
	 * Removes terms on the ignore list from the list of terms recognised by the plugin.
	 *
	 * @param arrat $term_list Array of terms.
	 *
	 * @return array
	 */
	public function remove_terms( $term_list ) {
		$options      = get_option( 'teccc_options' );
		$revised_list = [];

		if ( ! isset( $options['hide'] ) ) {
			$options['hide'] = [];
		}

		$this->ignore_list = array_merge( $this->ignore_list, (array) $options['hide'] );
		$this->ignore_list = array_unique( $this->ignore_list );

		foreach ( (array) $term_list as $src_id => $src_term ) {
			if ( in_array( (int) $src_term->term_id, $this->ignore_list, true ) ) {
				continue;
			}
			if ( in_array( (string) $src_term->slug, $this->ignore_list, true ) ) {
				continue;
			}
			$revised_list[ $src_id ] = $src_term;
		}

		return $revised_list;
	}

	/**
	 * Loads and returns the requested configuration array.
	 *
	 * @param string $file File name.
	 *
	 * @return array
	 */
	public function load_config( $file ) {
		$config = $this->load_config_array_file( $file );

		return (array) apply_filters( "teccc_config_{$file}", $config );
	}

	/**
	 * Loads and returns an array of settings.
	 *
	 * Maps to "{plugin_dir}/includes/$file.php" - the file itself is expected
	 * to solely contain a PHP array definition.
	 *
	 * @param string $file File name.
	 *
	 * @return array
	 */
	protected function load_config_array_file( $file ) {
		$path = $this->functions_dir . "/{$file}.php";
		if ( ! file_exists( $path ) ) {
			return [];
		}

		return (array) include $path;
	}

	/**
	 * Loads the specified view.
	 *
	 * The child theme/theme's directories are scanned first - so any view loaded through
	 * this method can be overridden if a copy exists in a tribe-events/teccc/* folder within
	 * the theme. Otherwise, the view is loaded from the plugin's own view directory.
	 *
	 * If the optional array of $vars are supplied they will be extracted and
	 * pulled into the same scope as the template.
	 *
	 * @param string $template Name of template.
	 * @param array  $vars     Array of variables.
	 * @param bool   $render   Bool to render.
	 *
	 * @return mixed
	 */
	public function view( $template, array $vars = [], $render = true ) {
		$path = locate_template( "tribe-events/teccc/{$template}.php" );
		if ( empty( $path ) ) {
			$path = $this->views_dir . "/{$template}.php";
		}

		if ( ! file_exists( $path ) ) {
			return false;
		}
		if ( ! empty( $vars ) ) {
			// phpcs:ignore WordPress.PHP.DontExtract.extract_extract
			extract( $vars, EXTR_OVERWRITE );
		}

		if ( ! $render ) {
			ob_start();
		}
		include $path;
		if ( ! $render ) {
			return ob_get_clean();
		}
	}

	/**
	 * Expected to run on activation; populates the default options.
	 */
	public static function add_defaults() {
		$teccc = self::instance();
		$tmp   = get_option( 'teccc_options' );

		if ( ! isset( $tmp['chk_default_options_db'] ) ) {
			return false;
		}
		if ( '1' === $tmp['chk_default_options_db'] || ! is_array( $tmp ) ) {
			delete_option( 'teccc_options' );
			for ( $i = 0; $i < $teccc->count; $i++ ) {
				$arr[ $teccc->slugs[ $i ] . '-text' ]       = '#000';
				$arr[ $teccc->slugs[ $i ] . '-background' ] = '#CFCFCF';
				$arr[ $teccc->slugs[ $i ] . '-border' ]     = '#CFCFCF';
			}
			$arr['font_weight']    = 'bold';
			$arr['featured-event'] = '#0ea0d7';
			update_option( 'teccc_options', $arr );
		}
	}

	/**
	 * Returns current plugin version.
	 *
	 * @param string $file Path to main plugin file.
	 *
	 * @return string
	 */
	public static function get_plugin_version( $file ) {
		if ( ! function_exists( 'get_plugin_data' ) ) {
			require_once ABSPATH . 'wp-admin/includes/plugin.php';
		}
		$plugin_data = \get_plugin_data( $file );

		return $plugin_data['Version'];
	}

	/**
	 * Are the v2 views active.
	 *
	 * @return bool
	 */
	public static function is_v2_active() {
		return function_exists( 'tribe_events_views_v2_is_enabled' ) && \tribe_events_views_v2_is_enabled();
	}

	/**
	 * Update the view options from single options to array
	 *
	 * @param array $views   Array of views.
	 * @param array $options Array of options.
	 *
	 * @return array
	 */
	private function update_view_options( $views, $options ) {
		if ( ! is_array( $options['add_legend'] ) ) {
			$transfer[] = 'month';

			foreach ( $views as $view ) {
				if ( ! empty( $options[ "add_legend_{$view}_view" ] ) ) {
					$transfer[] = $view;
				}
			}
			$options['add_legend'] = $transfer;
		}

		update_option( 'teccc_options', $options );

		return $options;
	}
}
