/**
 * The Events Calendar: Category Colors - Legend Superpowers. Wait until the
 * document is ready then begin.
 */
jQuery( document ).ready(
	function ($) {
		const storageKey = 'teccc';
		let legendEntries;
		let status;

		/**
		 * Sets up/restores the status and legendEntries objects to their defaults.
		 */
		function defaultStatus() {
			legendEntries = $( "ul#legend" ).find( "li" );
			status        = {
				// allEntries: $( "#tribe-events-content" ).find( "div[class^=tribe-events-category-]" ),
				allEntries: document.querySelectorAll( "#tribe-events-content div[class^=tribe-events-category-],.tribe-events article[class*=tribe_events_cat-]" ),
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
			persistSelection('');

			$(status.allEntries).add(legendEntries).fadeTo(
				status.speed,
				1,
				function () {
					status.selected = false;
					status.working  = false;
				}
			);
		}

		/**
		 * Handles selections and deselections of categories.
		 *
		 * @param event
		 */
		function categorySelection(event) {
			let isV2Ative  = 0 !== $( '.tribe-events-view' ).length;
			let isV1Mobile = responsive_active();
			// If we're still working (or we're in responsive mode) don't do anything - the visitor can wait
			if (status.working || ( ! isV2Ative && isV1Mobile)) {
				// If we're still working (or we're in responsive mode) don't do anything - the visitor can wait
				event.stopPropagation();
				return;
			} // Otherwise set the working flag so that we don't end up stacking - and delaying - effects
			else {
				status.working = true;
			}

			// The event object may be a custom event with a selectedCategory property.
			let selection = event.hasOwnProperty('selectedCategory')
				? event.selectedCategory
				: event.currentTarget.classList[1].replace(/tribe_events_cat-/, '');

			console.log( 'legend slug: ' + selection );
			if (selection === status.selected) {
				deselect( selection );
				event.stopPropagation();
				return;
			}

			// Handle selections: deselect existing selection first of all
			deselect( status.selected );

			// Now focus in on the new selection
			const slug        = ".tribe-events-category-" + selection;
			const slugv2      = ".tribe_events_cat-" + selection;
			const $allEntries = $(status.allEntries);
			const $unselected = $allEntries.not(slug).not(slugv2);

			// We only need to fade out unselected entries if there are less unselected entries than selected entries...
			if ($unselected.length < $allEntries.length) {
				$unselected.add(legendEntries.not(slug)).fadeTo(
					status.speed,
					status.opacity,
					function () {
						status.selected = selection;
						status.working = false;
					}
				);
			}
			// ...Otherwise, it's probable that the persisted category selection does not exist on the current page.
			else {
				selection = '';
			}

			persistSelection(selection);

			event.stopPropagation();
		}

		function responsive_active() {
			return $( "body" ).hasClass( "tribe-mobile" );
		}

		/**
		 * Converts a link to a span, storing the href URL in the jQuery cache
		 * object for future use.
		 */
		function prepareElement() {
			let link = $( this ).find( "a" );
			if (link.length !== 1) {
				return; // Quit if preparation has already been completed (no <a> elements found)
			}

			// Convert the link(s) to span(s) but store the links address and slug
			let linkAddr        = $( link ).attr( "href" );
			let linkTitle       = $( link ).html();
			let linkSlugField   = $( this ).find( "input" );
			let linkSlug        = $( linkSlugField ).val();
			let replacementText = '<span>' + linkTitle + '</span>';

			// Tidy up - remove unnecessary elements
			$( link ).remove();
			$( linkSlugField ).remove();

			$( this ).html( replacementText )
				.data( 'categoryURL', linkAddr )
				.data( 'categorySlug', linkSlug );
		}

		/**
		 * Applies the selection saved in session storage.
		 */
		function applyPersistedSelection() {
			const categorySlug = getPersistedSelection();

			if (! categorySlug.length) {
				return;
			}

			const event = new Event('legendSuperpowers');
			event.selectedCategory = categorySlug;
			categorySelection(event);
		}

		/**
		 * Prepares the legend and assigns superpowers.
		 */
		function setup() {
			defaultStatus();
			$( legendEntries ).each( prepareElement );
			$( legendEntries ).on( 'click', function (event) { categorySelection( event ); } );
			applyPersistedSelection();
		}

		/**
		 * Record the selection of a category. To wipe the current selection, simply provide
		 * an empty string.
		 *
		 * @param {string} slug
		 */
		function persistSelection(slug) {
			if ('object' !== typeof window.sessionStorage) {
				return;
			}

			window.sessionStorage.setItem(storageKey, slug);
		}

		/**
		 * Get the persisted selection (may be empty).
		 *
		 * @returns {string}
		 */
		function getPersistedSelection() {
			return 'object' === typeof window.sessionStorage
				? window.sessionStorage.getItem(storageKey) + ''
				: '';
		}

		// We set things up when event `afterSetup.tribeEvents` fires (which occurs when the calendar view is
		// first initialized, and during ajax refreshes, etc).
		$( document ).on(
			'afterSetup.tribeEvents',
			function () {
				let $container = $( this );
				// initialize the superpowers by using $container.find() for the elements so we can have multiple views on the same page.
				// thanks Gustavo! <3
				if (typeof $container !== 'undefined') {
					setup();
				}
			}
		);
	}
);
