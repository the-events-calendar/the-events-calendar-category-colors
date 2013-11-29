<!-- The Events Calendar Category Colors <?php echo Tribe_Events_Category_Colors::VERSION ?> generated CSS -->
<style type="text/css" media="screen">
	.tribe-events-calendar a, #tribe-events-content .tribe-events-tooltip h4
	{
		font-weight: <?php echo $options['font_weight']  ?>;
	}

	.tribe-events-list .vevent.hentry h2 { padding-left: 5px; }

	<?php foreach ( $teccc->terms as $id => $attributes ): ?>
		<?php
			$slug = esc_attr( $attributes[Tribe_Events_Category_Colors::SLUG] );
			$name = esc_attr( $attributes[Tribe_Events_Category_Colors::NAME] );
		?>

	<?php Tribe_Events_Category_Colors_Extras::add_agenda_link_css( $slug ); ?>
	<?php Tribe_Events_Category_Colors_Widgets::add_widget_link_css( $slug ); ?>
	.tribe-events-calendar .tribe-events-category-<?php echo $slug ?> a,
	.tribe-events-category-<?php echo $slug ?> > div.hentry.vevent > h3.entry-title a
	{
		color: <?php echo $options[ $slug.'-text' ] ?>;
		text-decoration: none;
	}
	
	/* clear blue background from week view */
	.tribe-grid-body div[id*="tribe-events-event-"] .hentry.vevent,
	.tribe-grid-body div[id*="tribe-events-event-"] .hentry.vevent:hover
	{
		background-color: transparent;
	}

	<?php Tribe_Events_Category_Colors_Extras::add_agenda_background_css( $slug ); ?>
	<?php Tribe_Events_Category_Colors_Widgets::add_widget_background_css( $slug ); ?>
	.tribe-events-category-<?php echo $slug ?> h2.tribe-events-list-event-title a,
	.tribe-events-calendar .tribe-events-category-<?php echo $slug ?>,
	#tribe-events-content .tribe-events-category-<?php echo $slug ?> > .tribe-events-tooltip h4.summary,
	.tribe-events-category-<?php echo $slug ?> > .tribe-events-tooltip h4.summary,
	.tribe-events-category-<?php echo $slug ?> > div.hentry.vevent > h3.entry-title
	{
		background-color: <?php echo $options[ $slug.'-background' ] ?>;
		border-left: 5px solid <?php echo $options[ $slug.'-border' ] ?>;
		border-right: 5px solid transparent;
		color: <?php echo $options[ $slug.'-text' ] ?>;
		padding-left: 5px;
	}

	<?php Tribe_Events_Category_Colors_Extras::add_agenda_display_css( $slug ); ?>
	<?php Tribe_Events_Category_Colors_Widgets::add_widget_display_css( $slug ); ?>
	.tribe-events-category-<?php echo $slug ?> h2.tribe-events-list-event-title a
	{
		width: 93%;
		display: block;
	}

	<?php endforeach ?>

	<?php if( isset( $options['add_legend'] ) and !isset( $options['custom_legend_css'] ) ): ?>
		<?php $teccc->view( 'legend.css' ) ?>
		<?php if( isset( $extra_user_legend_css ) ) do_action( 'teccc_add_legend_css', $extra_user_legend_css ); ?>
	<?php endif ?>

</style>
