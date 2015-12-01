<?php
namespace Fragen\Category_Colors;

use Tribe__Events__Main,
	Tribe__Settings_Tab;


class Admin {

	const TAB_NAME      = 'category-colors';
	const UPDATE_ACTION = 'category-colors-update-options';
	protected $teccc    = null;


	public function __construct( Main $teccc ) {
		$this->teccc = $teccc;
		$this->load_settings_tab();

		add_action( 'admin_init', array( $this, 'init' ) );
		add_action( 'admin_notices', array( $this, 'plugin_fail_msg' ) );
		add_action( 'tribe_settings_below_tabs_tab_category-colors', array( $this, 'is_saved' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'load_teccc_js_css' ) );
		load_plugin_textdomain( 'the-events-calendar-category-colors', false, TECCC_LANG );
	}


	public function init() {
		register_setting( 'teccc_category_colors', 'teccc_options', array( $this, 'validate_options' ) );
	}


	public function plugin_fail_msg() {
		if ( current_user_can( 'activate_plugins' ) && is_admin() ) {
			$url   = 'plugin-install.php?tab=plugin-information&plugin=the-events-calendar&TB_iframe=true';
			$title = esc_html__( 'The Events Calendar', 'the-events-calendar-category-colors' );
			if ( ! class_exists( 'Tribe__Events__Main' ) ) {
				echo '<div class="error"><p>' . sprintf( __( 'To begin using The Events Calendar Category Colors, please install the latest version of %sThe Events Calendar%s.', 'the-events-calendar-category-colors' ), '<a href="' . $url . '" class="thickbox" title="' . $title . '">', '</a>' ) . '</p></div>';
			} elseif ( version_compare( Tribe__Events__Main::VERSION, '3.0', 'lt') ) {
				echo '<div class="error"><p>' . sprintf( __( 'You have The Events Calendar v.%s. To begin using The Events Calendar Category Colors, please install the latest version of <a href="%s" class="thickbox" title="%s">The Events Calendar</a>.', 'the-events-calendar-category-colors' ), Tribe__Events__Main::VERSION, '<a href="' . $url . '" class="thickbox" title="' . $title . '">', '</a>' ) . '</p></div>';
			}
		}
	}


	/**
	 * @param $input
	 * @todo streamline validation/sanitization work, replace deprecated function calls
	 */
	public function validate_options( $input ) {
		$teccc = $this->teccc;

		foreach ( $teccc->terms as $attributes ) {
			$slug = $attributes[ Main::SLUG ];

			// Sanitize textbox input (strip html tags, and escape characters)
			// May not be needed with jQuery color picker
			$input[ $slug.'-background' ] =  wp_filter_nohtml_kses($input[$slug.'-background']);
			$input[ $slug.'-background' ] =  preg_replace( '[^#A-Za-z0-9]', '', $input[ $slug.'-background' ] );
			if ( $input[ $slug.'-background' ] == '' ) {
				$input[ $slug.'-background' ] = '#CFCFCF' ;
			}

			$input[ $slug.'-border' ] =  wp_filter_nohtml_kses( $input[$slug.'-border' ] );
			$input[ $slug.'-border' ] =  preg_replace( '[^#A-Za-z0-9]', '', $input[ $slug.'-border' ] );
			if ( $input[ $slug.'-border' ] == '' ) {
				$input[ $slug.'-border' ] = '#CFCFCF';
			}

			// Sets value when checked
			if ( isset( $input[ $slug.'-border_transparent' ] ) ) {
				$input[ $slug.'-border' ] = 'transparent';
			}
			if ( isset( $input[ $slug.'-background_transparent' ] ) ) {
				$input[ $slug.'-background' ] = 'transparent';
			}

			// Sanitize dropdown input (make sure value is one of options allowed)
			if ( ! in_array( $input[ $slug.'-text' ], $teccc->text_colors, true ) ) {
				$input[ $slug.'-text' ] = '#000';
			}
		}

		return $input;
	}


	public function load_settings_tab() {
		if ( class_exists( 'Tribe__Events__Main' ) ) {
			add_action( 'tribe_settings_do_tabs', array( $this, 'add_category_colors_tab' ) );
		}
	}


	public function add_category_colors_tab () {
		$categoryColorsTab = $this->teccc->load_config( 'admintab' );
		add_action( 'tribe_settings_form_element_tab_category-colors', array( $this, 'form_header' ) );
		add_action( 'tribe_settings_before_content_tab_category-colors', array( $this, 'settings_fields' ) );
		new Tribe__Settings_Tab( self::TAB_NAME, esc_html__( 'Category Colors', 'the-events-calendar-category-colors' ), $categoryColorsTab );
	}


	public function form_header() {
		echo '<form method="post" action="options.php">' ;
	}


	public function settings_fields() {
		settings_fields( 'teccc_category_colors' );
	}


	public function is_saved() {
		if ( isset( $_GET['settings-updated'] ) && ( $_GET['settings-updated'] ) ) {
			$message = esc_html__( 'Settings saved.', 'the-events-calendar-category-colors' );
			$output  = '<div id="message" class="updated"><p><strong>' . $message . '</strong></p></div>';
			echo apply_filters( 'tribe_settings_success_message', $output, 'category-colors' );
		}
	}


	public static function options_elements() {
		$teccc = Main::instance();

		$content = $teccc->view( 'optionsform', array(
			'options' => self::fetch_options( $teccc ),
			'teccc'   => $teccc
			), false );

		return $content;
	}


	/**
	 * Retrieves the options and pre-processes them to ensure we aren't trying to access non-existent
	 * indicies (can result in notices being emitted).
	 *
	 * @param Main $teccc
	 * @return array
	 */
	public static function fetch_options( Main $teccc ) {
		$options = (array) get_option( 'teccc_options', array() );
		$categoryOptions = array(
			'-background',
			'-background_transparent',
			'-border',
			'-border_transparent',
			'-text',
		);

		foreach ( $teccc->terms as $attributes ) {
			$slug = $attributes[ Main::SLUG ];

			foreach ( $categoryOptions as $optionkey ) {
				if ( ! isset( $options[ $slug . $optionkey ] ) ) {
					$options[ $slug . $optionkey ] = null;
				}
			}

			if ( ! isset( $options['hide'][ $slug ] ) ) {
				$options['hide'][ $slug ] = null;
			}
		}

		$generalOptions = array(
			'add_legend',
			'chk_default_options_db',
			'custom_legend_css',
			'font_weight',
			'legend_superpowers',
			'color_widgets',
			'show_ignored_cats_legend',
		);

		foreach ( $generalOptions as $optionkey ) {
			if ( ! isset( $options[ $optionkey ] ) ) {
				$options[ $optionkey ] = null;
			}
		}

		return $options;
	}

	/**
	 * Enqueue admin scripts and styles
	 *
	 * @param $hook
	 * @return bool|void
	 */
	public static function load_teccc_js_css( $hook ) {
		if ( 'tribe_events_page_tribe-events-calendar' != $hook &&
		     'tribe_events_page_tribe-common' != $hook
		) {
			return false;
		}

		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'wp-color-picker' );
		wp_enqueue_style( 'teccc-iris', TECCC_RESOURCES . '/teccc-iris.css', false, Main::$version );
		wp_enqueue_script( 'teccc-admin', TECCC_RESOURCES . '/teccc-admin.js', false, Main::$version, true );
		wp_enqueue_style( 'teccc-options', TECCC_RESOURCES . '/teccc-options.css', false, Main::$version );

	}

}
