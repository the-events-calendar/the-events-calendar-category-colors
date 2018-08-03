<?php
namespace Fragen\Category_Colors;

?>
/* The Events Calendar Category Colors <?php echo Main::$version; ?> */
.teccc-legend a, .tribe-events-calendar a, #tribe-events-content .tribe-events-tooltip h4 {
	font-weight: <?php esc_attr_e( $options['font_weight'] ); ?>;
}

.tribe-events-list .vevent.hentry h2 {
	padding-left: 5px;
}

<?php Extras::add_mobile_css(); ?>

<?php Extras::fix_default_week_background(); ?>
<?php
if ( empty( $teccc->terms ) && ! empty( $options['terms'] ) ) {
	$teccc->terms = $options['terms'];
} else {
	return false;
}
?>

<?php foreach ( $teccc->terms as $id => $attributes ) : ?>
	<?php
	$slug = esc_attr( $attributes[ Main::SLUG ] );
	$name = esc_attr( $attributes[ Main::NAME ] );
	?>

	<?php Extras::fix_category_link_css( $slug ); ?>
	<?php Extras::add_map_link_css( $slug ); ?>
	<?php Extras::add_week_link_css( $slug ); ?>
	<?php Extras::add_list_link_css( $slug ); ?>
	<?php Extras::override_customizer( $slug ); ?>
	<?php //Extras::add_deprecated_link_css( $slug ); ?>
	<?php Widgets::add_widget_link_css( $slug ); ?>
	<?php Extras::add_featured_event_link_css( $slug ); ?>
#tribe-events-content table.tribe-events-calendar .tribe-event-featured.tribe-events-category-<?php echo $slug; ?> .tribe-events-month-event-title a,
.teccc-legend .tribe-events-category-<?php echo $slug; ?> a,
.tribe-events-calendar .tribe-events-category-<?php echo $slug; ?> a,
#tribe-events-content .teccc-legend .tribe-events-category-<?php echo $slug; ?> a,
#tribe-events-content .tribe-events-calendar .tribe-events-category-<?php echo $slug; ?> a,
.type-tribe_events.tribe-events-category-<?php echo $slug; ?> h2 a,
.tribe-events-category-<?php echo $slug; ?> > div.hentry.vevent > h3.entry-title a,
.tribe-events-mobile.tribe-events-category-<?php echo $slug; ?> h4 a {
	<?php if ( 'no_color' !== $options[ "{$slug}-text" ] ) : ?>
	color: <?php esc_attr_e( $options[ "{$slug}-text" ] ); ?>;
<?php endif ?>
	text-decoration: none;
}

	<?php Extras::fix_category_background_css( $slug ); ?>
	<?php Extras::add_map_background_css( $slug ); ?>
	<?php Extras::add_week_background_css( $slug ); ?>
	<?php Extras::add_list_background_css( $slug ); ?>
	<?php //Extras::add_deprecated_week_background_css( $slug ); ?>
	<?php //Extras::add_deprecated_background_css( $slug ); ?>
	<?php Extras::override_customizer( $slug ); ?>
	<?php Widgets::add_widget_background_css( $slug ); ?>
.events-archive.events-gridview #tribe-events-content table .type-tribe_events.tribe-events-category-<?php echo $slug; ?>,
.teccc-legend .tribe-events-category-<?php echo $slug; ?>,
.tribe-events-calendar .tribe-events-category-<?php echo $slug; ?>,
#tribe-events-content .tribe-events-category-<?php echo $slug; ?> > .tribe-events-tooltip h3,
.type-tribe_events.tribe-events-category-<?php echo $slug; ?> h2,
.tribe-events-category-<?php echo $slug; ?> > div.hentry.vevent > h3.entry-title,
.tribe-events-mobile.tribe-events-category-<?php echo $slug; ?> h4 {
	<?php if ( null !== $options[ "{$slug}-background" ] ) : ?>
	background-color: <?php esc_attr_e( $options[ "{$slug}-background" ] ); ?>;
<?php endif ?>
	<?php if ( null !== $options[ "{$slug}-border" ] ) : ?>
	border-left: 5px solid <?php esc_attr_e( $options[ "{$slug}-border" ] ); ?>;
<?php endif ?>
	border-right: 5px solid transparent;
	<?php if ( 'no_color' !== $options[ "{$slug}-text" ] ) : ?>
	color: <?php esc_attr_e( $options[ "{$slug}-text" ] ); ?>;
<?php endif ?>
	line-height: 1.4em;
	padding-left: 5px;
	padding-bottom: 2px;
}

	<?php Extras::add_featured_event_border_css( $slug, $options ); ?>

	<?php Extras::fix_transparent_week_background( $slug ); ?>

	<?php Extras::add_map_link_css( $slug ); ?>
	<?php Widgets::add_widget_link_css( $slug ); ?>
	<?php Extras::add_list_link_css( $slug ); ?>
{
	width: auto;
	display: block;
}
<?php endforeach ?>

<?php if ( ( '1' === $options['add_legend'] ) && null === $options['custom_legend_css'] ) : ?>
	<?php $teccc->view( 'legend.css' ); ?>
<?php endif ?>
<?php do_action( 'teccc_add_legend_css' ); ?>
