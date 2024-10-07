<?php
/**
 * The Events Calendar: Category Colors - Settings.
 *
 * @package Fragen\Category_Colors
 */

namespace Fragen\Category_Colors;

use Tribe\Events\Views\V2\Manager;

/**
 * Settings class.
 *
 * Handles the setting form output.
 *
 * @since TBD
 */
class Settings {

	/**
	 * Holds an instance of the Main class.
	 *
	 * @since TBD
	 *
	 * @var Main
	 */
	private $teccc;

	/**
	 * Holds the options array.
	 *
	 * @since TBD
	 *
	 * @var array
	 */
	private $options;

	/**
	 * Holds the fields output for the settings form.
	 *
	 * @since TBD
	 *
	 * @var array<string,mixed>
	 */
	private $teccc_settings;

	/**
	 * Do the settings output (fields).
	 *
	 * Returns an array to be consumed by the TEC Settings API.
	 *
	 * @since TBD
	 *
	 * @return array<string,mixed> Array of settings fields.
	 */
	public function do_settings() {
		// Get the Main instance.
		$this->teccc = Main::instance();

		// Get the options.
		$this->options = get_option( 'teccc_options' );

		// Setup the terms.
		$this->teccc->setup_terms( $this->options );

		// Start the table.
		$this->teccc_settings = [
			'tec_category_colors__table_start' => [
				'type' => 'html',
				'html' => '<table class="teccc form-table tec-settings-form__content-section" xmlns="http://www.w3.org/1999/html">
				<tr>
					<th style="width:10px;">' . esc_html( 'Hide', 'the-events-calendar-category-colors' ) . '</th>
					<th>' . esc_html( 'Category Slug', 'the-events-calendar-category-colors' ) . '</th>
					<th>' . esc_html( 'Border Color', 'the-events-calendar-category-colors' ) . '</th>
					<th>' . esc_html( 'Background Color', 'the-events-calendar-category-colors' ) . '</th>
					<th>' . esc_html( 'Text Color', 'the-events-calendar-category-colors' ) . '</th>
					<th>' . esc_html( 'Current Display', 'the-events-calendar-category-colors' ) . '</th>
				</tr>',
				],
		];


		foreach ( (array) $this->teccc->all_terms as $term ) {
			$this->do_color_settings_row( $term );
		}

		$this->do_featured_event_row();

		$this->teccc_settings['tec_category_colors_table_end'] = [
			'type' => 'html',
			'html' => '</table>',
		];

		$this->do_additional_options();

		return $this->teccc_settings;
	}

	/**
	 * Output a color settings row.
	 *
	 * @since TBD
	 *
	 * @param [type] $option
	 * @return void
	 */
	private function do_color_settings_row( $term ) {
		$slug = $term[ Main::SLUG ];
		$name = $term[ Main::NAME ];

		$this->teccc_settings[ "{$slug}_row_start" ] = [
			'type' => 'html',
			'html' => '<tr>',
		];

		$this->do_hide_cell( $slug, $name );

		$this->do_slug_cell( $slug );

		$this->do_border_cell( $slug, $name );

		$this->do_background_cell( $slug, $name );

		$this->do_text_cell( $slug, $name );

		$this->do_current_display_cell( $slug, $name );

		$this->teccc_settings[ "{$slug}_row_end" ] = [
			'type' => 'html',
			'html' => '</tr>',
		];

		return $this->teccc_settings;
	}

	/**
	 * Generate a field name.
	 *
	 * @since TBD
	 *
	 * @param string $slug  The category slug.
	 * @param string $field The field name.
	 */
	private function generate_field_name( $slug, $field ): string {
		return esc_attr( $slug ) . '-' . esc_attr( $field );
	}

