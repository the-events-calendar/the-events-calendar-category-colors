/**
 * The Events Calendar: Category Colors - options form behaviours.
 */
jQuery( document ).ready(
	function ($) {
		let legendOption                = $( "#category_legend_setting" ).find( "input" );
		let legendOptions               = $( '#category_legend_checkboxes input[type=checkbox]' );
		let legendOptionsCheckedInitial = $( '#category_legend_checkboxes input[type=checkbox]:checked' ).length;
		let legendOptionsCheckedPrev;
		// let superpowersOptions   = $( '.legend_related_superpowers input[type=checkbox]' );
		let superpowersOptions = $( '#category_legend_superpowers .legend_superpowers input[type=checkbox]' );
		let superpowersCheckedPrev;
		let relatedOptions       = $( ".legend_related" );
		let relatedSuperpowers   = $( ".legend_related_superpowers" );
		let transparencySwitches = $( "td.color-control" ).find( "input[type='checkbox']" );

		/**
		 * Checks if the legend has been turned on. If so, the Legend Superpowers
		 * option is displayed (or else it is hidden).
		 */
		function toggleSuperpowersVisibility() {
			let legendOptionsCheckedNow = $( '#category_legend_checkboxes input[type=checkbox]:checked' ).length;

			if (legendOptionsCheckedNow == 0) {
				$( '.legend_related_notice' ).slideDown();
				$( relatedOptions ).slideUp();
			} else if (legendOptionsCheckedPrev == 0 && legendOptionsCheckedNow > 0) {
				$( '.legend_related_notice' ).slideUp();
				$( relatedOptions ).slideDown();
			} else {
				$( '.legend_related_notice' ).slideUp();
			}

			legendOptionsCheckedPrev = legendOptionsCheckedNow;
		}

		/**
		 * Checks if Legend Superpowers is on. If so, Legend Superpowers options
		 * are displayed (or else they are hidden).
		 */
		function toggleSuperpowersOptions() {
			let superpowersCheckedNow = $( '#category_legend_superpowers .legend_superpowers input[type=checkbox]:checked' ).length;
			let resetButton           = $( '#legend_reset_button' );

			if (superpowersCheckedNow == 0) {
				$( relatedSuperpowers ).slideUp();
				$( resetButton ).slideDown();
			} else if (superpowersCheckedPrev == 0 && superpowersCheckedNow > 0) {
				$( relatedSuperpowers ).slideDown();
				$( resetButton ).slideUp();
			} else {
				$( resetButton ).slideUp();
			}

			superpowersCheckedPrev = superpowersCheckedNow
		}

		/**
		 * Hide the color selector when transparency is enabled (and do the opposite,
		 * too).
		 */
		function toggleColorControls() {
			let colorSelector = $( this ).parents( "td" ).find( ".colorselector" );

			if ($( this ).prop( "checked" )) {
				$( colorSelector ).slideUp();
			} else {
				$( colorSelector ).slideDown();
			}
		}

		// Toggle Legend Superpowers visibility initially, after the page loads
		// (and run once on page load)
		toggleSuperpowersVisibility();
		// $( legendOption ).change( toggleSuperpowersVisibility );
		$( legendOptions ).change( toggleSuperpowersVisibility );

		// Toggle Legend Superpowers options visibility initially, after the page loads
		// (and run once on page load)
		toggleSuperpowersOptions();
		$( superpowersOptions ).change( toggleSuperpowersOptions );

		// Hide/show color selectors, according to whether transparency is checked
		// (and run once on page load)
		$( transparencySwitches ).change( toggleColorControls );
		$( transparencySwitches ).each( toggleColorControls );

		/**
		 * Returns the sampler element that belongs to the specified row element.
		 *
		 * @param row
		 * @return {*|jQuery}
		 */
		function getRowSampler(row) {
			let lastCell = $( row ).find( "td:last-child" );
			let sampler  = $( lastCell ).find( "span" );
			return sampler;
		}

		/**
		 * Updates the display sampler that shares a row with the specified element.
		 *
		 * @param rowElement
		 */
		function updateRowSampler(rowElement) {
			let row     = $( rowElement ).parents( "tr" );
			let sampler = getRowSampler( row );

			let borderColor            = /-border]$/;
			let backgroundColor        = /-background]$/;
			let borderTransparency     = /-border_none]$/;
			let backgroundTransparency = /-background_none]$/;
			let fontColor              = /-text]$/;
			let fontWeight             = $( "select[name='teccc_options[font_weight]']" ).val();

			let newBorderColor            = "#aaf";
			let newBackgroundColor        = "#eef";
			let newBorderTransparency     = false;
			let newBackgroundTransparency = false;
			let newFontColor              = "#000";

			// Iterate across all input, select and anchor elements in the current row
			row.find( "input" ).add( row.find( "select" ) ).add( row.find( "a" ) ).each(
				function () {
					let inputName = $( this ).attr( "name" );
					if (borderColor.test( inputName )) {
						newBorderColor = $( this ).val();
					} else if (backgroundColor.test( inputName )) {
						newBackgroundColor = $( this ).val();
					} else if (borderTransparency.test( inputName )) {
						newBorderTransparency = ($( this ).prop( "checked" ) === "checked");
					} else if (backgroundTransparency.test( inputName )) {
						newBackgroundTransparency = ($( this ).prop( "checked" ) === "checked");
					} else if (fontColor.test( inputName )) {
						newFontColor = $( this ).val();
					}
				}
			);

			if (newBorderTransparency) {
				newBorderColor = "transparent";
			}
			if (newBackgroundTransparency) {
				newBackgroundColor = "transparent";
			}

			$( sampler ).css( "border-left-color", newBorderColor )
				.css( "background-color", newBackgroundColor )
				.css( "color", newFontColor )
				.css( "font-weight", fontWeight );
		}

		// Live feedback: update background/border colors
		let colorControls = $( "table.teccc.form-table" );
		let colorInputs   = colorControls.find( "input" ).add( colorControls.find( "a" ) );
		let fontSelect    = colorControls.find( "select" );

		$( colorInputs ).add( fontSelect ).click(
			function () {
				updateRowSampler( this );
			}
		);

		// Live feedback: update font-weights
		$( "select[name='teccc_options[font_weight]']" ).change(
			function () {
				$( colorControls ).find( "tr" ).find( "td" ).each(
					function () {
						updateRowSampler( this );
					}
				);
			}
		);

		// Options for Iris color picker
		let myOptions = {
			// Fires on change event: use to implement live preview ... this is a doubly awful hack:
			//
			// 1) the change will not have propagated back to the color input when this function runs,
			// so a fractional delay is used to workaround that
			//
			// 2) we're cycling through *all* the color inputs when we do get round to updating the
			// samplers - pretty inefficient, though not the very worst thing in the world
			//
			// We're going to want to do something a little more elegant before merging this back into
			// develop.
			change: function () {
				setTimeout( function () { colorInputs.each( function () { updateRowSampler( this ) } ) }, 10 )
			},
			// Hide color picker controls on load
			hide: true,
			// No need for a common colors palette
			palettes: false
		};

		// Implement color picker
		$( '.teccc-color-picker' ).wpColorPicker( myOptions );
	}
);
