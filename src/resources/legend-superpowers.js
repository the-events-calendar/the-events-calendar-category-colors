/**
 * The Events Calendar: Category Colors - Legend Superpowers. Wait until the
 * document is ready then begin.
 */
jQuery( document ).ready(
	function ($) {
		class TecccLegend {
			static setup( event, containerIndex ) {
				( new TecccLegend( event.target, containerIndex ) ).activate();
			}

			constructor( container, containerIndex ) {
				this.$container     = $(container);
				this.$legendEntries = this.$container.find('.teccc-legend > ul > li');
				this.$allEntries    = this.$container.find( 'div[class^=tribe-events-category-]' ).add(
					this.$container.find( 'article[class*=tribe_events_cat-]' )
				);

				this.storageKey = `tecccState-${containerIndex}`;
				this.opacity    = 0.25;
				this.selected   = '';
				this.speed      = 500;
				this.working    = false;
			}

			activate() {
				this.$legendEntries.each(this.convertLegendEntries);
				this.$legendEntries.on( 'click', event => this.onSelection( event ) );
				this.applyPersistedSelection();
			}

			convertLegendEntries() {
				const $this = $( this );
				const $link = $this.find( 'a' );

				// Quit if preparation has already been completed (no <a> elements found).
				if ( $link.length !== 1 ) {
					return;
				}

				// Use the legend's class list to find the category slug.
				const matches = $this.attr('class').match('tribe_events_cat-([^\S]+)');

				// If we cannot find the category slug, something is wrong; bail out.
				if ( matches.length !== 2 ) {
					return;
				}

				// Store the links address and slug.
				const linkSlug        = matches[1];
				const linkURL         = $link.attr( "href" );
				const linkTitle       = $link.html().trim();
				const replacementText = '<span>' + linkTitle + '</span>';

				// Tidy up - remove unnecessary elements
				$link.remove();
				$this.find( "input" ).remove();

				$this.html( replacementText )
					.data( 'categoryURL', linkURL )
					.data( 'categorySlug', linkSlug );
			}

			/**
			 * Handles selections and deselections of categories.
			 *
			 * @param event
			 */
			onSelection( event ) {
				const isV2Active = 0 !== $( '.tribe-events-view' ).length;
				const isV1Mobile = responsive_active();
				const self       = this;

				// If we're already working (or if we're in responsive mode) don't do anything - the visitor can wait.
				if ( this.working || ( ! isV2Active && isV1Mobile)) {
					event.stopPropagation();
					return;
				}

				// Otherwise set the working flag so that we don't end up stacking - and delaying - effects.
				this.working = true;

				// The event object may be a custom event with a selectedCategory property.
				const selectedCategory = event.hasOwnProperty('selectedCategory')
					? event.selectedCategory
					: $(event.currentTarget).data('categorySlug');

				if (selectedCategory === this.selected) {
					this.deselect( selectedCategory );
					this.working = false;
					event.stopPropagation();
					return;
				}

				// Handle selections: deselect existing selection first of all
				this.deselect();

				// Now focus in on the new selection.
				const slug        = ".tribe-events-category-" + selectedCategory;
				const slugv2      = ".tribe_events_cat-" + selectedCategory;
				const $unselected = this.$allEntries.not(slug).not(slugv2);

				$unselected.add(this.$legendEntries.not(slug)).fadeTo(
					this.speed,
					this.opacity,
					function () {
						self.selected = selectedCategory;
						self.working = false;
					}
				);

				this.persistSelection(selectedCategory);

				event.stopPropagation();
			}

			deselect() {
				const self = this;
				this.persistSelection('');

				this.$allEntries.add(this.$legendEntries).fadeTo(
					this.speed,
					1,
					function () {
						self.selected = false;
						self.working  = false;
					}
				);
			}

			/**
			 * Applies the selection saved in session storage.
			 */
			applyPersistedSelection() {
				const categorySlug = this.getPersistedSelection();

				if (! categorySlug.length) {
					return;
				}

				const event = new Event('legendSuperpowers');
				event.selectedCategory = categorySlug;
				this.onSelection(event);
			}

			/**
			 * Record the selection of a category. To wipe the current selection, simply provide
			 * an empty string.
			 *
			 * @param {string} slug
			 */
			persistSelection(slug) {
				if ('object' !== typeof window.sessionStorage) {
					return;
				}

				window.sessionStorage.setItem(this.storageKey, slug);
			}

			/**
			 * Get the persisted selection (may be empty).
			 *
			 * @returns {string}
			 */
			getPersistedSelection() {
				return 'object' === typeof window.sessionStorage
					? window.sessionStorage.getItem(this.storageKey) + ''
					: '';
			}
		}

		function responsive_active() {
			return $( "body" ).hasClass( "tribe-mobile" );
		}

		// We set things up when event `afterSetup.tribeEvents` fires (which occurs when the calendar view is
		// first initialized, and during ajax refreshes, etc).
		$( document ).on('afterSetup.tribeEvents', TecccLegend.setup);
	}
);
