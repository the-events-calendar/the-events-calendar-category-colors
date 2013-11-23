<?php
class Tribe_Events_Category_Colors_Admin {

	const TAB_NAME = 'category-colors';
	const UPDATE_ACTION = 'category-colors-update-options';
	protected $teccc = null;


	public function __construct( Tribe_Events_Category_Colors $teccc ) {
		$this->teccc = $teccc;
		add_action( 'admin_init', array( $this, 'init' ) );
		add_action( 'admin_notices', array( $this, 'plugin_fail_msg' ) );
		add_action( 'plugins_loaded', array( $this, 'load_settings_tab' ) );
		add_action( 'tribe_settings_below_tabs_tab_category-colors', array( $this, 'is_saved' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'load_teccc_js_css' ) );
		load_plugin_textdomain('events-calendar-category-colors', false, TECCC_LANG );
	}


	public function init(){
		register_setting( 'teccc_category_colors', 'teccc_options', array( $this, 'validate_options' ) );
	}


	public function plugin_fail_msg() {
		if ( current_user_can( 'activate_plugins' ) && is_admin() ) {
			if ( ! class_exists( 'TribeEvents' ) ) {
				$url = 'plugin-install.php?tab=plugin-information&plugin=the-events-calendar&TB_iframe=true';
				$title = __( 'The Events Calendar', 'events-calendar-category-colors' );
				echo '<div class="error"><p>'.sprintf( __( 'To begin using The Events Calendar Category Colors, please install the latest version of <a href="%s" class="thickbox" title="%s">The Events Calendar</a>.', 'events-calendar-category-colors' ),$url, $title ).'</p></div>';
			} elseif ( version_compare( TribeEvents::VERSION, '3.0', 'lt') ) {
				$url = 'plugin-install.php?tab=plugin-information&plugin=the-events-calendar&TB_iframe=true';
				$title = __( 'The Events Calendar', 'events-calendar-category-colors' );
				echo '<div class="error"><p>'.sprintf( __( 'You have The Events Calendar v.' . TribeEvents::VERSION . '. To begin using The Events Calendar Category Colors, please install the latest version of <a href="%s" class="thickbox" title="%s">The Events Calendar</a>.', 'events-calendar-category-colors' ),$url, $title ).'</p></div>';
			}
		}
	}


	/**
	 * @todo streamline validation/sanitization work, replace deprecated function calls
	 */
	public function validate_options( $input ) {
		$teccc = $this->teccc;

		foreach ( $teccc->terms as $attributes ) {
			$slug = $attributes[Tribe_Events_Category_Colors::SLUG];
			
			// Sanitize textbox input (strip html tags, and escape characters)
			// May not be needed with jQuery color picker
			$input[ $slug.'-background' ] =  wp_filter_nohtml_kses($input[$slug.'-background']);
			$input[ $slug.'-background' ] =  ereg_replace( '[^#A-Za-z0-9]', '', $input[$slug.'-background'] );
			if ( $input[ $slug.'-background' ] == '' ) { $input[ $slug.'-background' ] = '#CFCFCF' ; }

			$input[ $slug.'-border' ] =  wp_filter_nohtml_kses( $input[$slug.'-border' ] );
			$input[ $slug.'-border' ] =  ereg_replace( '[^#A-Za-z0-9]', '', $input[$slug.'-border'] );
			if ( $input[ $slug.'-border' ] == '' ) { $input[ $slug.'-border' ] = '#CFCFCF'; }

			// Sets value when checked
			if ( isset( $input[ $slug.'-border_transparent' ] ) ) { $input[ $slug.'-border' ] = 'transparent'; }
			if ( isset( $input[ $slug.'-background_transparent' ] ) ) { $input[ $slug.'-background' ] = 'transparent'; }

			// Sanitize dropdown input (make sure value is one of options allowed)
			if ( !in_array( $input[ $slug.'-text' ], $teccc->text_colors, true ) ) { $input[ $slug.'-text' ] = '#000'; }
		}

		return $input;
	}


	public function load_settings_tab() {
		if ( class_exists( 'TribeEvents' ) ) {
			add_action( 'tribe_settings_do_tabs', array( $this, 'add_category_colors_tab' ) );
		}
	}


	public function add_category_colors_tab () {
		$categoryColorsTab = $this->teccc->load_config( 'admintab' );
		add_action( 'tribe_settings_form_element_tab_category-colors', array( $this, 'form_header' ) );
		add_action( 'tribe_settings_before_content_tab_category-colors', array( $this, 'settings_fields' ) );
		new TribeSettingsTab( self::TAB_NAME, __( 'Category Colors', 'events-calendar-category-colors' ), $categoryColorsTab );
	}


	public function form_header() {
		echo '<form method="post" action="options.php">' ;
	}


	public function settings_fields() {
		settings_fields( 'teccc_category_colors' );
	}


	public function is_saved() {
		if ( isset( $_GET['settings-updated'] ) && ( $_GET['settings-updated'] ) ) {
			$message = __( 'Settings saved.', 'tribe-events-calendar' );
			$output = '<div id="message" class="updated"><p><strong>' . $message . '</strong></p></div>';
			echo apply_filters( 'tribe_settings_success_message', $output, 'category-colors' );
		}
	}


	public static function options_elements() {
		$teccc = Tribe_Events_Category_Colors::instance();

		$content = $teccc->view( 'optionsform', array(
			'options' => self::fetch_options($teccc),
			'teccc' => $teccc
			), false );

		return $content;
	}


	/**
	 * Retrieves the options and pre-processes them to ensure we aren't trying to access non-existent
	 * indicies (can result in notices being emitted).
	 *
	 * @param $teccc
	 * @return array
	 */
	protected static function fetch_options( $teccc ) {
		$options = (array) get_option( 'teccc_options', array() );
		$categoryOptions = array(
			'-background',
			'-background_transparent',
			'-border',
			'-border_transparent',
			'-text'
		);

		foreach ( $teccc->terms as $attributes ) {
			$slug = $attributes[Tribe_Events_Category_Colors::SLUG];

			foreach ( $categoryOptions as $optionkey )
				if ( ! isset( $options[ $slug . $optionkey ] ) )
					$options[ $slug . $optionkey ] = null;
		}

		$generalOptions = array(
			'add_legend',
			'chk_default_options_db',
			'custom_legend_css',
			'font_weight',
			'legend_superpowers',
		);

		foreach ( $generalOptions as $optionkey )
			if ( ! isset( $options[ $optionkey ] ) )
				$options[ $optionkey ] = null;

		return $options;
	}

	public static function load_teccc_js_css( $hook ) {
		if ( 'tribe_events_page_tribe-events-calendar' != $hook ) return;

		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'wp-color-picker' );
		wp_enqueue_script( 'wp-color-picker-init', TECCC_RESOURCES.'/wp-color-picker-init.js', array( 'wp-color-picker' ), false, true );
		wp_enqueue_style( 'teccc-iris', TECCC_RESOURCES.'/teccc-iris.css', false, Tribe_Events_Category_Colors::VERSION );
		
		wp_enqueue_script( 'teccc-admin', TECCC_RESOURCES.'/teccc-admin.js', false, Tribe_Events_Category_Colors::VERSION, true );
		wp_enqueue_style( 'teccc-options', TECCC_RESOURCES.'/teccc-options.css', false, Tribe_Events_Category_Colors::VERSION );

	}

}