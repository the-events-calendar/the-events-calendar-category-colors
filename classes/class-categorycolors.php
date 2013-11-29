<?php
class Tribe_Events_Category_Colors {

	const VERSION = '3.2.0';
	const SLUG = 0;
	const NAME = 1;

	public $text_colors = array(
		'Black' => '#000',
		'White' => '#fff',
		'Gray'  => '#999'
	);

	public $font_weights = array(
		'Bold'   => 'bold',
		'Normal' => 'normal'
	);

	/**
	 * Contains each term in an array structured as follows:
	 *
	 * 	[ id => [ slug, name ], ... ]
	 *
	 * @var array
	 */
	public $terms = array();
	public $count = 0;

	/**
	 * Category IDs (ints) and slugs (strings) to ignore.
	 *
	 * @var array
	 */
	public $ignore_list = array();

	/**
	 * @var Tribe_Events_Category_Colors_Public
	 */
	public $public;

	protected static $object = false;


	/**
	 * The Tribe_Events_Category_Colors object can be created/obtained via this
	 * method - this prevents unncessary work in rebuilding the object and
	 * querying to construct a list of categories, etc.
	 *
	 * @return Tribe_Events_Category_Colors
	 */
	public static function instance() {
		$class = __CLASS__;
		if ( false === self::$object ) self::$object = new $class();
		return self::$object;
	}


	protected function __construct() {
		// We need to wait until the taxonomy has been registered before building our list
		add_action( 'init', array( $this, 'load_categories' ), 20 );

		if ( $this->is_admin() ) $this->load_admin();
		$this->load_public(); // Always load public (in case template tags are in use with the theme)
	}


	/**
	 * Tests to see if the request relates to the admin environment or not. Due to the way
	 * WordPress/The Events Calendar work in relation to ajax requests a simple is_admin()
	 * can return a false positive in some situations (such as ajax calendar loads).
	 *
	 * @return bool
	 */
	protected function is_admin() {
		return ( is_admin() and ( ! defined( 'DOING_AJAX' ) ) );
	}


	public function load_categories() {
		add_filter( 'teccc_get_terms', array( $this, 'remove_terms' ) );
		$this->get_category_terms();
		$this->count = count( $this->terms );
	}


	protected function get_category_terms() {
		if ( ! empty( $this->terms ) ) return;

		// TribeEvents not yet defined, so we can't use the class constant
		$term_list = apply_filters( 'teccc_get_terms', get_terms( 'tribe_events_cat' ) );

		// Represent each term as an array [slug, name] indexed by term ID
		foreach ( $term_list as $term )
			$this->terms[ $term->term_id ] = array( $term->slug, preg_replace( '/\s/', '&nbsp;', $term->name ) );
	}


	/**
	 * Removes terms on the ignore list from the list of terms recognised by the plugin.
	 *
	 * @param $term_list
	 * @return array
	 */
	public function remove_terms( $term_list ) {
		$revised_list = array();

		foreach ( $term_list as $src_id => $src_term ) {
			if ( in_array( (int) $src_term->term_id, $this->ignore_list, true ) ) continue;
			if ( in_array( (string) $src_term->slug, $this->ignore_list, true ) ) continue;
			$revised_list[ $src_id ] = $src_term;
		}

		return $revised_list;
	}


	protected function load_admin() {
		require_once TECCC_CLASSES . '/class-admin.php';
		new Tribe_Events_Category_Colors_Admin( $this );
	}


	protected function load_public() {
		require_once TECCC_CLASSES . '/class-public.php';
		$this->public = new Tribe_Events_Category_Colors_Public( $this );
	}


	/**
	 * Loads and returns the requested configuration array.
	 *
	 * @param $file
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
	 * @return array
	 */
	protected function load_config_array_file( $file ) {
		$path = TECCC_INCLUDES . "/$file.php";
		if ( file_exists( $path ) )	return (array) include $path;
		else return array();
	}


	/**
	 * Loads the specified view, which is expected to exist within the views
	 * directory. ".php" should *not* be appended.
	 *
	 * If the optional array of $vars are supplied they will be extracted and
	 * pulled into the same scope as the template.
	 *
	 * @param $template
	 * @param array $vars
	 * @param bool $render
	 * @return mixed
	 */
	public function view( $template, array $vars = null, $render = true ) {
		$path = TECCC_VIEWS . "/$template.php";
		if ( ! file_exists( $path ) ) return;
		if ( $vars !== null ) extract( $vars );

		if ( ! $render ) ob_start();
		include $path;
		if ( ! $render ) return ob_get_clean();
	}


	/**
	 * Expected to run on activation; populates the default options.
	 */
	public static function add_defaults() {
		$teccc = Tribe_Events_Category_Colors::instance();
		$tmp = get_option( 'teccc_options' );

		if ( ! isset( $tmp['chk_default_options_db'] ) ) return;
		if ( $tmp['chk_default_options_db'] == '1' or ! is_array( $tmp ) ) {
			delete_option( 'teccc_options' );
			for ( $i = 0; $i < $teccc->count; $i++ ) {
				$arr[ $teccc->slugs[$i].'-text' ]                   = '#000';
				$arr[ $teccc->slugs[$i].'-background' ]             = '#CFCFCF';
				$arr[ $teccc->slugs[$i].'-border' ]                 = '#CFCFCF';
				$arr[ $teccc->slugs[$i].'-border_transparent' ]     = '1';
				$arr[ $teccc->slugs[$i].'-background_transparent' ] = '1';
			}
			$arr['font_weight'] = 'bold';
			update_option( 'teccc_options', $arr );
		}
	}


	/**
	 * Expected to run on deactivation.
	 */
	public static function delete_plugin_options() {
		delete_option( 'teccc_options' );
	}
}
