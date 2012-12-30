jQuery(document).ready( function() {

	var consoleTimeout;

	// Display the results of the change callback on any minicolors input
	jQuery('INPUT[type=minicolors]').on('change', function() {

		var input = jQuery(this),
			hex = input.val(),
			opacity = input.attr('data-opacity'),
			text;

		// Generate text to show in console
		text = hex ? hex : 'transparent';
		if( opacity ) text += ', ' + opacity;
		text += ' / ' + jQuery.minicolors.rgbString(input)

		// Show text in console; disappear after a few seconds
		jQuery('#console').text(text).addClass('busy');
		clearTimeout(consoleTimeout);
		consoleTimeout = setTimeout( function() {
			jQuery('#console').removeClass('busy');
		}, 3000);

	});

});
