<?php

//removed from TribeEventsCategoryColors as not using RGBA

	public function hex2rgb($hex) {
		$hex = str_replace("#", "", $hex);
 
		if(strlen($hex) == 3) {
			$r = hexdec(substr($hex,0,1).substr($hex,0,1));
			$g = hexdec(substr($hex,1,1).substr($hex,1,1));
			$b = hexdec(substr($hex,2,1).substr($hex,2,1));
		} else {
			$r = hexdec(substr($hex,0,2));
			$g = hexdec(substr($hex,2,2));
			$b = hexdec(substr($hex,4,2));
		}
		$rgb = array($r, $g, $b);
		return implode(",", $rgb); // returns the rgb values separated by commas
		return $rgb; // returns an array with the rgb values
	}
	
	public function rgba2opacity($rgba) { // rgba(255, 255, 255, 1.0)
		if ( strpbrk($rgba, '#') != false ) { return '1'; }
		$rgba = str_replace('rgba(', '', $rgba);
		$rgba = str_replace(')', '', $rgba);
		//$rgba = str_replace(' ', '', $rgba);
		$rgba = preg_replace( '/\s/', '', $rgba );
		$rgba = explode(',', $rgba);
		$opacity = array_pop($rgba);
		return $opacity;
	}
	
	public function rgb2hex($rgba) {
		if ( strpbrk($rgba, '#') != false ) { return $rgba; }
		$rgba = str_replace('rgba(', '', $rgba);
		$rgba = str_replace(')', '', $rgba);
		$rgba = preg_replace( '/\s/', '', $rgba );
		$rgba = explode(',', $rgba);

		$hex = "#";
		$hex .= str_pad(dechex($rgba[0]), 2, "0", STR_PAD_LEFT);
		$hex .= str_pad(dechex($rgba[1]), 2, "0", STR_PAD_LEFT);
		$hex .= str_pad(dechex($rgba[2]), 2, "0", STR_PAD_LEFT);
 
		return $hex;
	}


?>