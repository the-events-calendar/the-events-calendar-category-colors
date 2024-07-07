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
use Tribe__Settings_Tab;

/**
 * Class Admin
 */
class Admin {
	const TAB_NAME      = 'category-colors';
	const UPDATE_ACTION = 'category-colors-update-options';

	/**
	 * Variable
	 *
	 * @var Main
	 */
	protected $teccc;

	/**
	 * Contructor
	 *
	 * @param Main $teccc Class Main.
	 */
	public function __construct( Main $teccc ) {
		$this->teccc = $teccc;
		$this->load_settings_tab();
	}

	/**
	 * Load hooks
	 *
	 * @return void
	 */
	public function load_hooks() {
		add_action( 'admin_init', [ $this, 'register_setting' ] );
		add_action( 'admin_notices', [ $this, 'plugin_fail_msg' ] );
		add_action( 'tribe_settings_below_tabs_tab_category-colors', [ $this, 'is_saved' ] );
		add_action( 'admin_enqueue_scripts', [ $this, 'load_teccc_js_css' ] );
	}

	/**
	 * Register settings
	 *
	 * @return void
	 */
	public function register_setting() {
		register_setting( 'teccc_category_colors', 'teccc_options', [ $this, 'validate_options' ] );
	}

	/**
	 * Display plugin fail message.
	 *
	 * @return void
	 */
	public function plugin_fail_msg() {
		if ( current_user_can( 'activate_plugins' ) && is_admin() ) {
			$url   = 'plugin-install.php?tab=plugin-information&plugin=the-events-calendar&TB_iframe=true';
			$title = esc_html__( 'The Events Calendar', 'the-events-calendar-category-colors' );
			if ( ! class_exists( 'Tribe__Events__Main' ) ) {
				echo '<div class="error"><p>' . sprintf(
					wp_kses_post(
						/* translators: %1$s, %2$s: href to The Events Calendar */
						__( 'To begin using The Events Calendar: Category Colors, please install the latest version of %1$sThe Events Calendar%2$s.', 'the-events-calendar-category-colors' )
					),
					'<a href="' . esc_attr( $url ) . '" class="thickbox" title="' . esc_attr( $title ) . '">',
					'</a>'
				)
				. '</p></div>';
			} elseif ( version_compare( Tribe__Events__Main::VERSION, '5.0', 'lt' ) ) {
				echo '<div class="error"><p>' . sprintf(
					wp_kses_post(
						/* translators: %1$s: TEC version, %2$s, %3$s: href to Events Calendar */
						__( 'You have The Events Calendar v.%1$s. To begin using The Events Calendar: Category Colors, please install the latest version of %2$sThe Events Calendar%3$s.', 'the-events-calendar-category-colors' )
					),
					esc_html( Tribe__Events__Main::VERSION ),
					'<a href="' . esc_attr( $url ) . '" class="thickbox" title="' . esc_attr( $title ) . '">',
					'</a>'
				)
				. '</p></div>';
			}
		}
	}

	/**
	 * Validate options
	 *
	 * @param array $input Options
	 *
	 * TODO: streamline validation/sanitization work, replace deprecated function calls.
	 * @return array
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

			// Sets value when checked.
			if ( isset( $input[ "{$slug}-border_none" ] ) ) {
				$input[ "{$slug}-border" ] = '';
			}
			if ( isset( $input[ "{$slug}-background_none" ] ) ) {
				$input[ "{$slug}-background" ] = '';
			}

			// Sanitize dropdown input (make sure value is one of options allowed).
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

	/**
	 * Load settings tab
	 *
	 * @return void
	 */
	public function load_settings_tab() {
		if ( class_exists( 'Tribe__Events__Main' ) ) {
			add_action( 'tribe_settings_do_tabs', [ $this, 'add_category_colors_tab' ] );
		}
	}

	/**
	 * Add Category Colors tab
	 *
	 * @return void
	 */
	public function add_category_colors_tab() {
		$categoryColorsTab = $this->teccc->load_config( 'admintab' );
		add_action( 'tribe_settings_form_element_tab_category-colors', [ $this, 'form_header' ] );
		add_action( 'tribe_settings_before_content_tab_category-colors', [ $this, 'settings_fields' ] );
		new Tribe__Settings_Tab( self::TAB_NAME, esc_html__( 'Category Colors', 'the-events-calendar-category-colors' ), $categoryColorsTab );
	}

