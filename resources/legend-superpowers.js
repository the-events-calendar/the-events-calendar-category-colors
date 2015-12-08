/**
 * The Events Calendar Category Colors - Legend Superpowers. Wait until the
 * document is ready then begin.
 */
jQuery(document).ready(function($) {
	var legendEntries;
	var status;


	/**
	 * Sets up/restores the status and legendEntries objects to their defaults.
	 */
	function defaultStatus() {
		legendEntries = $("ul#legend").find("li");
		status = {
			allEntries: $("#tribe-events-content").find("div[class^=tribe-events-category-]"),
			opacity: 0.25,
			selected: false,
			speed: 500,
			working: false
		};
	}


	/**
	 * Deselects an element, bringing all categories back into focus (full
	 * opacity, in this scenario).
	 *
	 * @param slug
	 */
	function deselect(slug) {
		$(status.allEntries).fadeTo(status.speed, 1, function () {
			status.selected = false;
			status.working = false;
		});
	}


	/**
	 * Handles selections and deselections of categories.
	 *
	 * @param event
	 */
	function categorySelection(event) {
		// If we're still working (or we're in responsive mode) don't do anything - the visitor can wait
		if (status.working || responsive_active()) {
			event.stopPropagation();
			return;
		}
		// Otherwise set the working flag so that we don't end up stacking - and delaying - effects
		else status.working = true;

		// Look out for deselections!
		var selection = $(this).data("categorySlug");
		if (selection === status.selected) {
			deselect(selection);
			event.stopPropagation();
			return;
		}

		// Handle selections: deselect existing selection first of all
		deselect(status.selected);

		// Now focus in on the new selection
		var slug = ".tribe-events-category-" + selection;
		$(status.allEntries).not(slug).fadeTo(status.speed, status.opacity, function () {
			status.selected = selection;
			status.working = false;
		});

		event.stopPropagation();
	}

	function responsive_active() {
		return $("body").hasClass("tribe-mobile");
	}

	/**
	 * Converts a link to a span, storing the href URL in the jQuery cache
	 * object for future use.
	 */
	function prepareElement() {
		var link = $(this).find("a");
		if (link.length !== 1) return; // Quit if preparation has already been completed (no <a> elements found)

		// Convert the link(s) to span(s) but store the links address and slug
		var linkAddr = $(link).attr("href");
		var linkTitle = $(link).html();
		var linkSlugField = $(this).find("input");
		var linkSlug = $(linkSlugField).val();
		var replacementText = '<span>' + linkTitle + '</span>';

		// Tidy up - remove unnecessary elements
		$(link).remove();
		$(linkSlugField).remove();

		$(this).html(replacementText)
			.data('categoryURL', linkAddr)
			.data('categorySlug', linkSlug);
	}


	/**
	 * Prepares the legend and assigns superpowers.
	 */
	function setup() {
		defaultStatus();
		$(legendEntries).each(prepareElement);
		$(legendEntries).click(categorySelection);
	}

	/**
	 * Tries to ensure the setup procedure runs afresh following ajax operations (month to month navigation etc).
	 */
	function setupAfterAjax() {
		if (typeof tribe_ev === "object" && tribe_ev.events !== undefined)
			$(tribe_ev.events).on('tribe_ev_ajaxSuccess', setup);
	}

	/**
	 * Setup should occur when the document is ready and following ajax loads.
	 */
	setup();
	setupAfterAjax();

	$("#tribe-events-content").ajaxComplete(setup);
});
