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

use Fragen\Category_Colors\CSS\Base_CSS;
use Fragen\Category_Colors\CSS\Extras;
use Fragen\Category_Colors\CSS\Widgets;
use Fragen\Category_Colors\CSS\Pro;
use Fragen\Category_Colors\CSS\V2_Views;

?>
/* The Events Calendar: Category Colors <?php echo esc_html( Main::$version ); ?> */
.teccc-legend a, .tribe-events-calendar a, #tribe-events-content .tribe-events-tooltip h4
{
	font-weight: <?php echo esc_attr( $options['font_weight'] ); ?>;
}

.tribe-events-list .vevent.hentry h2 {
	padding-left: 5px;
}

<?php Extras::add_mobile_css(); ?>

<?php Pro::fix_default_week_background(); ?>

<?php V2_Views::add_v2_multiday_background_color(); ?>

<?php Pro::fix_multiday_week_background_color(); ?>

<?php V2_Views::fix_spacer_background(); ?>

<?php Pro::fix_pro_spacer_background(); ?>

<?php Extras::add_new_featured_event( $options ); ?>

<?php Pro::add_new_featured_event( $options ); ?>

<?php
if ( empty( $teccc->terms ) && ! empty( $options['terms'] ) ) {
	$teccc->terms = $options['terms'];
}
?>

<?php foreach ( $teccc->terms as $attributes ) : ?>
	<?php
	$slug = $attributes[ Main::SLUG ];
	$name = $attributes[ Main::NAME ];
	?>

	<?php Extras::fix_category_link_css( $slug ); ?>
	<?php Extras::add_list_link_css( $slug, ',' ); ?>
	<?php Extras::override_customizer( $slug, ',' ); ?>
	<?php // Extras::add_deprecated_link_css( $slug ,','); ?>
	<?php Extras::add_featured_event_link_css( $slug, ',' ); ?>
	<?php Pro::add_map_link_css( $slug, ',' ); ?>
	<?php Pro::add_week_link_css( $slug, ',' ); ?>
	<?php Widgets::add_widget_link_css( $slug, ',' ); ?>
	<?php V2_Views::add_link_css( $slug, ',' ); ?>
	<?php Base_CSS::add_link_css( $slug, '' ); ?>
{
	<?php if ( isset( $options[ "{$slug}-text" ] ) && 'no_color' !== $options[ "{$slug}-text" ] ) : ?>
		color: <?php echo esc_attr( $options[ "{$slug}-text" ] ); ?>;
	<?php endif ?>
	text-decoration: none;
}

	<?php Extras::fix_category_background_css( $slug, ',' ); ?>
	<?php Extras::add_list_background_css( $slug, ',' ); ?>
	<?php // Extras::add_deprecated_background_css( $slug,',' ); ?>
	<?php Extras::override_customizer( $slug, ',' ); ?>
	<?php Pro::add_map_background_css( $slug, ',' ); ?>
	<?php Pro::add_week_background_css( $slug, ',' ); ?>
	<?php Pro::add_summary_background_css( $slug, ',' ); ?>
	<?php Widgets::add_widget_background_css( $slug, ',' ); ?>
	<?php V2_Views::add_background_css( $slug, ',' ); ?>
	<?php Base_CSS::add_background_css( $slug, '' ); ?>
{
	<?php if ( isset( $options[ "{$slug}-background" ] ) && ! empty( $options[ "{$slug}-background" ] ) ) : ?>
		background-color: <?php echo esc_attr( $options[ "{$slug}-background" ] ); ?>;
	<?php endif ?>
	<?php if ( isset( $options[ "{$slug}-border" ] ) && ! empty( $options[ "{$slug}-border" ] ) ) : ?>
		border-left: 5px solid <?php echo esc_attr( $options[ "{$slug}-border" ] ); ?>;
	<?php endif ?>
		border-right: 5px solid transparent;
	<?php if ( isset( $options[ "{$slug}-text" ] ) && 'no_color' !== $options[ "{$slug}-text" ] ) : ?>
		color: <?php echo esc_attr( $options[ "{$slug}-text" ] ); ?>;
	<?php endif ?>
	line-height: 1.4em;
	padding-left: 5px;
	padding-bottom: 2px;
}

	<?php Extras::add_featured_event_border_css( $slug, $options ); ?>

	<?php Pro::fix_transparent_week_background( $slug ); ?>

	<?php Pro::fix_multiday_week_border_color( $slug ); ?>

	<?php Pro::add_map_link_css( $slug, ',' ); ?>
	<?php Widgets::add_widget_link_css( $slug, ',' ); ?>
	<?php Extras::add_list_link_css( $slug, '' ); ?>
{
	width: auto;
	display: block;
}
<?php endforeach ?>

<?php
if ( ! empty( $options['add_legend'] ) && empty( $options['custom_legend_css'] ) ) {
	$teccc->view( 'legend.css' );
}
?>
<?php do_action( 'teccc_add_legend_css' ); ?>
/* End The Events Calendar: Category Colors CSS */
