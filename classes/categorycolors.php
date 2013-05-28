<?php
class TribeEventsCategoryColors {
	const VERSION = '1.7';

	public $text_colors = array(
		'Black' => '#000',
		'White' => '#fff',
		'Gray' => '#999'
	);
	public $font_weights = array(
		'Bold' => 'bold',
		'Normal' => 'normal'
	);


	public $IDs   = array();
	public $slugs = array();
	public $names = array();
	public $count = 0;
	private $values = array();

	/**
	 * @var TribeEventsCategoryColorsPublic
	 */
	public $public;

	protected static $object = false;


	/**
	 * The TribeEventsCategoryColors object can be created/obtained via this
	 * method - this prevents unncessary work in rebuilding the object and
	 * querying to construct a list of categories, etc.
	 *
	 * @return TribeEventsCategoryColors
	 */
	public static function instance() {
		$class = __CLASS__;
		if (self::$object === false) self::$object = new $class();
		return self::$object;
	}


	protected function __construct() {
		// We need to wait until the taxonomy has been registered before building our list
		add_action('init', array($this, 'load_categories'), 20);

		if ($this->is_admin()) $this->load_admin();
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
		return (is_admin() and (!defined('DOING_AJAX')));
	}


	public function load_categories() {
		$terms = $this->get_category_terms();
		$this->IDs = $terms['IDs'];
		$this->slugs = $terms['slugs'];
		$this->names = $terms['names'];
		$this->count = count($this->slugs);
	}

	public function set_omit_terms($testvar) { $this->values = $testvar; }

	protected function get_category_terms() {
		if( ! has_filter('teccc_omit_terms') ) $terms = $this->filter_by_value();
		if( has_filter('teccc_omit_terms') ) {
			echo apply_filters( 'teccc_omit_terms', array($this, 'filter_by_value') );
			$terms = $this->filter_by_value();
		}

		$IDs   = array();
		$slugs = array();
		$names = array();

		foreach ($terms as $term) {
			$IDs[]   = $term->term_id;
			$slugs[] = $term->slug;
			$names[] = preg_replace('/\s/', '&nbsp;', $term->name);
		}

		return array(
			'IDs'   => $IDs,
			'slugs' => $slugs,
			'names' => $names
		);
	}

	private function filter_by_value() {
		$array = get_terms( 'tribe_events_cat' );
		$index='slug';
		$values = $this->values;
		if( is_array( $array ) && count( $array ) >  0)
			foreach( array_keys( $array ) as $key ) {
				$temp[ $key ] = $array[ $key ]->$index;
				if( is_array( $values ) && count( $values ) > 0 )
					foreach( $values as $value )
						if( $temp[ $key ] == $value ) unset( $array[ $key ] );
			}

		return $array;
	}


	protected function load_admin() {
		require_once TECCC_CLASSES.'/admin.php';
		new TribeEventsCategoryColorsAdmin($this);
	}


	protected function load_public() {
		require_once TECCC_CLASSES.'/public.php';
		$this->public = new TribeEventsCategoryColorsPublic($this);
	}


	/**
	 * Loads and returns the requested configuration array.
	 *
	 * @param $file
	 * @return array
	 */
	public function load_config($file) {
		$config = $this->load_config_array_file($file);
		return (array) apply_filters("teccc-config-$file", $config);
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
	protected function load_config_array_file($file) {
		$path = TECCC_INCLUDES."/$file.php";
		if (file_exists($path))	return (array) include $path;
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
	public function view($template, array $vars = null, $render = true) {
		$path = TECCC_VIEWS."/$template.php";
		if (!file_exists($path)) return;
		if ($vars !== null) extract($vars);

		if (!$render) ob_start();
		include $path;
		if (!$render) return ob_get_clean();
	}


	/**
	 * Expected to run on activation; populates the default options.
	 */
	public static function add_defaults() {
		$teccc = TribeEventsCategoryColors::instance();
		$tmp = get_option('teccc_options');

		if ($tmp['chk_default_options_db'] == '1' or !is_array($tmp)) {
			delete_option('teccc_options');
			for ($i = 0; $i < $teccc->count; $i++) {
				$arr[$teccc->slugs[$i].'-text'] = '#000';
				$arr[$teccc->slugs[$i].'-background'] = '#CFCFCF';
				$arr[$teccc->slugs[$i].'-border'] = '#CFCFCF';
				$arr[$teccc->slugs[$i].'-border_transparent'] = '1';
				$arr[$teccc->slugs[$i].'-background_transparent'] = '1';
			}
			$arr['font_weight'] = 'bold';
			update_option('teccc_options', $arr);
		}
	}


	/**
	 * Expected to run on deactivation.
	 */
	public static function delete_plugin_options() {
		delete_option('teccc_options');
	}
}
