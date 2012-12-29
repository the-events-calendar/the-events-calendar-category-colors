/**
 * The Events Calendar Category Colors - Legend Superpowers. Wait until the
 * document is ready then begin.
 */
jQuery(document).ready(function($) {
	var category = {
		allEntries: $("table.tribe-events-calendar").find("td").find("div.hentry.tribe-events-event"),
		opacity: 0.25,
		selected: false,
		speed: 500,
		working: false
	};


	/**
	 * Deselects an element, bringing all categories back into focus (full
	 * opacity, in this scenario).
	 *
	 * @param slug
	 */
	function deselect(slug) {
		$(category.allEntries).fadeTo(category.speed, 1, function() {
			category.selected = false;
			category.working = false;
		});
	}


	/**
	 * Handles selections and deselections of categories.
	 *
	 * @param event
	 */
	function categorySelection(event) {
		// If we're still working don't do anything - the visitor can wait
		if (category.working) {
			event.stopPropagation;
			return;
		}
		else category.working = true;

		// Look out for deselections!
		var selection = $(this).data("categorySlug");
		if (selection === category.selected) {
			deselect(selection);
			event.stopPropagation();
			return;
		}

		// Handle selections: deselect existing selection first of all
		deselect(category.selected);

		// Now focus in on the new selection
		var slug = ".cat_"+selection;
		$(category.allEntries).not(slug).fadeTo(category.speed, category.opacity, function() {
			category.selected = selection;
			category.working = false;
		});

		event.stopPropagation();
	}


	/**
	 * Converts a link to a span, storing the href URL in the jQuery cache
	 * object for future use.
	 */
	function prepareElement() {
		var link = $(this).find("a");
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

	// Reference to legend elements
	var legendEntries = $("ul#legend").find("li");

	// Convert all legend links to prepared span elements
	$(legendEntries).each(prepareElement);

	// Look out for selections
	$(legendEntries).click(categorySelection);
});