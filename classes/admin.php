<?php
class TribeEventsCategoryColorsAdmin {
	const TAB_NAME = 'category-colors';
	const UPDATE_ACTION = 'category-colors-update-options';
	protected $teccc = null;



	public function __construct(TribeEventsCategoryColors $teccc) {
		$this->teccc = $teccc;
		add_action('admin_init', array($this, 'init'));
		add_action('admin_notices', array($this, 'plugin_fail_msg'));
		add_action('plugins_loaded', array($this, 'load_settings_tab'));
		add_action('tribe_settings_below_tabs_tab_category-colors', array($this, 'is_saved'));
		add_action('admin_enqueue_scripts', array($this, 'load_teccc_js_css'));
	}


	public function init(){
		register_setting('teccc_category_colors', 'teccc_options', array($this, 'validate_options'));
	}


	public function plugin_fail_msg() {
		if ( !class_exists( 'TribeEvents' ) ) {
			if ( current_user_can( 'activate_plugins' ) && is_admin() ) {
				$url = 'plugin-install.php?tab=plugin-information&plugin=the-events-calendar&TB_iframe=true';
				$title = __( 'The Events Calendar', 'the-events-calendar-category-colors' );
				echo '<div class="error"><p>'.sprintf( __( 'To begin using The Events Calendar Category Colors, please install the latest version of <a href="%s" class="thickbox" title="%s">The Events Calendar</a>.', 'tribe-events-calendar-pro' ),$url, $title ).'</p></div>';
			}
		}
	}


	/**
	 * @todo streamline validation/sanitization work, replace deprecated function calls
	 */
	public function validate_options($input) {
		$teccc = $this->teccc;

		for ($i = 0; $i < $teccc->count; $i++) {
			// Sanitize textbox input (strip html tags, and escape characters)
			// May not be needed with jQuery color picker
			$input[$teccc->slugs[$i].'-background'] =  wp_filter_nohtml_kses($input[$teccc->slugs[$i].'-background']);
			$input[$teccc->slugs[$i].'-background'] =  ereg_replace( '[^#A-Za-z0-9]', '', $input[$teccc->slugs[$i].'-background'] );
			if ( $input[$teccc->slugs[$i].'-background'] == '' ) { $input[$teccc->slugs[$i].'-background'] = '#CFCFCF' ; }

			$input[$teccc->slugs[$i].'-border'] =  wp_filter_nohtml_kses($input[$teccc->slugs[$i].'-border']);
			$input[$teccc->slugs[$i].'-border'] =  ereg_replace( '[^#A-Za-z0-9]', '', $input[$teccc->slugs[$i].'-border'] );
			if ( $input[$teccc->slugs[$i].'-border'] == '' ) { $input[$teccc->slugs[$i].'-border'] = '#CFCFCF'; }

			// Sets value when checked
			if ( isset( $input[$teccc->slugs[$i].'-border_transparent'] ) ) { $input[$teccc->slugs[$i].'-border'] = 'transparent'; }
			if ( isset( $input[$teccc->slugs[$i].'-background_transparent'] ) ) { $input[$teccc->slugs[$i].'-background'] = 'transparent'; }

			// Sanitize dropdown input (make sure value is one of options allowed)
			if ( !in_array($input[$teccc->slugs[$i].'-text'], $teccc->text_colors, true) ) { $input[$teccc->slugs[$i].'-text'] = '#000'; }
		}

		return $input;
	}


	public function add_defaults() {
		$teccc = $this->teccc;
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


	public function load_settings_tab() {
		if (class_exists('TribeEvents')) {
			add_action('tribe_settings_do_tabs', array($this, 'add_category_colors_tab'));
		}
	}


	public function add_category_colors_tab () {
		$categoryColorsTab = $this->teccc->load_config('admintab');
		add_action('tribe_settings_form_element_tab_category-colors', array($this, 'form_header'));
		add_action('tribe_settings_before_content_tab_category-colors', array($this, 'settings_fields'));
		new TribeSettingsTab(self::TAB_NAME, __('Category Colors', 'tribe-events-calendar'), $categoryColorsTab);
	}


	public function form_header() {
		echo '<form method="post" action="options.php">' ;
	}


	public function settings_fields() {
		settings_fields('teccc_category_colors');
	}


	public function is_saved() {
		if (isset($_GET['settings-updated']) && ($_GET['settings-updated'])) {
			$message = __('Settings saved.', 'tribe-events-calendar');
			$output = '<div id="message" class="updated"><p><strong>' . $message . '</strong></p></div>';
			echo apply_filters('tribe_settings_success_message', $output, 'category-colors');
		}
	}


	public static function options_elements() {
		$teccc = TribeEventsCategoryColors::instance();

		$content = $teccc->view('optionsform', array(
			'options' => (array) get_option('teccc_options', array()),
			'teccc' => $teccc
			), false);

		return $content;
	}
	
	
	public static function load_teccc_js_css( $hook ) {
		//var_export($hook);
		if ( 'tribe_events_page_tribe-events-calendar' != $hook ) return;

		wp_enqueue_style('minicolors-css', TECCC_RESOURCES.'/jquery-miniColors/jquery.miniColors.css' );
		wp_enqueue_style('minicolors-console', TECCC_RESOURCES.'/minicolors-console.css' );
		wp_enqueue_script('minicolors-js', TECCC_RESOURCES.'/jquery-miniColors/jquery.miniColors.js' );
		wp_enqueue_script('minicolors-init', TECCC_RESOURCES.'/jquery-miniColors-init.js' );
		
		wp_enqueue_script('teccc-admin', TECCC_RESOURCES.'/teccc-admin.js', false, false, true );
		wp_enqueue_style('teccc-options', TECCC_RESOURCES.'/teccc-options.css' );
		
	}
}