	/**
	 * Form header
	 *
	 * @return void
	 */
	public function form_header() {
		echo '<form method="post" action="options.php">';
	}

	/**
	 * Settings fields
	 *
	 * @return void
	 */
	public function settings_fields() {
		settings_fields( 'teccc_category_colors' );
	}

	/**
	 * Display 'saved' notice
	 */
	public function is_saved() {
		// phpcs:ignore WordPress.Security.NonceVerification.Recommended
		if ( isset( $_GET['settings-updated'] ) && sanitize_key( wp_unslash( $_GET['settings-updated'] ) ) ) {
			$message = esc_html__( 'Settings saved.', 'the-events-calendar-category-colors' );
			$output  = '<div id="message" class="updated"><p><strong>' . esc_html( $message ) . '</strong></p></div>';
			echo wp_kses_post( apply_filters( 'tribe_settings_success_message', $output, 'category-colors' ) );
		}
	}

	/**
	 * Options elements
	 *
	 * @return string
	 */
	public static function options_elements() {
		$teccc = Main::instance();

		$content = $teccc->view(
			'optionsform',
			[
				'options' => self::fetch_options( $teccc ),
				'teccc'   => $teccc,
			],
			false
		);

		return $content;
	}

	/**
	 * Retrieves the options and pre-processes them to ensure we aren't trying to access non-existent
	 * indices (can result in notices being emitted).
	 *
	 * @param Main $teccc Class Main.
	 *
	 * @return array
	 */
	public static function fetch_options( Main $teccc ) {
		$options         = (array) get_option( 'teccc_options', [] );
		$categoryOptions = [
			'-background',
			'-background_none',
			'-border',
			'-border_none',
			'-text',
		];

		foreach ( $teccc->terms as $attributes ) {
			$slug = $attributes[ Main::SLUG ];

			foreach ( $categoryOptions as $optionkey ) {
				if ( ! isset( $options[ $slug . $optionkey ] ) ) {
					$options[ $slug . $optionkey ] = '';
				}
			}

			if ( ! isset( $options['hide'][ $slug ] ) ) {
				$options['hide'][ $slug ] = '';
			}
		}

		$generalOptions = [
			'featured-event',
			'featured-event_none',
			'add_legend',
			'add_legend_list_view',
			'add_legend_day_view',
			'chk_default_options_db',
			'custom_legend_css',
			'reset_show',
			'reset_label',
			'reset_url',
			'font_weight',
			'legend_superpowers',
			'show_ignored_cats_legend',
		];

		if ( class_exists( 'Tribe__Events__Pro__Main' ) ) {
			$ecp_settings = [
				'add_legend_week_view',
				'add_legend_photo_view',
				'add_legend_map_view',
				'add_legend_summary_view',
			];

			$generalOptions = array_merge( $generalOptions, $ecp_settings );
		}

		foreach ( $generalOptions as $optionkey ) {
			if ( ! isset( $options[ $optionkey ] ) ) {
				$options[ $optionkey ] = 'add_legend' === $optionkey ? [] : '';
			}
		}

		$options['featured-event'] = ! empty( $options['featured-event_none'] ) ? 'transparent' : $options['featured-event'];

		return $options;
	}

	/**
	 * Enqueue admin scripts and styles.
	 *
	 * @param string $hook Hook name.
	 *
	 * @return bool|void
	 */
	public function load_teccc_js_css( $hook ) {
		$tribe_events_pages = [ 'tribe_events_page_tribe-events-calendar', 'tribe_events_page_tribe-common', 'tribe_events_page_tec-events-settings' ];
		if ( ! in_array( $hook, $tribe_events_pages, true ) ) {
			return false;
		}

		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'wp-color-picker' );
		wp_enqueue_style( 'teccc-iris', $this->teccc->resources_url . '/teccc-iris.css', false, Main::$version );
		wp_enqueue_script( 'teccc-admin', $this->teccc->resources_url . '/teccc-admin.js', false, Main::$version, true );
		wp_enqueue_style( 'teccc-options', $this->teccc->resources_url . '/teccc-options.css', false, Main::$version );
	}
}
