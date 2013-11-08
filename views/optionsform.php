<table class="teccc form-table">

	<style type="text/css">.form-table th { font-size: 12px; }</style>

		<tr>
			<th> <strong><?php _e( 'Category Slug', 'events-calendar-category-colors' ) ?></strong> </th>
			<th> <strong><?php _e( 'Border Color', 'events-calendar-category-colors' ) ?></strong> </th>
			<th> <strong><?php _e( 'Background Color', 'events-calendar-category-colors' ) ?></strong> </th>
			<th> <strong><?php _e( 'Text Color', 'events-calendar-category-colors' ) ?></strong> </th>
			<th> <strong><?php _e( 'Current Display', 'events-calendar-category-colors' ) ?></strong> </th>
		</tr>

		<?php if ( empty( $teccc->terms) ): ?>
			<div class="error" style="text-align:center;padding:1em;"> <?php _e( 'You must have at least one event with a category for The Events Calendar Category Colors plugin to function.', 'events-calendar-category-colors' ) ?> </div>
		<?php endif ?>

		<?php foreach ( $teccc->terms as $id => $attributes ): ?>
			<?php
				$slug = esc_attr( $attributes[Tribe_Events_Category_Colors::SLUG] );
				$name = esc_attr( $attributes[Tribe_Events_Category_Colors::NAME] );
			?>
		<tr>
			<td> <?php echo $slug ?> </td>

			<td class="color-control">
				<div class="transparency">
					<label> <input name="teccc_options[<?php echo $slug ?>-border_transparent]" type="checkbox" value="1" <?php echo checked('1', $options[$slug.'-border_transparent'], false) ?> /> <?php _e( 'Transparent', 'events-calendar-category-colors' ) ?> </label> <br />
					<?php if ( isset( $options[$slug.'-border_transparent'] ) ):
						$options[$slug.'-border'] = 'transparent'; ?>
					<?php endif ?>
 				</div>
				<div class="colorselector">
					<input class="teccc-color-picker" type="text" name="teccc_options[<?php echo $slug ?>-border]" value="<?php esc_html_e($options[$slug.'-border']) ?>" />
 				</div>
			</td>

			<td class="color-control">
				<div class="transparency">
					<label> <input name="teccc_options[<?php echo $slug ?>-background_transparent]" type="checkbox" value="1" <?php echo checked( '1', $options[$slug.'-background_transparent'], false ) ?> /> <?php _e( 'Transparent', 'events-calendar-category-colors' ) ?> </label><br />
					<?php if ( isset( $options[$slug.'-background_transparent'] ) ):
						$options[$slug.'-background'] = 'transparent'; ?>
					<?php endif ?>
				</div>
				<div class="colorselector">
					<input class="teccc-color-picker" type="text" name="teccc_options[<?php echo $slug ?>-background]" value="<?php esc_attr_e( $options[$slug.'-background'] ) ?>" />
				</div>
			</td>

			<td>
				<select name="teccc_options[<?php echo $slug ?>-text]">
				<?php foreach ( $teccc->text_colors as $key => $value ): ?>
					<option value="<?php esc_attr_e( $value ) ?>" <?php echo selected( $value, $options[$slug.'-text'], false ) ?> > <?php esc_html_e( $key ) ?> </option>
				<?php endforeach ?>
				</select>
			</td>

			<td>
				<span style="background-color: <?php esc_html_e( $options[$slug.'-background'] ) ?>; border-left: 5px solid <?php esc_html_e( $options[$slug.'-border'] ) ?>; border-right: 5px solid transparent; color:<?php esc_html_e( $options[$slug.'-text'] ) ?>; padding: 0.5em 1em; font-weight: <?php esc_html_e( $options['font_weight'] ) ?>;">
					<?php echo $name ?>
				</span>
			</td>
		</tr>
	<?php endforeach ?>

	<tr valign="top" style="border-top:#dddddd 1px solid;">
		<td colspan="5"></td>
	</tr>

</table>

<div id="teccc_options">

	<div class="teccc_options_col1"> <?php _e( 'Font-Weight Options', 'events-calendar-category-colors' ) ?> </div>
		<div class="teccc_options_col2">
			<select name="teccc_options[font_weight]" id="teccc_font_weight">
			<?php foreach ( $teccc->font_weights as $key => $value ): ?>
				<option value="<?php esc_attr_e( $value ) ?>" <?php echo selected( $value, $options['font_weight'], false ) ?>>
					<?php esc_html_e( $key ) ?>
				</option>
			<?php endforeach ?>
			</select>
		</div>

	<div class="teccc_options_col1"> <?php _e( 'Add Category Legend', 'events-calendar-category-colors' ) ?> </div>
		<div id="category_legend_setting" class="teccc_options_col2">
			<label><input name="teccc_options[add_legend]" type="checkbox" value="1" <?php echo checked( '1', $options['add_legend'], false ) ?> /> <?php _e( 'Check to add a Category Legend to the calendar.', 'events-calendar-category-colors' ) ?> </label>
		</div>
	
	<div class="teccc_options_col1 legend_related"><!-- Add Legend Superpowers --></div>
		<div class="teccc_options_col2 legend_related">
			<label> <input name="teccc_options[legend_superpowers]" type="checkbox" value="1" <?php echo checked( '1', $options['legend_superpowers'], false ) ?> /> <?php _e( 'Check to add Legend Superpowers.', 'events-calendar-category-colors' ) ?> </label>
			<p> <?php _e( 'Legend Superpowers are an optional visual effect allowing visitors to focus only on those events that belong to categories of interest - without reloading the page and without eliminating other categories from view completely. Click on the category of interest in the Legend for the effect; click again to remove it.', 'events-calendar-category-colors' ) ?> </p>
		</div>

	<div class="teccc_options_col1 legend_related"><label> <?php _e( 'Custom Legend CSS', 'events-calendar-category-colors' ) ?> </label></div>
		<div class="teccc_options_col2 legend_related">
			<label> <input name="teccc_options[custom_legend_css]" type="checkbox" value="1" <?php echo checked( '1', $options['custom_legend_css'], false ) ?> /> <?php _e( 'Check to use your own CSS for category legend.', 'events-calendar-category-colors' ) ?> </label>
		</div>
 
	<div class="teccc_options_col1"> <?php _e( 'Database Options', 'events-calendar-category-colors' ) ?> </div>
		<div class="teccc_options_col2">
			<label><input name="teccc_options[chk_default_options_db]" type="checkbox" value="1" <?php echo checked( '1', $options['chk_default_options_db'], false ) ?> /> <?php _e( 'Restore defaults upon plugin deactivation/reactivation', 'events-calendar-category-colors' ) ?> </label>
			<p> <?php _e( 'Only check this if you want to reset plugin settings upon Plugin reactivation', 'events-calendar-category-colors' ) ?> </p>
		</div>

</div>
