<?php
header("Content-type: text/css");

//define the variables

// $catSlugs = array( "meeting", "event", "concert" );
// 
// $cat_slugs = array(
// 	array(
// 		"slug" => "meeting",
// 		"background" => "#6da351",
// 		"text" => "#fff" ),
// 	array(
// 		"slug" => "event",
// 		"background" => "#68a7d3",
// 		"text" => "#fff" ),
// 	array(
// 		"slug" => "concert",
// 		"background" => "#fed64c",
// 		"text" => "#333" )
// 	);
// 
// function writeCatSlugArray ($catSlugs) {
// 	$count = count($catSlugs);
// 	$cat_slugs = array();
// 	for ($i = 0; $i < $count; $i++) {
// 		$cat_slugs[] = array( "slug" => $catSlugs[$i], "background" => "", "text" => "" );
// 	}
// 	
// 	print_r($cat_slugs);
// 	
// }	
// 
// function writeCategoryCSS ($cat_slugs) { // (writeCatSlugArray($catSlugs)
// 	$count = count($cat_slugs);
// 	$catCSS = array();
// 	for ($i = 0; $i < $count; $i++) {
// 		$catCSS[] = '.tribe-events-calendar .cat_' . $cat_slugs[$i]["slug"] . ' a { color: ' .  $cat_slugs[$i]["text"] . '; }' ;
// 		$catCSS[] = '.tribe-events-calendar .cat_' . $cat_slugs[$i]["slug"] . ', .cat_' . $cat_slugs[$i]["slug"] . ' > .tribe-events-tooltip .tribe-events-event-title { background: ' . $cat_slugs[$i]["background"] . '; }' ;
// 	}
// 	$content = implode( "\n", $catCSS );
// 	//echo $content;
// 	return $content;
// }

function getCatTestArray() {
	$cat_slugs = array();
	$cat_slugs = array(
		array(
			"slug" => "meeting",
			"background" => "#6da351",
			"text" => "#fff" ),
		array(
			"slug" => "event",
			"background" => "#68a7d3",
			"text" => "#fff" ),
		array(
			"slug" => "concert",
			"background" => "#fed64c",
			"text" => "#333" )
		);
	return $cat_slugs;
}

//write function to grab category slugs to array - this in settings page
function getCategorySlugs() {
	$catSlugs = array();
	
	$catSlugs = array( "meeting", "event", "concert" );
	
	return $catSlugs;
}

function writeCatSlugArray() {
	$catSlugs = getCategorySlugs();
	$count = count($catSlugs);
	$cat_slugs = array();
	for ($i = 0; $i < $count; $i++) {
		$cat_slugs[] = array( "slug" => $catSlugs[$i], "background" => "", "text" => "" );
	}
	
	print_r($cat_slugs);
	
}	

function writeCategoryCSS() { // (writeCatSlugArray($catSlugs)
	$cat_slugs = getCatTestArray();
	$count = count($cat_slugs);
	$catCSS = array();
	$catCSS[] = "<style>";
	$catCSS[] = ".tribe-events-calendar a { font-weight: bold; }";
	for ($i = 0; $i < $count; $i++) {
		$catCSS[] = '.tribe-events-calendar .cat_' . $cat_slugs[$i]["slug"] . ' a { color: ' .  $cat_slugs[$i]["text"] . '; }' ;
		$catCSS[] = '.tribe-events-calendar .cat_' . $cat_slugs[$i]["slug"] . ', .cat_' . $cat_slugs[$i]["slug"] . ' > .tribe-events-tooltip .tribe-events-event-title { background: ' . $cat_slugs[$i]["background"] . '; }' ;
	}
	$catCSS[] = "</style>";
	$content = implode( "\n", $catCSS );
	//echo $content;
	return $content;
}

$catArray = writeCatSlugArray($catSlugs);
$css = writeCategoryCSS();

echo <<<CSS

/* --- start of css --- */

.tribe-events-calendar a { font-weight: bold; }

$css

/* --- end of css --- */

CSS;
?>
