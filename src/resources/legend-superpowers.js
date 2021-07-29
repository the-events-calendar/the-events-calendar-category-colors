/**
 * The Events Calendar Category Colors - Legend Superpowers. Wait until the
 * document is ready then begin.
 */
jQuery(document).ready(
	function ($) {
		let legendEntries;
		let status;

		/**
		 * Sets up/restores the status and legendEntries objects to their defaults.
		 */
		function defaultStatus() {
			legendEntries = $("ul#legend").find("li");
			status = {
				//allEntries: $( "#tribe-events-content" ).find( "div[class^=tribe-events-category-]" ),
				allEntries: document.querySelectorAll("#tribe-events-content div[class^=tribe-events-category-],.tribe-events article[class*=tribe_events_cat-]"),
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
			$(status.allEntries).fadeTo(
				status.speed,
				1,
				function () {
					status.selected = false;
					status.working = false;
				}
			);
		}

		/**
		 * Handles selections and deselections of categories.
		 *
		 * @param event
		 */
		function categorySelection(event) {
			let isV2Ative = 0 !== $('.tribe-events-view').length;
			let isV1Mobile = responsive_active();
			// If we're still working (or we're in responsive mode) don't do anything - the visitor can wait
			if (status.working || (!isV2Ative && isV1Mobile)) {
				// If we're still working (or we're in responsive mode) don't do anything - the visitor can wait
				event.stopPropagation();
				return;
			} // Otherwise set the working flag so that we don't end up stacking - and delaying - effects
			else {
				status.working = true;
			}

			// Look out for deselections!
			let selection = $(this).data("categorySlug");
			if (selection === status.selected) {
				deselect(selection);
				event.stopPropagation();
				return;
			}

			// Handle selections: deselect existing selection first of all
			deselect(status.selected);

			// Now focus in on the new selection
			let slug = ".tribe-events-category-" + selection;
			let slugv2 = ".tribe_events_cat-" + selection;
			$(status.allEntries).not(slug).not(slugv2).fadeTo(
				status.speed,
				status.opacity,
				function () {
					status.selected = selection;
					status.working = false;
				}
			);

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
			let link = $(this).find("a");
			if (link.length !== 1) {
				return; // Quit if preparation has already been completed (no <a> elements found)
			}

			// Convert the link(s) to span(s) but store the links address and slug
			let linkAddr = $(link).attr("href");
			let linkTitle = $(link).html();
			let linkSlugField = $(this).find("input");
			let linkSlug = $(linkSlugField).val();
			let replacementText = '<span>' + linkTitle + '</span>';

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
		 * Setup should occur when the document is ready and following ajax loads.
		 */
		setup();

		//$(document).on('afterSetup.tribeEvents', tribe.events.views.manager.selectors.container, function () {
		$(document).on('afterSetup.tribeEvents', function () {
			let $container = $(this);
			// initialize the superpowers by using $container.find() for the elements so we can have multiple views on the same page.
			// thanks Gustavo! <3
			if (typeof $container !== 'undefined') {
				setup();
			}
		});
	}
);
