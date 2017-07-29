<?php
namespace Fragen\Category_Colors;

/*
 * Setup variables for CSS generation.
 */
$teccc   = Main::instance();
$options = Admin::fetch_options( $teccc );

?>

/* The Events Calendar Category Colors <?php echo Main::$version ?> generated CSS */
.teccc-legend a, .tribe-events-calendar a, #tribe-events-content .tribe-events-tooltip h4
{ font-weight: <?php esc_attr_e( $options['font_weight'] ) ?>; }

.tribe-events-list .vevent.hentry h2 { padding-left: 5px; }

<?php Extras::add_mobile_css(); ?>

<?php Extras::fix_default_week_background(); ?>
<?php if ( empty( $this->terms ) ) { $this->terms = $options['terms']; } ?>

<?php foreach ( $teccc->terms as $id => $attributes ): ?>
	<?php
		$slug = esc_attr( $attributes[ Main::SLUG ] );
		$name = esc_attr( $attributes[ Main::NAME ] );
	?>

<?php Extras::fix_category_link_css( $slug ); ?>
<?php Extras::add_map_link_css( $slug ); ?>
<?php Extras::add_week_link_css( $slug ); ?>
<?php if ( '1' === $options['color_widgets'] ): ?>
	<?php Widgets::add_widget_link_css( $slug ); ?>
<?php endif ?>
#tribe-events-content table.tribe-events-calendar .tribe-event-featured.tribe-events-category-<?php echo $slug ?> .tribe-events-month-event-title a,
.teccc-legend .tribe-events-category-<?php echo $slug ?> a,
.tribe-events-calendar .tribe-events-category-<?php echo $slug ?> a,
#tribe-events-content .teccc-legend .tribe-events-category-<?php echo $slug ?> a,
#tribe-events-content .tribe-events-calendar .tribe-events-category-<?php echo $slug ?> a,
.tribe-events-category-<?php echo $slug ?> > div.hentry.vevent > h3.entry-title a,
.tribe-events-mobile.tribe-events-category-<?php echo $slug ?> h4 a
{
	color: <?php esc_attr_e( $options[ $slug.'-text' ] ) ?>;
	text-decoration: none;
}

<?php Extras::fix_category_background_css( $slug ); ?>
<?php Extras::add_map_background_css( $slug ); ?>
<?php Extras::add_week_background_css( $slug ); ?>
<?php if ( '1' === $options['color_widgets'] ): ?>
	<?php Widgets::add_widget_background_css( $slug ); ?>
<?php endif ?>
.events-archive.events-gridview #tribe-events-content table .type-tribe_events.tribe-events-category-<?php echo $slug ?>,
.tribe-events-category-<?php echo $slug ?> h2.tribe-events-list-event-title.entry-title a,
.teccc-legend .tribe-events-category-<?php echo $slug ?>,
.tribe-events-calendar .tribe-events-category-<?php echo $slug ?>,
#tribe-events-content .tribe-events-category-<?php echo $slug ?> > .tribe-events-tooltip h4,
.tribe-events-category-<?php echo $slug ?> > div.hentry.vevent > h3.entry-title,
.tribe-events-category-<?php echo $slug ?> h2 a,
.tribe-events-mobile.tribe-events-category-<?php echo $slug ?> h4
{
	background-color: <?php esc_attr_e( $options[ $slug.'-background' ] ) ?>;
	border-left: 5px solid <?php esc_attr_e( $options[ $slug.'-border' ] ) ?>;
	border-right: 5px solid transparent;
	color: <?php esc_attr_e( $options[ $slug.'-text' ] ) ?>;
	line-height: 1.4em;
	padding-left: 5px;
	padding-bottom: 2px;
}

<?php Extras::fix_transparent_week_background( $slug ); ?>

<?php Extras::add_map_display_css( $slug ); ?>
<?php if ( '1' === $options['color_widgets'] ): ?>
	<?php Widgets::add_widget_display_css( $slug ); ?>
<?php endif ?>
.tribe-events-category-<?php echo $slug ?> h2.tribe-events-list-event-title.entry-title a,
.tribe-events-category-<?php echo $slug ?> h2.tribe-events-list-event-title a {
	width: auto;
	display: block;
}

<?php endforeach ?>

<?php if ( ( '1' === $options['add_legend'] ) && is_null( $options['custom_legend_css'] ) ): ?>
	<?php $teccc->view( 'legend.css' ) ?>
<?php endif ?>
<?php do_action( 'teccc_add_legend_css' ); ?>
