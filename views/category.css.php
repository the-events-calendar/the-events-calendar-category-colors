
<!-- The Events Calendar Category Colors <?php echo TribeEventsCategoryColors::VERSION ?> generated CSS -->
<style type="text/css" media="screen">
	.tribe-events-calendar a {
		font-weight: <?php echo $options['font_weight']  ?>;
	}
	
	.tribe-events-list .vevent.hentry h2 { padding-left: 5px; }

	<?php for ($i = 0; $i < $teccc->count; $i++): ?>

	.tribe-events-calendar .tribe-events-category-<?php echo($teccc->slugs[$i]) ?> a {
		color: <?php echo $options[$teccc->slugs[$i].'-text'] ?>;
	}

	.tribe-events-category-<?php echo($teccc->slugs[$i]) ?> h2.entry-title a,
	.tribe-events-category-<?php echo($teccc->slugs[$i]) ?> .tribe-events-event-details h2.entry-title a,
	.tribe-events-calendar .tribe-events-category-<?php echo $teccc->slugs[$i] ?>,
	#tribe-events-content .tribe-events-category-<?php echo $teccc->slugs[$i] ?> > .tribe-events-tooltip h4.entry-title {
		background-color: <?php echo $options[$teccc->slugs[$i].'-background'] ?>;
		border-left: 5px solid <?php echo $options[$teccc->slugs[$i].'-border'] ?>;
		border-right: 5px solid transparent;
		color: <?php echo $options[$teccc->slugs[$i].'-text'] ?>;
		padding-left: 5px;
	}

	.tribe-events-category-<?php echo($teccc->slugs[$i]) ?> h2.entry-title a,
	.tribe-events-category-<?php echo($teccc->slugs[$i]) ?> .tribe-events-event-details h2.entry-title a {
		width: 100%;
		display: block;
	}

/*  CSS for IDs  */
	.tribe-events-calendar .tribe-events-category-<?php echo($teccc->IDs[$i]) ?> a {
		color: <?php echo $options[$teccc->slugs[$i].'-text'] ?>;
	}

	.tribe-events-category-<?php echo($teccc->IDs[$i]) ?> h2.entry-title a,
	.tribe-events-category-<?php echo($teccc->IDs[$i]) ?> .tribe-events-event-details h2.entry-title a,
	.tribe-events-calendar .tribe-events-category-<?php echo $teccc->IDs[$i] ?>,
	#tribe-events-content .tribe-events-category-<?php echo $teccc->IDs[$i] ?> > .tribe-events-tooltip h4.entry-title {
		background-color: <?php echo $options[$teccc->slugs[$i].'-background'] ?>;
		border-left: 5px solid <?php echo $options[$teccc->slugs[$i].'-border'] ?>;
		border-right: 5px solid transparent;
		color: <?php echo $options[$teccc->slugs[$i].'-text'] ?>;
		padding-left: 5px;
	}

	.tribe-events-category-<?php echo($teccc->IDs[$i]) ?> h2.entry-title a,
	.tribe-events-category-<?php echo($teccc->IDs[$i]) ?> .tribe-events-event-details h2.entry-title a {
		width: 100%;
		display: block;
	}

	
/*  CSS for IDs end  */
	
	<?php endfor ?>

	<?php if (isset($options['add_legend']) and !isset($options['custom_legend_css'])): ?>
		<?php $teccc->view('legend.css') ?>
	<?php endif ?>

</style>