<!-- The Events Calendar Category Colors <?php echo Tribe_Events_Category_Colors::VERSION ?> generated CSS -->
<style type="text/css" media="screen">
	.tribe-events-calendar a, #tribe-events-content .tribe-events-tooltip h4 {
		font-weight: <?php echo $options['font_weight']  ?>;
	}
	
	.tribe-events-list .vevent.hentry h2 { padding-left: 5px; }

	<?php foreach ($teccc->terms as $id => $attributes): ?>
		<?php
			$slug = esc_attr($attributes[Tribe_Events_Category_Colors::SLUG]);
			$name = esc_attr($attributes[Tribe_Events_Category_Colors::NAME]);
		?>
	.tribe-events-calendar .tribe-events-category-<?php echo $slug ?> a {
		color: <?php echo $options[$slug.'-text'] ?>;
		text-decoration: none;
	}

	.tribe-events-category-<?php echo $slug ?> h2.tribe-events-list-event-title a,
	.tribe-events-calendar .tribe-events-category-<?php echo $slug ?>,
	#tribe-events-content .tribe-events-category-<?php echo $slug ?> > .tribe-events-tooltip h4.summary,
	.tribe-events-category-<?php echo $slug ?> > .tribe-events-tooltip h4.summary {
		background-color: <?php echo $options[$slug.'-background'] ?>;
		border-left: 5px solid <?php echo $options[$slug.'-border'] ?>;
		border-right: 5px solid transparent;
		color: <?php echo $options[$slug.'-text'] ?>;
		padding-left: 5px;
	}

	.tribe-events-category-<?php echo $slug ?> h2.tribe-events-list-event-title a {
		width: 93%;
		display: block;
	}
	
	<?php endforeach ?>

	<?php if (isset($options['add_legend']) and !isset($options['custom_legend_css'])): ?>
		<?php $teccc->view('legend.css') ?>
		<?php do_action( 'teccc_add_legend_css', $extra_user_legend_css ) ?>
	<?php endif ?>

</style>