	/**
	 * Output the "hide" cell.
	 *
	 * @since TBD
	 *
	 * @param string $slug  The category slug.
	 * @param string $field The field name.
	 *
	 * @return void
	 */
	private function do_hide_cell( $slug, $name ) {

		$this->teccc_settings[ $this->generate_field_name( $slug, 'hide_cell_start' ) ] = [
			'type' => 'html',
			'html' => '<td>',
		];

		$this->teccc_settings[ "hide[{$slug}]" ] = [
			'type'            => 'checkbox_bool',
			'default'         => false,
			'validation_type' => 'boolean',
			'parent_option'   => 'teccc_options',
			'tooltip'         => sprintf(
				esc_html__( 'Hides the %s category on the front end.', 'the-events-calendar-category-colors' ),
				esc_html( $name )
			),
		];

		add_filter( 'tribe_field_tooltip', function( $tooltip, $field ) use ( $slug ) {
			if ( $this->generate_field_name( $slug, 'hide' ) === $field ) {
				return false;
			}

			return $tooltip;
		}, 10, 2 );

		$this->teccc_settings[ $this->generate_field_name( $slug, 'hide_cell_end' ) ] = [
			'type' => 'html',
			'html' => '</td>',
		];

		// Unset these if the category is hidden;
		if ( ! empty( $this->options['hide'][ $slug ] ) ) {
			$this->options[ "{$slug}-border_none" ]     = '';
			$this->options[ "{$slug}-background_none" ] = '';
		}
	}

	/**
	 * Output the slug display cell.
	 *
	 * @since TBD
	 *
	 * @param string $slug  The category slug.
	 * @return void
	 */
	private function do_slug_cell( $slug ) {
		$this->teccc_settings[ "{$slug}_slug_cell" ] = [
			'type' => 'html',
			'html' => '<td>' . esc_html( $slug ) . '</td>',
		];
	}

	/**
	 * Output the border color cell.
	 *
	 * @since TBD
	 *
	 * @param string $slug  The category slug.
	 * @param string $name  The category name.
	 *
	 * @return void
	 */
	private function do_border_cell(  $slug, $name ) {
		$this->teccc_settings[ "{$slug}_border_cell_start" ] = [
			'type' => 'html',
			'html' => '<td class="color-control">',
		];

		$border_field_id = sanitize_title( $this->generate_field_name( $slug, 'border_none' ) );

		$this->teccc_settings[  $this->generate_field_name( $slug, 'border_none' ) ] = [
			'type'            => 'checkbox_bool',
			'label'           => '',
			'tooltip'         => esc_html__( 'No Border', 'the-events-calendar-category-colors' ),
			'default'         => false,
			'validation_type' => 'boolean',
			'parent_option'   => 'teccc_options',
			'attributes'      => [ 'id' => $border_field_id ],
		];

		$this->teccc_settings[ $this->generate_field_name( $slug, 'border' ) ] = [
			'type'                => 'text',
			'label'               => '',
			'tooltip'             => esc_html__( 'Border Color', 'the-events-calendar-category-colors' ),
			'class'               => 'color-selector',
			'attributes'          => [ 'id' => $this->generate_field_name( $slug, 'border' ), 'class' => 'teccc-color-picker' ],
			'validation_type'     => 'color',
			'parent_option'       => 'teccc_options',
			'can_be_empty'        => true,
		];

		$this->teccc_settings[ "{$slug}_border_cell_end" ] = [
			'type' => 'html',
			'html' => '</td>',
		];
	}

	/**
	 * Output the background color cell.
	 *
	 * @since TBD
	 *
	 * @param string $slug  The category slug.
	 * @param string $name  The category name.
	 *
	 * @return void
	 */
	private function do_background_cell(  $slug, $name ) {
		$this->teccc_settings[ "{$slug}_background_cell_start" ] = [
			'type' => 'html',
			'html' => '<td class="color-control">',
		];

		$background_field_id = sanitize_title( $this->generate_field_name( $slug, 'background_none' ) );

		$this->teccc_settings[  $this->generate_field_name( $slug, 'background_none' ) ] = [
			'type'            => 'checkbox_bool',
			'label'           => '',
			'tooltip'         => esc_html__( 'No Background', 'the-events-calendar-category-colors' ),
			'default'         => false,
			'validation_type' => 'boolean',
			'parent_option'   => 'teccc_options',
			'attributes'      => [ 'id' => $background_field_id ],
		];

		$this->teccc_settings[ $this->generate_field_name( $slug, 'background' ) ] = [
			'type'                => 'text',
			'label'               => '',
			'tooltip'             => esc_html__( 'Background Color', 'the-events-calendar-category-colors' ),
			'class'               => 'color-selector',
			'validation_type'     => 'color',
			'attributes'          => [ 'id' => $this->generate_field_name( $slug, 'background' ), 'class' => 'teccc-color-picker' ],
			'can_be_empty'        => true,
			'parent_option'       => 'teccc_options',
		];

		$this->teccc_settings[ "{$slug}_background_cell_end" ] = [
			'type' => 'html',
			'html' => '</td>',
		];
	}

