/**
 * The Events Calendar Category Colors - options form behaviours.
 */
jQuery(document).ready(function($) {
	var legendOption = $("#category_legend_setting").find("input");
	var customCSSOption = $("#legend_custom_css");
	var superpowersOption = $("#legend_superpowers_setting");


	/**
	 * Checks if the legend has been turned on. If so, the Legend Superpowers
	 * option is displayed (or else it is hidden).
	 */
	function toggleSuperpowersVisibility() {
		if ($(legendOption).attr("checked") === "checked") {
			$(customCSSOption).show();
			$(superpowersOption).show();
		}
		else {
			$(customCSSOption).hide();
			$(superpowersOption).hide();
		}
	}

	// Toggle Legend Superpowers visibility initially, after the page loads
	toggleSuperpowersVisibility();

	// Subsequently toggle whenever the legend setting changes
	$(legendOption).change(toggleSuperpowersVisibility);
});