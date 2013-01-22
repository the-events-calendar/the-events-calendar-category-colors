<div id="legend_box" class="tribe-events-calendar">

	<ul id="legend">

		<?php for ($i = 0; $i < $teccc->count; $i++): ?>

			<li class="cat_<?php esc_attr_e($teccc->slugs[$i]) ?>">
				<a href="<?php esc_attr_e($tec->getLink().trailingslashit(sanitize_title(__( 'category', 'tribe-events-calendar' ))).$teccc->slugs[$i]) ?>">
					<?php esc_html_e($teccc->names[$i]) ?>
				</a>
				<?php if ($legendData): ?>
					<input type="hidden" value="<?php esc_attr_e($teccc->slugs[$i]) ?>" />
				<?php endif ?>
			</li>

		<?php endfor ?>

	</ul>

</div>