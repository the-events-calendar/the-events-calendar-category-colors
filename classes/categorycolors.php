<?php
class TribeEventsCategoryColors {
	const VERSION = '1.6.3';

	public $text_colors = array(
		'Black' => '#000',
		'White' => '#fff',
		'Gray' => '#999'
	);
	public $font_weights = array(
		'Bold' => 'bold',
		'Normal' => 'normal'
	);


	public $slugs = array();
	public $names = array();
	public $count = 0;

	protected static $object = false;


	/**
	 * The TribeEventsCategoryColors object can be created/obtained via this
	 * method - this prevents unncessary work in rebuilding the object and
	 * querying to construct a list of categories, etc.
	 */
	public static function instance() {
		$class = __CLASS__;
		if (self::$object === false) self::$object = new $class();
		return self::$object;
	}


	protected function __construct() {
		// We need to wait until the taxonomy has been registered before building our list
		add_action('init', array($this, 'load_categories'), 20);

		if (is_admin()) $this->load_admin();
		else $this->load_public();
	}


	public function load_categories() {
		$terms = $this->get_category_terms();
		$this->slugs = $terms['slugs'];
		$this->names = $terms['names'];
		$this->count = count($this->slugs);
	}


	protected function get_category_terms() {
		$terms = get_terms('tribe_events_cat'); // TribeEvents not yet defined, so we can't use the class constant
		$slugs = array();
		$names = array();

		foreach ($terms as $term) {
			$slugs[] = $term->slug;
			$names[] = preg_replace('/\s/', '&nbsp;', $term->name);
		}

		return array(
			'slugs' => $slugs,
			'names' => $names
		);
	}


	protected function load_admin() {
		require_once TECCC_CLASSES.'/admin.php';
		new TribeEventsCategoryColorsAdmin($this);
	}


	protected function load_public() {
		require_once TECCC_CLASSES.'/public.php';
		new TribeEventsCategoryColorsPublic($this);
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