	/**
	 * Output the text color cell.
	 *
	 * @since TBD
	 *
	 * @param string $slug  The category slug.
	 * @param string $name  The category name.
	 *
	 * @return void
	 */
	private function do_text_cell(  $slug, $name ) {
		$this->teccc_settings[ "{$slug}_text_cell_start" ] = [
			'type' => 'html',
			'html' => '<td>',
		];

		$this->teccc_settings[ "{$slug}_text" ] = [
			'type'            => 'dropdown',
			'tooltip_first'   => true,
			'tooltip'         => esc_html__( 'Text Color', 'the-events-calendar-category-colors' ),
			'options'         => array_flip( $this->teccc->text_colors ),
			'default'         => 'no_color',
			'validation_type' => 'options',
			'size'            => 'small',
			'parent_option'   => 'teccc_options',
			'can_be_empty'    => true,
		];

		$this->teccc_settings[ "{$slug}_text_cell_end" ] = [
			'type' => 'html',
			'html' => '</td>',
		];
	}

	/**
	 * Output the current display cell. This is a live demo of the row settings.
	 *
	 * @since TBD
	 *
	 * @param string $slug  The category slug.
	 * @param string $name  The category name.
	 *
	 * @return void
	 */
	private function do_current_display_cell(  $slug, $name ) {
		$style  = '';

		if ( ! empty( $this->options[ "{$slug}-background" ] ) ) {
			$option = $this->options[ "{$slug}-background" ];
			$style .= "background-color: {$option};";
		};

		if ( ! empty( $this->options[ "{$slug}-border" ] ) ) {
			$option = $this->options[ "{$slug}-border" ];
			$style .= "border-left: 5px solid {$option};";
		};

		$text_color = $this->options[ "{$slug}-text" ]?? 'no_color';

		if ( 'no_color' !== $text_color ) {
			$option = $this->options[ "{$slug}-text" ];
			$style .= "color: {$option};";
		};

		$option = $this->options[ 'font_weight' ]?? 'bold';
		$style .= "border-right: 5px solid transparent; font-weight: {$option}; padding: 0.5em 1em;";

		$this->teccc_settings[ "{$slug}_current_display_cell" ] = [
			'type' => 'html',
			'html' => '<td>' . esc_html( $name ) . '</td>',
		];
	}

	/**
	 * Output the featured event row.
	 *
	 * @since TBD
	 *
	 * @return void
	 */
	private function do_featured_event_row() {
		$this->teccc_settings[ 'featured_event_row_start' ] = [
			'type' => 'html',
			'html' => '<tr>',
		];

		$this->teccc_settings[ 'featured_event_cell_start' ] = [
			'type' => 'html',
			'html' => '<td colspan="2">',
		];

		$this->teccc_settings[ 'featured_event_label' ] = [
			'type' => 'html',
			'html' => '<div>' . esc_html__( 'Featured Event Color', 'the-events-calendar-category-colors' ) . '</div>',
		];

		$this->teccc_settings[ 'featured_event_cell_end' ] = [
			'type' => 'html',
			'html' => '</td>',
		];

		$this->teccc_settings[ 'featured_event_color_control_start' ] = [
			'type' => 'html',
			'html' => '<td class="color-control" colspan="2">',
		];

		$featured_border_field_id = sanitize_title( 'featured-event_none' );

		$this->teccc_settings[  'featured-event_none' ] = [
			'type'            => 'checkbox_bool',
			'label'           => '',//
			'tooltip'         => esc_html__( 'Transparent', 'the-events-calendar-category-colors' ),
			'default'         => false,
			'validation_type' => 'boolean',
			'parent_option'   => 'teccc_options',
			'attributes'      => [ 'id' => $featured_border_field_id ],
		];

		$this->teccc_settings[ 'featured-event' ] = [
			'type'                => 'text',
			'label'               => '',
			'class'               => 'color-selector',
			'attributes'          => [ 'id' => 'featured-event', 'class' => 'teccc-color-picker' ],
			'validation_type'     => 'color',
			'parent_option'       => 'teccc_options',
			'tooltip'             => esc_html__( 'Add right border for featured events.', 'the-events-calendar-category-colors' ),
			'can_be_empty'        => true,
		];

		$this->teccc_settings[ 'featured_event_color_control_end' ] = [
			'type' => 'html',
			'html' => '</td>',
		];
	}

