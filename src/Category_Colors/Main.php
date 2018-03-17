<?php

namespace Fragen\Category_Colors;

/**
 * Class Main
 *
 * @package Fragen\Category_Colors
 */
class Main {

	const SLUG = 0;
	const NAME = 1;

	public static $version;

	public $text_colors = array(
		'Default' => 'no_color',
		'Black'   => '#000',
		'White'   => '#fff',
		'Gray'    => '#999',
	);

	public $font_weights = array(
		'Bold'   => 'bold',
		'Normal' => 'normal',
	);

	/**
	 * Contains each term in an array structured as follows:
	 *
	 *    [ id => [ slug, name ], ... ]
	 *
	 * @var array
	 */
	public $terms = array();
	public $all_terms = array();
	public $ignored_terms = array();
	public $count = 0;

	/**
	 * Category IDs (ints) and slugs (strings) to ignore.
	 *
	 * @var array
	 */
	public $ignore_list = array();

	/**
	 * @var Frontend
	 */
	public $public;

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
	protected function __construct() {
		// We need to wait until the taxonomy has been registered before building our list
		add_action( 'init', array( $this, 'load_categories' ), 20 );

		if ( ( ! defined( 'DOING_AJAX' ) ) && is_admin() ) {
			new Admin( $this );
		}

		self::$version = self::plugin_get_version( TECCC_FILE );
		$this->public  = new Frontend( $this );
	}

	/**
	 * Load categories.
	 */
	public function load_categories() {
		add_filter( 'teccc_get_terms', array( $this, 'remove_terms' ) );
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

		/**
		 * Tribe__Events__Main not yet defined, so we can't use the class constant
		 */
		$all_terms = get_terms( 'tribe_events_cat', array( 'hide_empty' => false ) );
		$terms     = apply_filters( 'teccc_get_terms', $all_terms );

		/**
		 * Add and remove terms via filters.
		 * Should help with WPML.
		 */
		$this->add_terms();
		$this->delete_terms( $all_terms );

		/**
		 * Populate public variables.
		 * Represent each term as an array [slug, name] indexed by term ID
		 */
		$term_lists = array( 'all_terms' => &$all_terms, 'terms' => &$terms );
		foreach ( $term_lists as $list => $arr ) {
			foreach ( $arr as $term ) {
				$this->{$list}[ $term->term_id ] = array( $term->slug, preg_replace( '/\s/', '&nbsp;', $term->name ) );
			}
		}

		if ( ! empty( $this->ignore_list ) ) {
			foreach ( $this->ignore_list as $ignored ) {
				$name                  = ucwords( str_replace( '/-/', ' ', $ignored ) );
				$this->ignored_terms[] = array( $ignored, preg_replace( '/\s/', '&nbsp;', $name ) );
			}
		}

		$options              = get_option( 'teccc_options' );
		$options['terms']     = $this->terms;
		$options['all_terms'] = $this->all_terms;
		update_option( 'teccc_options', $options );
	}

	/**
	 * Add category terms via filter.
	 */
	public function add_terms() {
		$args      = array();
		$add_terms = apply_filters( 'teccc_add_terms', array() );
		foreach ( (array) $add_terms as $add_term ) {
			$args['name'] = ucwords( str_replace( '-', ' ', $add_term ) );
			$args['slug'] = $add_term;
			if ( ! term_exists( $args['name'], 'tribe_events_cat' ) ) {
				wp_insert_term( $args['name'], 'tribe_events_cat', $args );
			}
		}
	}

	/**
	 * Delete category terms via filter.
	 *
	 * @param $all_terms
	 */
	public function delete_terms( $all_terms ) {
		$delete_terms = apply_filters( 'teccc_delete_terms', array() );
		foreach ( (array) $delete_terms as $delete_term ) {
			foreach ( (array) $all_terms as $term ) {
				if ( $delete_term === $term->slug ) {
					wp_delete_term( $term->term_id, 'tribe_events_cat' );
					break;
				}
			}
		}
	}

	/**
	 * Removes terms on the ignore list from the list of terms recognised by the plugin.
	 *
	 * @param $term_list
	 *
	 * @return array
	 */
	public function remove_terms( $term_list ) {
		$options      = get_option( 'teccc_options' );
		$revised_list = array();

		if ( ! isset( $options['hide'] ) ) {
			$options['hide'] = array();
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
	 * @param $file
	 *
	 * @return array
	 */
	public function load_config( $file ) {
		$config = $this->load_config_array_file( $file );

		return (array) apply_filters( "teccc-config-$file", $config );
	}


	/**
	 * Loads and returns an array of settings.
	 *
	 * Maps to "{plugin_dir}/includes/$file.php" - the file itself is expected
	 * to solely contain a PHP array definition.
	 *
	 * @param $file
	 *
	 * @return array
	 */
	protected function load_config_array_file( $file ) {
		$path = TECCC_INCLUDES . "/$file.php";
		if ( ! file_exists( $path ) ) {
			return array();
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
	 * @param       $template
	 * @param array $vars
	 * @param bool  $render
	 *
	 * @return mixed
	 */
	public function view( $template, array $vars = null, $render = true ) {
		$path = locate_template( "tribe-events/teccc/$template.php" );
		if ( empty( $path ) ) {
			$path = TECCC_VIEWS . "/$template.php";
		}

		if ( ! file_exists( $path ) ) {
			return false;
		}
		if ( null !== $vars ) {
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
			for ( $i = 0; $i < $teccc->count; $i ++ ) {
				$arr[ $teccc->slugs[ $i ] . '-text' ]            = '#000';
				$arr[ $teccc->slugs[ $i ] . '-background' ]      = '#CFCFCF';
				$arr[ $teccc->slugs[ $i ] . '-border' ]          = '#CFCFCF';
				$arr[ $teccc->slugs[ $i ] . '-border_none' ]     = '1';
				$arr[ $teccc->slugs[ $i ] . '-background_none' ] = '1';
				$arr['hide'][ $teccc->slugs[ $i ] ]              = null;
			}
			$arr['font_weight'] = 'bold';
			update_option( 'teccc_options', $arr );
		}
	}

	/**
	 * Returns current plugin version.
	 *
	 * @param $file
	 *
	 * @return string Plugin version
	 */
	public static function plugin_get_version( $file ) {
		if ( ! function_exists( 'get_plugins' ) ) {
			require_once ABSPATH . 'wp-admin/includes/plugin.php';
		}
		$plugin_folder = get_plugins( '/' . plugin_basename( dirname( $file ) ) );
		$plugin_file   = basename( $file );

		return $plugin_folder[ $plugin_file ]['Version'];
	}

}
