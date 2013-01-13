<script type="text/javascript">
jQuery(document).ready(function($) {

	<?php for ($i = 0; $i < $teccc->count; $i++): ?>

	var <?php echo($teccc->slugs[$i]) ?>Transparent = $("#teccc_border_options-<?php echo($teccc->slugs[$i]) ?>").find("input");
	var <?php echo($teccc->slugs[$i]) ?>Colors = $("#teccc_border-<?php echo($teccc->slugs[$i]) ?>");
	<?php endfor ?>

	/**
	 * Checks if the Transparent has been turned on. If so, the Superpowers
	 * option is displayed (or else it is hidden).
	 */
	function toggleSuperpowersVisibility() {
		<?php for ($i = 0; $i < $teccc->count; $i++): ?>

		if ($(<?php echo($teccc->slugs[$i]) ?>Transparent).attr("checked") === "checked")
			$(<?php echo($teccc->slugs[$i]) ?>Colors).slideUp();
		else
			$(<?php echo($teccc->slugs[$i]) ?>Colors).slideDown();
			
		<?php endfor ?>
	}

	// Toggle Superpowers visibility initially, after the page loads
	toggleSuperpowersVisibility();

	// Subsequently toggle whenever the setting changes
	<?php for ($i = 0; $i < $teccc->count; $i++): ?>
	$(<?php echo($teccc->slugs[$i]) ?>Transparent).change(toggleSuperpowersVisibility);
	<?php endfor ?>

});

</script>