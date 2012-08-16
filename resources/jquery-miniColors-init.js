jQuery(document).ready( function() {
	jQuery(".color-picker").miniColors({
		letterCase: 'uppercase',
		change: function(hex, rgb) {
			logData('change', hex, rgb);
		},
	});				
});
