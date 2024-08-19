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

$teccc->setup_terms( $options );

/*
 * Filter terms for legend.
 *
 * @param array $terms Unordered array of terms, slug/name.
 */
$terms = apply_filters( 'teccc_legend_terms', $teccc->terms );

?>
<div id="legend_box" class="teccc-legend">

	<ul id="legend">

		<?php foreach ( $terms as $attributes ) : ?>
			<?php
			$slug     = $attributes[ Main::SLUG ];
			$name     = $attributes[ Main::NAME ];
			$link_url = get_term_link( $attributes[ Main::SLUG ], Tribe__Events__Main::TAXONOMY );
			?>
			<li class="tribe-events-category-<?php echo esc_attr( $slug ); ?> tribe_events_cat-<?php echo esc_attr( $slug ); ?>">
				<a href="<?php echo esc_attr( $link_url ); ?>">
					<?php echo esc_html( $name ); ?>
				</a>
				<input type="hidden" value="<?php echo esc_attr( $slug ); ?>" />
			</li>
		<?php endforeach ?>

		<?php if ( ! empty( $options['show_ignored_cats_legend'] ) ) : ?>
			<?php foreach ( $teccc->ignored_terms as $ignored_term ) : ?>
				<?php
				$slug     = $ignored_term[ Main::SLUG ];
				$name     = $ignored_term[ Main::NAME ];
				$link_url = get_term_link( $ignored_term[ Main::SLUG ], Tribe__Events__Main::TAXONOMY );
				if ( is_wp_error( $link_url ) ) {
					continue;
				}
				?>
				<li class="teccc-hidden-category">
					<a href="<?php echo esc_attr( $link_url ); ?>">
						<?php echo esc_html( $name ); ?>
					</a>
					<input type="hidden" value="<?php echo esc_attr( $slug ); ?>" />
				</li>
			<?php endforeach ?>
		<?php endif ?>

		<?php if ( isset( $options['reset_show'] ) && empty( $options['legend_superpowers'] ) ) : ?>
			<li class="teccc-reset">
				<a href="
				<?php
				if ( ! isset( $options['reset_url'] ) || empty( $options['reset_url'] ) ) {
					echo esc_attr( tribe_get_events_link() );
				} else {
					echo esc_attr( $options['reset_url'] );
				}
				?>
				">
					<?php
					if ( ! isset( $options['reset_label'] ) || empty( $options['reset_label'] ) ) {
						esc_html_e( 'Reset', 'the-events-calendar-category-colors' );
					} else {
						echo esc_html( $options['reset_label'] );
					}
					?>
				</a>
			</li>
		<?php endif; ?>

	</ul>

</div>
