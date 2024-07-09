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

$teccc->setup_terms( $options );

?>
<table class="teccc form-table" xmlns="http://www.w3.org/1999/html">

	<style type="text/css">.form-table th {
			font-size: 12px;
		}</style>

	<tr>
		<th style="width:10px;"><strong><?php esc_html_e( 'Hide', 'the-events-calendar-category-colors' ); ?></strong>
		</th>
		<th><strong><?php esc_html_e( 'Category Slug', 'the-events-calendar-category-colors' ); ?></strong></th>
		<th><strong><?php esc_html_e( 'Border Color', 'the-events-calendar-category-colors' ); ?></strong></th>
		<th><strong><?php esc_html_e( 'Background Color', 'the-events-calendar-category-colors' ); ?></strong></th>
		<th><strong><?php esc_html_e( 'Text Color', 'the-events-calendar-category-colors' ); ?></strong></th>
		<th><strong><?php esc_html_e( 'Current Display', 'the-events-calendar-category-colors' ); ?></strong></th>
	</tr>

	<?php foreach ( (array) $teccc->all_terms as $attributes ) : ?>
		<?php
		$slug = $attributes[ Main::SLUG ];
		$name = $attributes[ Main::NAME ];
		?>
		<tr>
			<td>
				<label>
					<input name="teccc_options[hide][<?php echo esc_attr( $slug ); ?>]" type="checkbox" value="<?php echo esc_attr( $slug ); ?>" <?php checked( $slug, $options['hide'][ $slug ] ); ?> />
				</label>
				<?php
				if ( ! empty( $options['hide'][ $slug ] ) ) {
					$options[ "{$slug}-border_none" ]     = isset( $options[ "{$slug}-border_none" ] ) ? $options[ "{$slug}-border_none" ] : '';
					$options[ "{$slug}-background_none" ] = isset( $options[ "{$slug}-background_none" ] ) ? $options[ "{$slug}-background_none" ] : '';
				}
				?>
			</td>

			<td> <?php echo esc_html( $slug ); ?> </td>

			<td class="color-control">
				<div class="transparency">
					<label>
						<input name="teccc_options[<?php echo esc_attr( $slug ); ?>-border_none]" type="checkbox" value="1" <?php checked( '1', $options[ "{$slug}-border_none" ] ); ?> /> <?php esc_html_e( 'No Border', 'the-events-calendar-category-colors' ); ?>
					</label><br>
					<?php
					if ( '1' === $options[ "{$slug}-border_none" ] ) :
						$options[ "{$slug}-border" ] = '';
						?>
					<?php endif ?>
				</div>
				<div class="colorselector">
					<label>
						<input class="teccc-color-picker" type="text" name="teccc_options[<?php echo esc_attr( $slug ); ?>-border]" value="<?php echo esc_attr( $options[ "{$slug}-border" ] ); ?>" />
					</label>
				</div>
			</td>

			<td class="color-control">
				<div class="transparency">
					<label>
						<input name="teccc_options[<?php echo esc_attr( $slug ); ?>-background_none]" type="checkbox" value="1" <?php checked( '1', $options[ "{$slug}-background_none" ] ); ?> /> <?php esc_html_e( 'No Background', 'the-events-calendar-category-colors' ); ?>
					</label><br>
					<?php
					if ( '1' === $options[ "{$slug}-background_none" ] ) :
						$options[ "{$slug}-background" ] = '';
						?>
					<?php endif ?>
				</div>
				<div class="colorselector">
					<label>
						<input class="teccc-color-picker" type="text" name="teccc_options[<?php echo esc_attr( $slug ); ?>-background]" value="<?php echo esc_attr( $options[ "{$slug}-background" ] ); ?>" />
					</label>
				</div>
			</td>

			<td>
				<label> <select name="teccc_options[<?php echo esc_attr( $slug ); ?>-text]">
						<?php foreach ( (array) $teccc->text_colors as $key => $value ) : ?>
							<option value="<?php echo esc_attr( $value ); ?>" <?php selected( $value, $options[ "{$slug}-text" ] ); ?> > <?php esc_html_e( $key ); ?> </option>
						<?php endforeach ?>
					</select> </label>
			</td>

			<td>
				<span style="
				<?php if ( ! empty( $options[ "{$slug}-background" ] ) ) : ?>
					background-color: <?php echo esc_attr( $options[ $slug . '-background' ] ); ?>;
				<?php endif ?>
				<?php if ( ! empty( $options[ "{$slug}-border" ] ) ) : ?>
					border-left: 5px solid <?php echo esc_attr( $options[ "{$slug}-border" ] ); ?>;
				<?php endif ?>
					border-right: 5px solid transparent;
				<?php if ( 'no_color' !== $options[ "{$slug}-text" ] ) : ?>
					color:<?php echo esc_attr( $options[ "{$slug}-text" ] ); ?>;
				<?php endif ?>
					padding: 0.5em 1em;
					font-weight: <?php echo esc_attr( $options['font_weight'] ); ?>;">
					<?php echo esc_html( $name ); ?>
				</span>
			</td>
		</tr>
	<?php endforeach ?>

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
			<div class="colorselector">
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
		<input name="teccc_options[reset_show]" type="checkbox" value="1" <?php checked( '1', $options['reset_show'] ); ?> />
		<label for="teccc_options[reset_show]"><?php esc_html_e( 'Show reset button', 'the-events-calendar-category-colors' ); ?></label>
	</div>
	<div class="teccc_options_col2 legend_related">
		<input name="teccc_options[reset_label]" type="text" placeholder="<?php esc_html_e( 'Reset', 'the-events-calendar-category-colors' ); ?>" value="<?php echo esc_attr( $options['reset_label'] ); ?>" />
		<label for="teccc_options[reset_label]"><?php esc_html_e( 'Reset button label', 'the-events-calendar-category-colors' ); ?></label>
	</div>
	<div class="teccc_options_col2 legend_related">
		<input name="teccc_options[reset_url]" type="text" placeholder="<?php echo esc_attr( tribe_get_events_link() ); ?>" value="<?php echo esc_attr( $options['reset_url'] ); ?>" />
		<label for="teccc_options[reset_url]"><?php esc_html_e( 'Reset button URL', 'the-events-calendar-category-colors' ); ?></label>
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
