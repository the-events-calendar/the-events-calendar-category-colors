<!-- The Events Calendar Category Colors <?php echo Tribe_Events_Category_Colors::$version ?> generated CSS -->
<style type="text/css" media="screen">
	.teccc-legend a, .tribe-events-calendar a, #tribe-events-content .tribe-events-tooltip h4
	{
		font-weight: <?php echo $options['font_weight']  ?>;
	}

	.tribe-events-list .vevent.hentry h2 { padding-left: 5px; }

	<?php Tribe_Events_Category_Colors_Extras::fix_default_week_background(); ?>

	<?php foreach ( $teccc->terms as $id => $attributes ): ?>
		<?php
			$slug = esc_attr( $attributes[Tribe_Events_Category_Colors::SLUG] );
			$name = esc_attr( $attributes[Tribe_Events_Category_Colors::NAME] );
		?>

	<?php Tribe_Events_Category_Colors_Extras::add_agenda_link_css( $slug ); ?>
	<?php Tribe_Events_Category_Colors_Extras::add_map_link_css( $slug ); ?>
	<?php Tribe_Events_Category_Colors_Extras::add_week_link_css( $slug ); ?>
	<?php if ( isset( $options['color_widgets'] ) and '1' === $options['color_widgets'] ): ?>
		<?php Tribe_Events_Category_Colors_Widgets::add_widget_link_css( $slug, $options ); ?>
	<?php endif ?>
	.teccc-legend .tribe-events-category-<?php echo $slug ?> a,
	.tribe-events-calendar .tribe-events-category-<?php echo $slug ?> a,
	.tribe-events-category-<?php echo $slug ?> > div.hentry.vevent > h3.entry-title a,
	.tribe-events-mobile.tribe-events-category-<?php echo $slug ?> h4 a
	{
		color: <?php echo $options[ $slug.'-text' ] ?>;
		text-decoration: none;
	}
	
	<?php Tribe_Events_Category_Colors_Extras::add_agenda_background_css( $slug ); ?>
	<?php Tribe_Events_Category_Colors_Extras::add_map_background_css( $slug ); ?>
	<?php Tribe_Events_Category_Colors_Extras::add_week_background_css( $slug ); ?>
	<?php if ( isset( $options['color_widgets'] ) and '1' === $options['color_widgets'] ): ?>
		<?php Tribe_Events_Category_Colors_Widgets::add_widget_background_css( $slug, $options ); ?>
	<?php endif ?>
	.tribe-events-category-<?php echo $slug ?> h2.tribe-events-list-event-title a,
	.teccc-legend .tribe-events-category-<?php echo $slug ?>,
	.tribe-events-calendar .tribe-events-category-<?php echo $slug ?>,
	#tribe-events-content .tribe-events-category-<?php echo $slug ?> > .tribe-events-tooltip h4,
	.tribe-events-category-<?php echo $slug ?> > div.hentry.vevent > h3.entry-title,
	.tribe-events-mobile.tribe-events-category-<?php echo $slug ?> h4
	{
		background-color: <?php echo $options[ $slug.'-background' ] ?>;
		border-left: 5px solid <?php echo $options[ $slug.'-border' ] ?>;
		border-right: 5px solid transparent;
		color: <?php echo $options[ $slug.'-text' ] ?>;
		line-height: 1.4em;
		padding-left: 5px;
		padding-bottom: 2px;
	}

	<?php Tribe_Events_Category_Colors_Extras::add_agenda_display_css( $slug ); ?>
	<?php Tribe_Events_Category_Colors_Extras::add_map_display_css( $slug ); ?>
	<?php if ( isset( $options['color_widgets'] ) and '1' === $options['color_widgets'] ): ?>
		<?php Tribe_Events_Category_Colors_Widgets::add_widget_display_css( $slug, $options ); ?>
	<?php endif ?>
	.tribe-events-category-<?php echo $slug ?> h2.tribe-events-list-event-title a
	{
		width: auto;
		display: block;
	}

	<?php endforeach ?>

	<?php if ( isset( $options['add_legend'] ) and !isset( $options['custom_legend_css'] ) ): ?>
		<?php $teccc->view( 'legend.css' ) ?>
		<?php if ( isset( $extra_user_legend_css ) ) do_action( 'teccc_add_legend_css', $extra_user_legend_css ); ?>
	<?php endif ?>

</style>
