/**
 * The Events Calendar Category Colors - options form behaviours.
 */
jQuery(document).ready(function($) {
	var legendOption = $("#category_legend_setting").find("input");
	var relatedOptions = $(".legend_related");
	var transparencySwitches = $("td.color-control").find("input[type='checkbox']");


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


	/**
	 * Hide the color selector when transparency is enabled (and do the opposite,
	 * too).
	 */
	function toggleColorControls() {
		var colorSelector = $(this).parents("td").find(".colorselector");

		if ($(this).attr("checked"))
			$(colorSelector).slideUp();
		else
			$(colorSelector).slideDown();
	}


	// Toggle Legend Superpowers visibility initially, after the page loads
	// (and run once on page load)
	toggleSuperpowersVisibility();
	$(legendOption).change(toggleSuperpowersVisibility);


	// Hide/show color selectors, according to whether transparency is checked
	// (and run once on page load)
	$(transparencySwitches).change(toggleColorControls);
	$(transparencySwitches).each(toggleColorControls);
});
