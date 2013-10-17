<div id="legend_box" class="tribe-events-calendar">

	<ul id="legend">

		<?php foreach ( $teccc->terms as $id => $attributes ): ?>
			<?php
				$slug = esc_attr($attributes[Tribe_Events_Category_Colors::SLUG]);
				$name = esc_attr($attributes[Tribe_Events_Category_Colors::NAME]);
			?>
			<li class="tribe-events-category-<?php echo $slug ?> tribe-events-category-<?php esc_attr_e($id) ?>">
				<a href="<?php esc_attr_e( $tec->getLink().trailingslashit( sanitize_title( __( 'category', 'events-calendar-category-colors' ) ) ) .$slug ) ?>">
					<?php echo $name ?>
				</a>
				<input type="hidden" value="<?php echo $slug ?>" />
			</li>

		<?php endforeach ?>

	</ul>

</div>