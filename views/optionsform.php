<table class="teccc form-table">

	<style type="text/css">.form-table th { font-size: 12px; }</style>

		<tr>
			<th> <strong>Category Slug</strong> </th>
			<th> <strong>Border Color</strong> </th>
			<th> <strong>Background Color</strong> </th>
			<th> <strong>Text Color</strong> </th>
			<th> <strong>Current Display</strong> </th>
		</tr>

		<?php for ($i = 0; $i < $teccc->count; $i++): ?>
		<tr>
			<td> <?php esc_html_e($teccc->slugs[$i]) ?> </td>

			<td class="color-control">
				<div class="transparency">
					<label> <input name="teccc_options[<?php esc_attr_e($teccc->slugs[$i]) ?>-border_transparent]" type="checkbox" value="1" <?php echo checked('1', $options[$teccc->slugs[$i].'-border_transparent'], false) ?> /> Transparent </label> <br />
					<?php if (isset($options[$teccc->slugs[$i].'-border_transparent'])):
						$options[$teccc->slugs[$i].'-border'] = 'transparent'; ?>
					<?php endif ?>
 				</div>
				<div class="colorselector">
					<input type="minicolors" name="teccc_options[<?php esc_attr_e($teccc->slugs[$i]) ?>-border]" value="<?php esc_html_e($options[$teccc->slugs[$i].'-border']) ?>" />
 				</div>
			</td>

			<td class="color-control">
				<div class="transparency">
					<label> <input name="teccc_options[<?php esc_attr_e($teccc->slugs[$i]) ?>-background_transparent]" type="checkbox" value="1" <?php echo checked('1', $options[$teccc->slugs[$i].'-background_transparent'], false) ?> /> Transparent</label><br />
					<?php if (isset( $options[$teccc->slugs[$i].'-background_transparent'])):
						$options[$teccc->slugs[$i].'-background'] = 'transparent'; ?>
					<?php endif ?>
				</div>
				<div class="colorselector">
					<input type="minicolors" name="teccc_options[<?php esc_attr_e($teccc->slugs[$i]) ?>-background]" value="<?php esc_attr_e($options[$teccc->slugs[$i].'-background']) ?>" />
				</div>
			</td>

			<td>
				<select name="teccc_options[<?php esc_attr_e($teccc->slugs[$i]) ?>-text]">
				<?php foreach ($teccc->text_colors as $key => $value): ?>
					<option value="<?php esc_attr_e($value) ?>" <?php echo selected($value, $options[$teccc->slugs[$i].'-text'], false) ?> > <?php esc_html_e($key) ?> </option>
				<?php endforeach ?>
				</select>
			</td>

			<td>
				<span style="background-color: <?php esc_html_e($options[$teccc->slugs[$i].'-background']) ?>; border-left: 5px solid <?php esc_html_e($options[$teccc->slugs[$i].'-border']) ?>; border-right: 5px solid transparent; color:<?php esc_html_e($options[$teccc->slugs[$i].'-text']) ?>; padding: 0.5em 1em; font-weight: <?php esc_html_e($options['font_weight']) ?>;">
					<?php esc_html_e($teccc->names[$i]) ?>
				</span>
			</td>
		</tr>
	<?php endfor ?>

	<tr valign="top" style="border-top:#dddddd 1px solid;">
		<td colspan="5"> </td>
	</tr>

</table>

<div id="teccc_options">

	<div class="teccc_options_col1">Font-Weight Options</div>
		<div class="teccc_options_col2">
			<select name="teccc_options[font_weight]">
			<?php foreach ( $teccc->font_weights as $key => $value ): ?>
				<option value="<?php esc_attr_e($value) ?>" <?php echo selected($value, $options['font_weight'], false) ?>>
					<?php esc_html_e($key) ?>
				</option>
			<?php endforeach ?>
			</select>
		</div>

	<div class="teccc_options_col1">Add Category Legend</div>
		<div id="category_legend_setting" class="teccc_options_col2">
			<label><input name="teccc_options[add_legend]" type="checkbox" value="1" <?php echo checked('1', $options['add_legend'], false) ?> /> Check to add a Category Legend to the calendar. </label>
			<p>Remember to add `&lt;?php teccc_legend_hook(); ?&gt;` to your ecp-page-template.php</p>
		</div>
	
	<div class="teccc_options_col1 legend_related"><!-- Add Legend Superpowers --></div>
		<div class="teccc_options_col2 legend_related">
			<label> <input name="teccc_options[legend_superpowers]" type="checkbox" value="1" <?php echo checked('1', $options['legend_superpowers'], false) ?> /> Check to add Legend Superpowers. </label>
			<p>Legend Superpowers are an optional visual effect allowing visitors to focus only on those events that belong to categories of interest - without reloading the page and without eliminating other categories from view completely. Click on the category of interest in the Legend for the effect; click again to remove it.</p>
		</div>

	<div class="teccc_options_col1 legend_related"><label>Custom Legend CSS</label></div>
		<div class="teccc_options_col2 legend_related">
			<label> <input name="teccc_options[custom_legend_css]" type="checkbox" value="1" <?php echo checked('1', $options['custom_legend_css'], false) ?> /> Check to use your own CSS for category legend. </label>
		</div>
 
	<div class="teccc_options_col1">Database Options</div>
		<div class="teccc_options_col2">
			<label><input name="teccc_options[chk_default_options_db]" type="checkbox" value="1" <?php echo checked('1', $options['chk_default_options_db'], false) ?> /> Restore defaults upon plugin deactivation/reactivation </label>
			<p>Only check this if you want to reset plugin settings upon Plugin reactivation</p>
		</div>

</div>