	/**
	 * Output the additional options.
	 *
	 * @since TBD
	 *
	 * @return void
	 */
	private function do_additional_options() {
		$this->teccc_settings['additional_options_title'] = [
		'type' => 'html',
		'html' => '<h3 id="teccc-settings-additional-options" class="tec-settings-form__section-header">' . esc_html_x( 'Additional Options', 'Additional options settings section header', 'the-events-calendar-category-colors' ) . '</h3>',
		];

		$this->teccc_settings['font_weight'] = [
			'type'            => 'dropdown',
			'label'           => __( 'Font-Weight Options', 'the-events-calendar-category-colors' ),
			'tooltip'         => __( 'Choose the font weight for the category legend.', 'the-events-calendar-category-colors' ),
			'options'         => $this->teccc->font_weights,
			'attributes'      => [ 'id' => 'teccc_font_weight' ],
			'parent_option'   => 'teccc_options',
		];

		$this->teccc_settings['add_legend'] = [
			'type'            => 'checkbox_list',
			'label'           => __( 'Show Category Legend', 'the-events-calendar-category-colors' ),
			'tooltip'         => __( 'Choose where to show the category legend.', 'the-events-calendar-category-colors' ),
			'parent_option'   => 'teccc_options',
			'validation_type' => 'options_multi',
			'options'         => array_map(
				static function ( $view ) {
					return tribe( Manager::class )->get_view_label_by_class( $view );
				},
				tribe( Manager::class )->get_publicly_visible_views()
			),
		];

		$this->teccc_settings['reset_options_title'] = [
			'type' => 'html',
			'html' => '<h3 id="teccc-settings-additional-options" class="tec-settings-form__section-header">' . esc_html_x( 'Reset Options', 'Reset options settings section header', 'the-events-calendar-category-colors' ) . '</h3>',
		];

		$this->teccc_settings['reset_show'] = [
			'type'            => 'checkbox_bool',
			'label'           => __( 'Show Reset Button', 'the-events-calendar-category-colors' ),
			'default'         => false,
			'validation_type' => 'boolean',
			'parent_option'   => 'teccc_options',
		];

		$this->teccc_settings['reset_label'] = [
			'type'            => 'text',
			'label'           => __( 'Reset Button Label', 'the-events-calendar-category-colors' ),
			'parent_option'   => 'teccc_options',

		];

		$this->teccc_settings['reset_url'] = [
			'type'            => 'text',
			'label'           => __( 'Reset Button URL', 'the-events-calendar-category-colors' ),
			'tooltip'         => __( 'By default the reset button will point to the default calendar URL.', 'the-events-calendar-category-colors' ),
			'placeholder'     => tribe_get_events_link(),
			'parent_option'   => 'teccc_options',
		];

		$this->teccc_settings['legend_superpowers_options_title'] = [
			'type' => 'html',
			'html' => '<h3 id="teccc-settings-legend-superpowers-options" class="tec-settings-form__section-header">' . esc_html_x( 'Legend Superpowers', 'Legend Superpowers settings section header', 'the-events-calendar-category-colors' ) . '</h3>',
			];

		$this->teccc_settings['legend_superpowers'] = [
			'type'            => 'checkbox_bool',
			'label'           => __( 'Legend Superpowers', 'the-events-calendar-category-colors' ),
			'default'         => false,
			'validation_type' => 'boolean',
			'parent_option'   => 'teccc_options',
		];

		$this->teccc_settings['show_ignored_cats_legend'] = [
			'type'            => 'checkbox_bool',
			'label'           => __( 'Show hidden categories in legend', 'the-events-calendar-category-colors' ),
			'default'         => false,
			'validation_type' => 'boolean',
			'parent_option'   => 'teccc_options',
		];

		$this->teccc_settings['custom_legend_css'] = [
			'type'            => 'checkbox_bool',
			'label'           => __( 'Check to use your own CSS for category legend', 'the-events-calendar-category-colors' ),
			'default'         => false,
			'validation_type' => 'boolean',
			'parent_option'   => 'teccc_options',
		];

		$this->teccc_settings['database_options_title'] = [
			'type' => 'html',
			'html' => '<h3 id="teccc-settings-database-options" class="tec-settings-form__section-header">' . esc_html_x( 'Database Options', 'Database options settings section header', 'the-events-calendar-category-colors' ) . '</h3>',
		];

		$this->teccc_settings['chk_default_options_db'] = [
			'type'            => 'checkbox_bool',
			'label'           => __( 'Restore defaults upon plugin deactivation/reactivation', 'the-events-calendar-category-colors' ),
			'tooltip'         => __( 'Only check this if you want to reset plugin settings upon Plugin reactivation!', 'the-events-calendar-category-colors' ),
			'default'         => false,
			'validation_type' => 'boolean',
			'parent_option'   => 'teccc_options',
		];
	}
}

