
<!-- The Events Calendar Category Colors <?php echo TribeEventsCategoryColors::VERSION ?> generated CSS -->
<style type="text/css" media="screen">
	.tribe-events-calendar a {
		font-weight: <?php echo $options['font_weight']  ?>;
	}

	<?php for ($i = 0; $i < $teccc->count; $i++): ?>

	.tribe-events-calendar .cat_<?php echo($teccc->slugs[$i]) ?> a {
		color: <?php echo $options[$teccc->slugs[$i].'-text'] ?>;
	}

	.cat_<?php echo $teccc->slugs[$i] ?>,
	.tribe-events-calendar .cat_<?php echo $teccc->slugs[$i] ?>,
	.cat_<?php echo $teccc->slugs[$i] ?> > .tribe-events-tooltip .tribe-events-event-title {
		background-color: <?php echo $options[$teccc->slugs[$i].'-background'] ?>;
		border-left: 5px solid <?php echo $options[$teccc->slugs[$i].'-border'] ?>;
		border-right: 5px solid transparent;
		color: <?php echo $options[$teccc->slugs[$i].'-text'] ?>;
	}
	<?php endfor ?>

	<?php if (isset($options['add_legend']) and !isset($options['custom_legend_css'])): ?>
		<?php $teccc->view('legend.css') ?>
	<?php endif ?>

</style>