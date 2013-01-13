/**
 * The Events Calendar Category Colors - options form behaviours.
 */
jQuery(document).ready(function($) {
	var borderTransparent = $(".teccc_border_options").find("input");
	var borderColors = $(".teccc_border");
	var backgroundTransparent = $(".teccc_background_options").find("input");
	var backgroundColors = $(".teccc_background");


	/**
	 * Checks if the legend has been turned on. If so, the Legend Superpowers
	 * option is displayed (or else it is hidden).
	 */
	function toggleSuperpowersVisibility() {
		if ($(borderTransparent).attr("checked") === "checked")
			$(borderColors).slideUp();
		else
			$(bordereColors).slideDown();
		
		if ($(backgroundTransparent).attr("checked") === "checked")
			$(backgroundColors).slideUp();
		else
			$(backgroundColors).slideDown();

	}

	// Toggle Legend Superpowers visibility initially, after the page loads
	toggleSuperpowersVisibility();

	// Subsequently toggle whenever the legend setting changes
	$(borderTransparent).change(toggleSuperpowersVisibility);
	$(backgroundTransparent).change(toggleSuperpowersVisibility);
});
