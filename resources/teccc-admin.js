/**
 * The Events Calendar Category Colors - options form behaviours.
 */
jQuery(document).ready(function($) {
	var legendOption = $("#category_legend_setting").find("input");
	var relatedOptions = $(".legend_related");


	/**
	 * Checks if the legend has been turned on. If so, the Legend Superpowers
	 * option is displayed (or else it is hidden).
	 */
	function toggleSuperpowersVisibility() {
		if ($(legendOption).attr("checked") === "checked")
			$(relatedOptions).slideDown();
		else
			$(relatedOptions).slideUp();
	}

	// Toggle Legend Superpowers visibility initially, after the page loads
	toggleSuperpowersVisibility();

	// Subsequently toggle whenever the legend setting changes
	$(legendOption).change(toggleSuperpowersVisibility);
});
