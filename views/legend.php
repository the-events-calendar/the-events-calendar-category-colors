<div id="legend_box" class="tribe-events-calendar">

	<ul id="legend">

		<?php for ($i = 0; $i < $teccc->count; $i++): ?>

			<li class="tribe-events-category-<?php esc_attr_e($teccc->slugs[$i]) ?> tribe-events-category-<?php esc_attr_e($teccc->IDs[$i]) ?>">
				<a href="<?php esc_attr_e($tec->getLink().trailingslashit(sanitize_title(__( 'category', 'tribe-events-calendar' ))).$teccc->slugs[$i]) ?>">
					<?php esc_html_e($teccc->names[$i]) ?>
				</a>
				<input type="hidden" value="<?php esc_attr_e($teccc->slugs[$i]) ?>" />
			</li>

		<?php endfor ?>

	</ul>

</div>