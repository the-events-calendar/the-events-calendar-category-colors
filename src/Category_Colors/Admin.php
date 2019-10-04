<?php

namespace Fragen\Category_Colors;

use Tribe__Events__Main;
use Tribe__Settings_Tab;

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
	}

	public function init() {
		register_setting( 'teccc_category_colors', 'teccc_options', array( $this, 'validate_options' ) );
	}

	public function plugin_fail_msg() {
		if ( current_user_can( 'activate_plugins' ) && is_admin() ) {
			$url   = 'plugin-install.php?tab=plugin-information&plugin=the-events-calendar&TB_iframe=true';
			$title = esc_html__( 'The Events Calendar', 'the-events-calendar-category-colors' );
			if ( ! class_exists( 'Tribe__Events__Main' ) ) {
				echo '<div class="error"><p>' . sprintf(
					wp_kses_post(
						/* translators: %1$s, %2$s: href to The Events Calendar */
						__( 'To begin using The Events Calendar Category Colors, please install the latest version of %1$sThe Events Calendar%2$.', 'the-events-calendar-category-colors' )
					),
					'<a href="' . $url . '" class="thickbox" title="' . $title . '">',
					'</a>'
				)
				. '</p></div>';
			} elseif ( version_compare( Tribe__Events__Main::VERSION, '3.0', 'lt' ) ) {
				echo '<div class="error"><p>' . sprintf(
					wp_kses_post(
						/* translators: %1$s: TEC version, %2$s, %3$s: href to Events Calendar */
						__( 'You have The Events Calendar v.%1$s. To begin using The Events Calendar Category Colors, please install the latest version of %2$sThe Events Calendar%3$s.', 'the-events-calendar-category-colors' )
					),
					Tribe__Events__Main::VERSION,
					'<a href="' . $url . '" class="thickbox" title="' . $title . '">',
					'</a>'
				)
				. '</p></div>';
			}
		}
	}

	/**
	 * @param array $input
	 *
	 * TODO: streamline validation/sanitization work, replace deprecated function calls
	 * @return array $input
	 */
	public function validate_options( $input ) {
		$teccc   = $this->teccc;
		$options = get_option( 'teccc_options' );
		$teccc->setup_terms( $options );

		foreach ( $teccc->all_terms as $attributes ) {
			$slug = $attributes[ Main::SLUG ];

			// Sanitize textbox input.
			// May not be needed with jQuery color picker.
			$input[ "{$slug}-background" ] = sanitize_hex_color( $input[ "{$slug}-background" ] );
			if ( empty( $input[ "{$slug}-background" ] ) ) {
				$input[ "{$slug}-background" ] = '#CFCFCF';
			}

			$input[ "{$slug}-border" ] = sanitize_hex_color( $input[ "{$slug}-border" ] );
			if ( empty( $input[ "{$slug}-border" ] ) ) {
				$input[ "{$slug}-border" ] = '#CFCFCF';
			}

			// Sets value when checked
			if ( isset( $input[ "{$slug}-border_none" ] ) ) {
				$input[ "{$slug}-border" ] = null;
			}
			if ( isset( $input[ "{$slug}-background_none" ] ) ) {
				$input[ "{$slug}-background" ] = null;
			}

			// Sanitize dropdown input (make sure value is one of options allowed)
			if ( ! in_array( $input[ "{$slug}-text" ], $teccc->text_colors, true ) ) {
				$input[ "{$slug}-text" ] = '#000';
			}
		}

		// Set appropriate values for featured event.
		$input['featured-event'] = isset( $input['featured-event_none'] ) ? 'transparent' : sanitize_hex_color( $input['featured-event'] );
		if ( empty( $input['featured-event'] ) ) {
			$input['featured-event'] = '#0ea0d7';
		}

		return $input;
	}

	public function load_settings_tab() {
		if ( class_exists( 'Tribe__Events__Main' ) ) {
			add_action( 'tribe_settings_do_tabs', array( $this, 'add_category_colors_tab' ) );
		}
	}

	public function add_category_colors_tab() {
		$categoryColorsTab = $this->teccc->load_config( 'admintab' );
		add_action( 'tribe_settings_form_element_tab_category-colors', array( $this, 'form_header' ) );
		add_action( 'tribe_settings_before_content_tab_category-colors', array( $this, 'settings_fields' ) );
		new Tribe__Settings_Tab( self::TAB_NAME, esc_html__( 'Category Colors', 'the-events-calendar-category-colors' ), $categoryColorsTab );
	}

	public function form_header() {
		echo '<form method="post" action="options.php">';
	}

	public function settings_fields() {
		settings_fields( 'teccc_category_colors' );
	}

	public function is_saved() {
		if ( isset( $_GET['settings-updated'] ) && $_GET['settings-updated'] ) {
			$message = esc_html__( 'Settings saved.', 'the-events-calendar-category-colors' );
			$output  = '<div id="message" class="updated"><p><strong>' . $message . '</strong></p></div>';
			echo apply_filters( 'tribe_settings_success_message', $output, 'category-colors' );
		}
	}

	public static function options_elements() {
		$teccc = Main::instance();

		$content = $teccc->view(
			'optionsform',
			array(
				'options' => self::fetch_options( $teccc ),
				'teccc'   => $teccc,
			),
			false
		);

		return $content;
	}

	/**
	 * Retrieves the options and pre-processes them to ensure we aren't trying to access non-existent
	 * indices (can result in notices being emitted).
	 *
	 * @param Main $teccc
	 *
	 * @return array
	 */
	public static function fetch_options( Main $teccc ) {
		$options         = (array) get_option( 'teccc_options', array() );
		$categoryOptions = array(
			'-background',
			'-background_none',
			'-border',
			'-border_none',
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
			'featured-event',
			'featured-event_none',
			'add_legend',
			'chk_default_options_db',
			'custom_legend_css',
			'font_weight',
			'legend_superpowers',
			'show_ignored_cats_legend',
		);

		foreach ( $generalOptions as $optionkey ) {
			if ( ! isset( $options[ $optionkey ] ) ) {
				$options[ $optionkey ] = null;
			}
		}

		$options['featured-event'] = ! empty( $options['featured-event_none'] ) ? 'transparent' : $options['featured-event'];

		return $options;
	}

	/**
	 * Enqueue admin scripts and styles
	 *
	 * @param $hook
	 *
	 * @return bool
	 */
	public function load_teccc_js_css( $hook ) {
		if ( 'tribe_events_page_tribe-events-calendar' !== $hook &&
			'tribe_events_page_tribe-common' !== $hook
		) {
			return false;
		}

		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'wp-color-picker' );
		wp_enqueue_style( 'teccc-iris', $this->teccc->resources_url . '/teccc-iris.css', false, Main::$version );
		wp_enqueue_script( 'teccc-admin', $this->teccc->resources_url . '/teccc-admin.js', false, Main::$version, true );
		wp_enqueue_style( 'teccc-options', $this->teccc->resources_url . '/teccc-options.css', false, Main::$version );
	}

}
