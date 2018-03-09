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


	/**
	 * Returns the sampler element that belongs to the specified row element.
	 *
	 * @param row
	 * @return {*|jQuery}
	 */
	function getRowSampler(row) {
		var lastCell = $(row).find("td:last-child");
		var sampler = $(lastCell).find("span");
		return sampler;
	}


	/**
	 * Updates the display sampler that shares a row with the specified element.
	 *
	 * @param rowElement
	 */
	function updateRowSampler(rowElement) {
		var row = $(rowElement).parents("tr");
		var sampler = getRowSampler(row);

		var borderColor = /-border]$/;
		var backgroundColor = /-background]$/;
		var borderTransparency = /-border_none]$/;
		var backgroundTransparency = /-background_none]$/;
		var fontColor = /-text]$/;
		var fontWeight = $("select[name='teccc_options[font_weight]']").val();

		var newBorderColor = "#aaf";
		var newBackgroundColor = "#eef";
		var newBorderTransparency = false;
		var newBackgroundTransparency = false;
		var newFontColor = "#000";

        // Iterate across all input, select and anchor elements in the current row
		row.find("input").add(row.find("select")).add(row.find("a")).each(function() {
			var inputName = $(this).attr("name");
			if (borderColor.test(inputName)) newBorderColor = $(this).val();
			else if (backgroundColor.test(inputName)) newBackgroundColor = $(this).val();
			else if (borderTransparency.test(inputName)) newBorderTransparency = ($(this).attr("checked") === "checked");
			else if (backgroundTransparency.test(inputName)) newBackgroundTransparency = ($(this).attr("checked") === "checked");
			else if (fontColor.test(inputName)) newFontColor = $(this).val();
		});

		if (newBorderTransparency) newBorderColor = "transparent";
		if (newBackgroundTransparency) newBackgroundColor = "transparent";

		$(sampler).css("border-left-color", newBorderColor)
			.css("background-color", newBackgroundColor)
			.css("color", newFontColor)
			.css("font-weight", fontWeight);
	}

	// Live feedback: update background/border colors
	var colorControls = $("table.teccc.form-table");
	var colorInputs = colorControls.find("input").add(colorControls.find("a"));
	var fontSelect = colorControls.find("select");

	$(colorInputs).add(fontSelect).click(function() {
		updateRowSampler(this);
	});

	// Live feedback: update font-weights
	$("select[name='teccc_options[font_weight]']").change(function() {
		$(colorControls).find("tr").find("td").each(function() {
			updateRowSampler(this);
		});
	});

	// Options for Iris color picker
	var myOptions = {
		// Fires on change event: use to implement live preview ... this is a doubly awful hack:
		//
		// 1) the change will not have propagated back to the color input when this function runs,
		//    so a fractional delay is used to workaround that
		//
		// 2) we're cycling through *all* the color inputs when we do get round to updating the
		//    samplers - pretty inefficient, though not the very worst thing in the world
		//
		// We're going to want to do something a little more elegant before merging this back into
		// develop.
		change: function() {
			setTimeout(function() { colorInputs.each(function() { updateRowSampler(this) }) }, 10 )
		},
		// Hide color picker controls on load
		hide: true,
		// No need for a common colors palette
		palettes: false
	};

	// Implement color picker
	$('.teccc-color-picker').wpColorPicker(myOptions);
});
