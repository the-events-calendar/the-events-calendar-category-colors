/**
 * The Events Calendar: Category Colors - Legend Superpowers. Wait until the
 * document is ready then begin.
 */
jQuery(
	function ( $ ) {
		/**
		 * Manages the allocation of superpowers to individual event containers.
		 */
		class Manager {
			  static containers = {};
			  static continuity = null;
			  static index      = 0;
			  static key        = 'tecccContainerIndex';

			  /**
			   * Hook into TEC events in order to establish legend superpowers.
			   */
			  static start() {
				$( document ).on( 'afterSetup.tribeEvents', Manager.onContainerUpdate );
				document.addEventListener( 'containerReplaceBefore.tribeEvents', Manager.listenForReplacement );
			  }

			  /**
			   * Whenever the container is updated (that could be when it is initially rendered, or when it is replaced
			   * with fresh content following ajax navigation), determine its index and (re-)assign a Superpowers instance.
			   *
			   * @param event
			   */
			  static onContainerUpdate( event ) {
				  const $container       = $( event.target );
				  const assignedIndex    = Manager.continuity === null ? $container.data( Manager.key ) : Manager.continuity;
				  const assignedIndexInt = parseInt( assignedIndex, 10 );

				  // Either the index is already known to us, or we need to assign a new one.
				  const index = Manager.containers[assignedIndexInt] === undefined ? Manager.index++ : assignedIndexInt;

				  // Do we need to generate a new index, or reuse an existing one?
				  if ( Manager.containers[assignedIndexInt] === undefined ) {
					  const index = Manager.index++;
				  } else {
					  // Re-use the existing index, and deactivate the existing superpowers instance.
					  const index = assignedIndexInt;
					  Manager.containers[assignedIndexInt].deactivate();
				  }

				  // Create a new SuperPowers instance.
				  const superPowers         = new SuperPowers( $container, index );
				  Manager.containers[index] = superPowers;
				  superPowers.activate();

				  // Store the index as container data.
				  $container.data( Manager.key, index );
			  }

			  /**
			   * Maintain index continuity (important if multiple event containers are present on the same page).
			   *
			   * During ajax navigation the containers are completely replaced, and (as of TEC 6.0.11) the container index
			   * supplied via the `afterSetup.tribeEvents` event is not reliable (it will always be zero following ajax
			   * nav). So, we introduce our own means of maintaining index continuity. This is ultimately utilized to
			   * persist category selections across page loads.
			   *
			   * @param event
			   */
			  static listenForReplacement( event ) {
				  const $container    = event.detail;
				  const assignedIndex = $container.data( Manager.key );
				  Manager.continuity  = assignedIndex !== undefined ? assignedIndex : null;
			  }
		}

		/**
		 * Provides legend superpowers to event containers.
		 */
		class SuperPowers {
			/**
			 * Prepares legend superpowers for an event container.
			 *
			 * @param {jQuery} $container
			 * @param {number} index
			 */
			constructor( $container, index ) {
				this.$container     = $container;
				this.$legendEntries = this.$container.find( '.teccc-legend > ul > li' );
				this.$allEntries    = this.$container.find( 'div[class^=tribe-events-category-]' ).add(
					this.$container.find( 'article[class*=tribe_events_cat-]' )
				);

				this.storageKey = `tecccState${index}`;
				this.opacity    = 0.25;
				this.selected   = '';
				this.speed      = 500;
				this.working    = false;
			}

			/**
			 * Activates legend superpowers.
			 */
			activate() {
				this.$legendEntries.each( this.convertLegendEntries );
				this.$legendEntries.on( 'click', event => this.onSelection( event ) );
				this.applyPersistedSelection();
			}

			/**
			 * Remove event handlers.
			 */
			deactivate() {
				this.$legendEntries.off( 'click' );
			}

			/**
			 * Converts legend entries from links into spans.
			 */
			convertLegendEntries() {
				const $this = $( this );
				const $link = $this.find( 'a' );

				// Quit if preparation has already been completed (no <a> elements found).
				if ( $link.length !== 1 ) {
					return;
				}

				// Use the legend's class list to find the category slug.
				const matches = $this.attr( 'class' ).match( 'tribe_events_cat-([^\S]+)' ) || [];

				// If we cannot find the category slug, something is wrong; bail out.
				if ( matches.length !== 2 ) {
					return;
				}

				// Store the links address and slug.
				const linkSlug        = matches[1];
				const linkURL         = $link.attr( 'href' );
				const linkTitle       = $link.html().trim();
				const replacementText = `<span>${linkTitle}</span>`;

				// Tidy up - remove unnecessary elements
				$link.remove();
				$this.find( 'input' ).remove();

				$this.html( replacementText )
					.data( 'categoryURL', linkURL )
					.data( 'categorySlug', linkSlug );
			}

			/**
			 * Handles selections and de-selections of categories.
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
				const selectedCategory = event.hasOwnProperty( 'selectedCategory' )
					? event.selectedCategory
					: $( event.currentTarget ).data( 'categorySlug' );

				if ( selectedCategory === this.selected ) {
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
				const $unselected = this.$allEntries.not( slug ).not( slugv2 );

				$unselected.add( this.$legendEntries.not( slug ) ).fadeTo(
					this.speed,
					this.opacity,
					function () {
						  self.selected = selectedCategory;
						  self.working  = false;
					}
				);

				this.persistSelection( selectedCategory );

				event.stopPropagation();
			}

			/**
			 * Deselects everything.
			 */
			deselect() {
				const self = this;
				this.persistSelection( '' );

				this.$allEntries.add( this.$legendEntries ).fadeTo(
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

				if ( ! categorySlug.length ) {
					return;
				}

				const event            = new Event( 'legendSuperpowers' );
				event.selectedCategory = categorySlug;
				this.onSelection( event );
			}

			/**
			 * Record the selection of a category. To wipe the current selection, simply provide
			 * an empty string.
			 *
			 * @param {string} slug
			 */
			persistSelection( slug ) {
				if ( 'object' !== typeof window.sessionStorage ) {
					return;
				}

				window.sessionStorage.setItem( this.storageKey, slug );
			}

			/**
			 * Get the persisted selection (may be empty).
			 *
			 * @returns {string}
			 */
			getPersistedSelection() {
				// Return empty if session storage is not available.
				if ( 'object' !== typeof window.sessionStorage ) {
					return '';
				}

				const storedSlug = window.sessionStorage.getItem( this.storageKey );
				return 'string' === typeof( storedSlug ) ? storedSlug : '';
			}
		}

		/**
		 * Checks if the responsive breakpoint has been reached.
		 *
		 * @returns {boolean}
		 */
		function responsive_active() {
			return $( 'body' ).hasClass( 'tribe-mobile' );
		}

		Manager.start();
	}
);
