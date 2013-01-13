/**
 * The Events Calendar Category Colors - options form behaviours.
 */
jQuery(document).ready(function($) {
	var conferenceTransparent = $("#teccc_border_options-conference").find("input");
	var conferenceColors = $("#teccc_border-conference");
	var holidayTransparent = $("#teccc_border_options-holiday").find("input");
	var holidayColors = $("#teccc_border-holiday");


	/**
	 * Checks if the legend has been turned on. If so, the Legend Superpowers
	 * option is displayed (or else it is hidden).
	 */
	function toggleSuperpowersVisibility() {
		if ($(conferenceTransparent).attr("checked") === "checked")
			$(conferenceColors).slideUp();
		else
			$(conferenceColors).slideDown();
		
		if ($(holidayTransparent).attr("checked") === "checked")
			$(holidayColors).slideUp();
		else
			$(holidayColors).slideDown();

	}

	// Toggle Legend Superpowers visibility initially, after the page loads
	toggleSuperpowersVisibility();

	// Subsequently toggle whenever the legend setting changes
	$(conferenceTransparent).change(toggleSuperpowersVisibility);
	$(holidayTransparent).change(toggleSuperpowersVisibility);
});
