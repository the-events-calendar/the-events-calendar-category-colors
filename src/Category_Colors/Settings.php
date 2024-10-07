<?php
/**
 * The Events Calendar: Category Colors - Settings.
 *
 * @package Fragen\Category_Colors
 */

namespace Fragen\Category_Colors;

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


		foreach ( (array) $this->teccc->all_terms as $option ) {
			$this->do_color_settings_row( $option );
		}

		$this->teccc_settings['tec_category_colors_table_end'] = [
			'type' => 'html',
			'html' => '</table>',
		];

		return $this->teccc_settings;
	}

	private function do_color_settings_row( $option ) {
		$slug = $option[ Main::SLUG ];
		$name = $option[ Main::NAME ];

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

	private function generate_field_name( $slug, $field ) {
		return esc_attr($slug) . '-' . esc_attr($field);
	}

	private function do_hide_cell( $slug, $name ) {

		$this->teccc_settings[ $this->generate_field_name( $slug, 'hide_cell_start' ) ] = [
			'type' => 'html',
			'html' => '<td>',
		];

		$this->teccc_settings[ $this->generate_field_name( $slug, 'hide' ) ] = [
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

	private function do_slug_cell( $slug ) {
		$this->teccc_settings[ "{$slug}_slug_cell" ] = [
			'type' => 'html',
			'html' => '<td>' . esc_html( $slug ) . '</td>',
		];
	}

	private function do_border_cell(  $slug, $name ) {
		$this->teccc_settings[ "{$slug}_border_cell_start" ] = [
			'type' => 'html',
			'html' => '<td class="color-control">',
		];

		$border_field_id = sanitize_title( $this->generate_field_name( $slug, 'border_none' ) );

		$this->teccc_settings[  $this->generate_field_name( $slug, 'border_none' ) ] = [
			'type'            => 'checkbox_bool',
			'label'           => esc_html__( 'No Border', 'the-events-calendar-category-colors' ),
			'default'         => false,
			'validation_type' => 'boolean',
			'parent_option'   => 'teccc_options',
			'attributes'      => [ 'id' => $border_field_id ],
		];

		$this->teccc_settings[ $this->generate_field_name( $slug, 'border' ) ] = [
			'type'                => 'text',
			'label'               => esc_html__( 'Border Color', 'the-events-calendar-category-colors' ),
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

	private function do_background_cell(  $slug, $name ) {
		$this->teccc_settings[ "{$slug}_background_cell_start" ] = [
			'type' => 'html',
			'html' => '<td class="color-control">',
		];

		$background_field_id = sanitize_title( $this->generate_field_name( $slug, 'background_none' ) );

		$this->teccc_settings[  $this->generate_field_name( $slug, 'background_none' ) ] = [
			'type'            => 'checkbox_bool',
			'label'           => esc_html__( 'No Background', 'the-events-calendar-category-colors' ),
			'default'         => false,
			'validation_type' => 'boolean',
			'parent_option'   => 'teccc_options',
			'attributes'      => [ 'id' => $background_field_id ],
		];

		$this->teccc_settings[ $this->generate_field_name( $slug, 'background' ) ] = [
			'type'                => 'text',
			'label'               => esc_html__( 'Background Color', 'the-events-calendar-category-colors' ),
			'class'               => 'color-selector',
			'validation_type'     => 'color',
			'attributes'          => [ 'id' => $this->generate_field_name( $slug, 'background' ), 'class' => 'teccc-color-picker' ],
			'can_be_empty'        => true,
			'parent_option'       => 'teccc_options',
		];

		$this->teccc_settings[ $this->generate_field_name( $slug, 'background-color-selector' ) ] = [
			'type' => 'html',
			'html' => '<div class=""></div>',
		];

		$this->teccc_settings[ "{$slug}_background_cell_end" ] = [
			'type' => 'html',
			'html' => '</td>',
		];
	}

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
			'parent_option'   => 'teccc_options',
			'can_be_empty'    => true,
		];

		$this->teccc_settings[ "{$slug}_text_cell_end" ] = [
			'type' => 'html',
			'html' => '</td>',
		];
	}

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
}

/*

			<tr>
				<td  colspan="2">
					<div><?php esc_html_e( 'Featured Event Color', 'the-events-calendar-category-colors' ); ?></div>
				</td>
				<td class="color-control">
					<div class="transparency">
						<label>
							<input name="teccc_options[featured-event_none]" type="checkbox" value="1" <?php checked( '1', $options['featured-event_none'] ); ?> /> <?php esc_html_e( 'Transparent', 'the-events-calendar-category-colors' ); ?>
						</label><br>
						<?php
						if ( '1' === $options['featured-event_none'] ) :
							$options['featured-event'] = 'transparent';
							?>
						<?php endif ?>
					</div>
					<div class="color-selector">
						<label>
							<input class="teccc-color-picker" type="text" name="teccc_options[featured-event]" value="<?php echo esc_attr( $options['featured-event'] ); ?>" />
						</label>
					</div>
				</td>
				<td colspan="2">
					<p><?php esc_html_e( 'Add right border for featured events.', 'the-events-calendar-category-colors' ); ?></p>
				</td>
			</tr>
			<tr valign="top" style="border-top:#dddddd 1px solid;">
				<td colspan="5"></td>
			</tr>

		</table>

		<div id="teccc_options">

			<div class="teccc_options_col1"> <?php esc_html_e( 'Font-Weight Options', 'the-events-calendar-category-colors' ); ?> </div>
			<div class="teccc_options_col2">
				<label> <select name="teccc_options[font_weight]" id="teccc_font_weight">
						<?php foreach ( (array) $teccc->font_weights as $key => $value ) : ?>
							<option value="<?php echo esc_attr( $value ); ?>" <?php selected( $value, $options['font_weight'] ); ?>>
								<?php esc_html_e( $key ); ?>
							</option>
						<?php endforeach ?>
					</select> </label>
			</div>

			<div id="category_legend_checkboxes">
				<div class="teccc_options_col1"> <?php esc_html_e( 'Show Category Legend', 'the-events-calendar-category-colors' ); ?> </div>
				<div id="category_legend_setting" class="teccc_options_col2">
					<input id="add_legend_month_view" name="teccc_options[add_legend][]" type="checkbox" value="month" <?php checked( 1, in_array( 'month', $options['add_legend'], true ) ); ?>>
					<label for="add_legend_month_view"><?php esc_html_e( 'Month view', 'the-events-calendar-category-colors' ); ?></label>
				</div>
				<div id="category_legend_setting_list_view" class="teccc_options_col2">
					<input id="add_legend_list_view" name="teccc_options[add_legend][]" type="checkbox" value="list" <?php checked( '1', in_array( 'list', $options['add_legend'], true ) ); ?>>
					<label for="add_legend_list_view"><?php esc_html_e( 'List view', 'the-events-calendar-category-colors' ); ?></label>
				</div>
				<div id="category_legend_setting_day_view" class="teccc_options_col2">
					<input id="add_legend_day_view" name="teccc_options[add_legend][]" type="checkbox" value="day" <?php checked( '1', in_array( 'day', $options['add_legend'], true ) ); ?>>
					<label for="add_legend_day_view"><?php esc_html_e( 'Day view', 'the-events-calendar-category-colors' ); ?></label>
				</div>

				<?php if ( class_exists( 'Tribe__Events__Pro__Main' ) ) : ?>
				<div id="category_legend_setting_week_view" class="teccc_options_col2">
					<input id="add_legend_week_view" name="teccc_options[add_legend][]" type="checkbox" value="week" <?php checked( '1', in_array( 'week', $options['add_legend'], true ) ); ?>>
					<label for="add_legend_week_view"><?php esc_html_e( 'Week view', 'the-events-calendar-category-colors' ); ?></label>
				</div>
				<div id="category_legend_setting_photo_view" class="teccc_options_col2">
					<input id="add_legend_photo_view" name="teccc_options[add_legend][]" type="checkbox" value="photo" <?php checked( '1', in_array( 'photo', $options['add_legend'], true ) ); ?>>
					<label for="add_legend_photo_view"><?php esc_html_e( 'Photo view', 'the-events-calendar-category-colors' ); ?></label>
				</div>
				<div id="category_legend_setting_map_view" class="teccc_options_col2">
					<input id="add_legend_map_view" name="teccc_options[add_legend][]" type="checkbox" value="map" <?php checked( '1', in_array( 'map', $options['add_legend'], true ) ); ?>>
					<label for="add_legend_map_view"><?php esc_html_e( 'Map view', 'the-events-calendar-category-colors' ); ?></label>
				</div>
				<div id="category_legend_setting_summary_view" class="teccc_options_col2">
					<input id="add_legend_summary_view" name="teccc_options[add_legend][]" type="checkbox" value="summary" <?php checked( '1', in_array( 'summary', $options['add_legend'], true ) ); ?>>
					<label for="add_legend_summary_view"><?php esc_html_e( 'Summary view', 'the-events-calendar-category-colors' ); ?></label>
				</div>
				<?php endif; ?>
			</div>

			<!-- Add Reset Button -->
			<div id="legend_reset_button">
			<div class="teccc_options_col1"> <?php esc_html_e( 'Reset Button', 'the-events-calendar-category-colors' ); ?> </div>
			<div class="teccc_options_col2 legend_related_notice">
				<?php esc_html_e( 'For this option you have to show the category legend at least on one view.', 'the-events-calendar-category-colors' ); ?>
			</div>
			<div class="teccc_options_col2 legend_related">
				<input id="teccc_options_reset_show" name="teccc_options[reset_show]" type="checkbox" value="1" <?php checked( '1', $options['reset_show'] ); ?> />
				<label for="teccc_options_reset_show"><?php esc_html_e( 'Show reset button', 'the-events-calendar-category-colors' ); ?></label>
			</div>
			<div class="teccc_options_col2 legend_related">
				<input id="teccc_options_reset_label" name="teccc_options[reset_label]" type="text" placeholder="<?php esc_html_e( 'Reset', 'the-events-calendar-category-colors' ); ?>" value="<?php echo esc_attr( $options['reset_label'] ); ?>" />
				<label for="teccc_options_reset_label"><?php esc_html_e( 'Reset button label', 'the-events-calendar-category-colors' ); ?></label>
			</div>
			<div class="teccc_options_col2 legend_related">
				<input id="teccc_options_reset_url" name="teccc_options[reset_url]" type="text" placeholder="<?php echo esc_attr( tribe_get_events_link() ); ?>" value="<?php echo esc_attr( $options['reset_url'] ); ?>" />
				<label for="teccc_options_reset_url"><?php esc_html_e( 'Reset button URL', 'the-events-calendar-category-colors' ); ?></label>
				<p><?php esc_html_e( 'By default the reset button will point to the default calendar URL.', 'the-events-calendar-category-colors' ); ?></p>
			</div>
			</div>

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
