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
			allEntries: $("table.tribe-events-calendar").find("td").find("div.hentry.tribe-events-event"),
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
		// If we're still working don't do anything - the visitor can wait
		if (status.working) {
			event.stopPropagation;
			return;
		}
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
		var slug = ".cat_" + selection;
		$(status.allEntries).not(slug).fadeTo(status.speed, status.opacity, function () {
			status.selected = selection;
			status.working = false;
		});

		event.stopPropagation();
	}


	/**
	 * Converts a link to a span, storing the href URL in the jQuery cache
	 * object for future use.
	 */
	function prepareElement() {
		var link = $(this).find("a");

		// If no anchor elements are found then the legend tpl tag is outside of the
		// pjax/ajax refresh area and we need take no action, the intial preparation
		// work will be extant
		if (link.length === 0) return;

		// Otherwise we need to convert the link(s) to span(s)
		var linkAddr = $(link).attr("href");
		var linkTitle = $(link).html();
		var linkSlugField = $(this).find("input");
		var linkSlug = $(linkSlugField).val();
		var replacementText = '<span>' + linkTitle + '</span>';

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
	 * Setup should occur when the document is ready and following pjax
	 * operations.
	 */
	setup();
	$("#tribe-events-content").on('pjax:complete', setup);
});