/*

		<div id="teccc_options">



			<!-- Add Legend Superpowers -->
			<div id="category_legend_superpowers">
			<div class="teccc_options_col1"> <?php esc_html_e( 'Legend Superpowers', 'the-events-calendar-category-colors' ); ?> </div>
			<div class="teccc_options_col2 legend_related_notice">
				<?php esc_html_e( 'For this option you have to show the category legend at least on one view.', 'the-events-calendar-category-colors' ); ?>
			</div>
			<div class="teccc_options_col2 legend_related legend_superpowers">
				<label>
					<input name="teccc_options[legend_superpowers]" type="checkbox" value="1" <?php checked( '1', $options['legend_superpowers'] ); ?> /> <?php esc_html_e( 'Check to add Legend Superpowers.', 'the-events-calendar-category-colors' ); ?>
				</label>
				<p><?php esc_html_e( 'Legend Superpowers are an optional visual effect allowing visitors to focus only on those events that belong to categories of interest - without reloading the page and without eliminating other categories from view completely. Click on the category of interest in the Legend for the effect; click again to remove it.', 'the-events-calendar-category-colors' ); ?> </p>
			</div>

			<div class="teccc_options_col1 legend_related legend_related_superpowers"><!-- Show Hidden Categories --></div>
			<div class="teccc_options_col2 legend_related legend_related_superpowers">
				<label>
					<input name="teccc_options[show_ignored_cats_legend]" type="checkbox" value="1" <?php checked( '1', $options['show_ignored_cats_legend'] ); ?> /> <?php esc_html_e( 'Show hidden categories in legend.', 'the-events-calendar-category-colors' ); ?>
				</label>
			</div>

			<div class="teccc_options_col1 legend_related legend_related_superpowers"><!-- Custom Legend CSS --></div>
			<div class="teccc_options_col2 legend_related legend_related_superpowers">
				<label>
					<input name="teccc_options[custom_legend_css]" type="checkbox" value="1" <?php checked( '1', $options['custom_legend_css'] ); ?> /> <?php esc_html_e( 'Check to use your own CSS for category legend.', 'the-events-calendar-category-colors' ); ?>
				</label>
			</div>
			</div>

			<div class="teccc_options_col1"> <?php esc_html_e( 'Database Options', 'the-events-calendar-category-colors' ); ?> </div>
			<div class="teccc_options_col2">
				<label>
					<input name="teccc_options[chk_default_options_db]" type="checkbox" value="1" <?php checked( '1', $options['chk_default_options_db'] ); ?> /> <?php esc_html_e( 'Restore defaults upon plugin deactivation/reactivation', 'the-events-calendar-category-colors' ); ?>
				</label>
				<p> <?php esc_html_e( 'Only check this if you want to reset plugin settings upon Plugin reactivation', 'the-events-calendar-category-colors' ); ?> </p>
			</div>

		</div>
*/
