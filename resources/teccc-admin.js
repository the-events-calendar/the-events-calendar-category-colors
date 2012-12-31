/**
 * The Events Calendar Category Colors - options form behaviours.
 */
jQuery(document).ready(function($) {
	var legendOption = $("#category_legend_setting").find("input");
	var relatedOptions = $("tr.legend_related");


	/**
	 * Checks if the legend has been turned on. If so, the Legend Superpowers
	 * option is displayed (or else it is hidden).
	 */
	function toggleSuperpowersVisibility() {
		if ($(legendOption).attr("checked") === "checked")
			$(relatedOptions).fadeTo(500, 1, function() { $(relatedOptions).show(); });
		else
			$(relatedOptions).fadeTo(500, 0, function() { $(relatedOptions).hide(); });
	}

	// Toggle Legend Superpowers visibility initially, after the page loads
	toggleSuperpowersVisibility();

	// Subsequently toggle whenever the legend setting changes
	$(legendOption).change(toggleSuperpowersVisibility);
});
