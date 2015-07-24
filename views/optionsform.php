<?php
namespace Fragen\Category_Colors;

$teccc   = Main::instance();
$options = Admin::fetch_options( $teccc );

?>
<table class="teccc form-table" xmlns="http://www.w3.org/1999/html">

	<style type="text/css">.form-table th { font-size: 12px; }</style>

		<tr>
			<th style="width:10px;"> <strong><?php esc_html_e( 'Hide', 'the-events-calendar-category-colors' ) ?></strong> </th>
			<th> <strong><?php esc_html_e( 'Category Slug', 'the-events-calendar-category-colors' ) ?></strong> </th>
			<th> <strong><?php esc_html_e( 'Border Color', 'the-events-calendar-category-colors' ) ?></strong> </th>
			<th> <strong><?php esc_html_e( 'Background Color', 'the-events-calendar-category-colors' ) ?></strong> </th>
			<th> <strong><?php esc_html_e( 'Text Color', 'the-events-calendar-category-colors' ) ?></strong> </th>
			<th> <strong><?php esc_html_e( 'Current Display', 'the-events-calendar-category-colors' ) ?></strong> </th>
		</tr>

		<?php foreach ( $teccc->all_terms as $id => $attributes ): ?>
			<?php
				$slug = esc_attr( $attributes[ Main::SLUG ] );
				$name = esc_attr( $attributes[ Main::NAME ] );
			?>
		<tr>
			<td>
				<label> <input name="teccc_options[hide][<?php echo $slug ?>]" type="checkbox" value="<?php echo $slug ?>" <?php checked( $slug, $options['hide'][ $slug ], true ) ?> /> </label>
			</td>

			<td> <?php echo $slug ?> </td>

			<td class="color-control">
				<div class="transparency">
					<label> <input name="teccc_options[<?php echo $slug ?>-border_transparent]" type="checkbox" value="1" <?php checked( '1', $options[ $slug . '-border_transparent' ], true ) ?> /> <?php esc_html_e( 'Transparent', 'the-events-calendar-category-colors' ) ?> </label> <br />
					<?php if ( '1' === $options[ $slug . '-border_transparent' ] ):
						$options[ $slug . '-border' ] = 'transparent'; ?>
					<?php endif ?>
 				</div>
				<div class="colorselector">
					<label> <input class="teccc-color-picker" type="text" name="teccc_options[<?php echo $slug ?>-border]" value="<?php esc_attr_e( $options[ $slug . '-border' ] ) ?>" /> </label>
 				</div>
			</td>

			<td class="color-control">
				<div class="transparency">
					<label> <input name="teccc_options[<?php echo $slug ?>-background_transparent]" type="checkbox" value="1" <?php checked( '1', $options[ $slug .'-background_transparent' ], true ) ?> /> <?php esc_html_e( 'Transparent', 'the-events-calendar-category-colors' ) ?> </label> <br />
					<?php if ( '1' === $options[ $slug .'-background_transparent' ] ):
						$options[ $slug .'-background' ] = 'transparent'; ?>
					<?php endif ?>
				</div>
				<div class="colorselector">
					<label> <input class="teccc-color-picker" type="text" name="teccc_options[<?php echo $slug ?>-background]" value="<?php esc_attr_e( $options[ $slug . '-background' ] ) ?>" /> </label>
				</div>
			</td>

			<td>
				<label> <select name="teccc_options[<?php echo $slug ?>-text]">
				<?php foreach ( $teccc->text_colors as $key => $value ): ?>
					<option value="<?php esc_attr_e( $value ) ?>" <?php selected( $value, $options[ $slug . '-text' ], true ) ?> > <?php esc_html_e( $key ) ?> </option>
				<?php endforeach ?>
				</select> </label>
			</td>

			<td>
				<span style="background-color: <?php esc_attr_e( $options[ $slug . '-background' ] ) ?>; border-left: 5px solid <?php esc_attr_e( $options[ $slug . '-border' ] ) ?>; border-right: 5px solid transparent; color:<?php esc_attr_e( $options[ $slug . '-text' ] ) ?>; padding: 0.5em 1em; font-weight: <?php esc_attr_e( $options['font_weight'] ) ?>;">
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

	<div class="teccc_options_col1"> <?php esc_html_e( 'Font-Weight Options', 'the-events-calendar-category-colors' ) ?> </div>
		<div class="teccc_options_col2">
			<label> <select name="teccc_options[font_weight]" id="teccc_font_weight">
			<?php foreach ( $teccc->font_weights as $key => $value ): ?>
				<option value="<?php esc_attr_e( $value ) ?>" <?php selected( $value, $options['font_weight'], true ) ?>>
					<?php esc_html_e( $key ) ?>
				</option>
			<?php endforeach ?>
			</select> </label>
		</div>

	<div class="teccc_options_col1"> <?php esc_html_e( 'Add Category Legend', 'the-events-calendar-category-colors' ) ?> </div>
		<div id="category_legend_setting" class="teccc_options_col2">
			<label> <input name="teccc_options[add_legend]" type="checkbox" value="1" <?php checked( '1', $options['add_legend'], true ) ?> /> <?php esc_html_e( 'Check to add a Category Legend to the calendar.', 'the-events-calendar-category-colors' ) ?> </label>
		</div>

	<div class="teccc_options_col1 legend_related"><!-- Add Legend Superpowers --></div>
		<div class="teccc_options_col2 legend_related">
			<label> <input name="teccc_options[legend_superpowers]" type="checkbox" value="1" <?php checked( '1', $options['legend_superpowers'], true ) ?> /> <?php esc_html_e( 'Check to add Legend Superpowers.', 'the-events-calendar-category-colors' ) ?> </label>
			<p> <?php esc_html_e( 'Legend Superpowers are an optional visual effect allowing visitors to focus only on those events that belong to categories of interest - without reloading the page and without eliminating other categories from view completely. Click on the category of interest in the Legend for the effect; click again to remove it.', 'the-events-calendar-category-colors' ) ?> </p>
		</div>

	<div class="teccc_options_col1 legend_related"><!-- Show Hidden Categories --></div>
	<div class="teccc_options_col2 legend_related">
		<label> <input name="teccc_options[show_ignored_cats_legend]" type="checkbox" value="1" <?php checked( '1', $options['show_ignored_cats_legend'], true ) ?> /> <?php esc_html_e( 'Show hidden categories in legend.', 'the-events-calendar-category-colors' ) ?> </label>
	</div>

	<div class="teccc_options_col1 legend_related"><!-- Custom Legend CSS --></div>
		<div class="teccc_options_col2 legend_related">
			<label> <input name="teccc_options[custom_legend_css]" type="checkbox" value="1" <?php checked( '1', $options['custom_legend_css'], true ) ?> /> <?php esc_html_e( 'Check to use your own CSS for category legend.', 'the-events-calendar-category-colors' ) ?> </label>
		</div>

	<div class="teccc_options_col1"><?php esc_html_e( 'Colorize Widgets', 'the-events-calendar-category-colors' ) ?></div>
		<div class="teccc_options_col2">
			<label> <input name="teccc_options[color_widgets]" type="checkbox" value="1" <?php checked( '1', $options['color_widgets'], true ) ?> /> <?php esc_html_e( 'Add Category Colors to widgets', 'the-events-calendar-category-colors' ) ?> </label>
		</div>

	<div class="teccc_options_col1"> <?php esc_html_e( 'Database Options', 'the-events-calendar-category-colors' ) ?> </div>
		<div class="teccc_options_col2">
			<label> <input name="teccc_options[chk_default_options_db]" type="checkbox" value="1" <?php checked( '1', $options['chk_default_options_db'], true ) ?> /> <?php esc_html_e( 'Restore defaults upon plugin deactivation/reactivation', 'the-events-calendar-category-colors' ) ?> </label>
			<p> <?php esc_html_e( 'Only check this if you want to reset plugin settings upon Plugin reactivation', 'the-events-calendar-category-colors' ) ?> </p>
		</div>

</div>
