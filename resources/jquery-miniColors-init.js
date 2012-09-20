jQuery(document).ready( function() {

	jQuery(".color-picker").miniColors({
		letterCase: 'uppercase',
    	//opacity: true,
    	change: function(hex, rgba) {
    		logData('change', hex, rgba);
			//jQuery(this).val('rgba(' + rgba.r + ', ' + rgba.g + ', ' + rgba.b + ', ' + rgba.a + ')');
		},
		open: function(hex, rgba) {
			logData('open', hex, rgba);
		},
		close: function(hex, rgba) {
			logData('close', hex, rgba);
		}
	});
	
	function logData(type, hex, rgb, opacity) {
		var text = type + ': ' + hex + ', rgba(' + rgb.r + ', ' + rgb.g + ', ' + rgb.b + ',  ' + rgb.a + ')';
		jQuery("#console").prepend(text + '<br />');
	}
		
});
