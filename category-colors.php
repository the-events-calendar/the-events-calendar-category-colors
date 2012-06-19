<?php
header("Content-type: text/css");

//define the variables

$catSlugs = array( "meeting", "event", "concert" );

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

function writeCatSlugArray ($catSlugs) {
	$count = count($catSlugs);
	$cat_slugs = array();
	for ($i = 0; $i < $count; $i++) {
		$cat_slugs[] = array( "slug" => $catSlugs[$i], "background" => "", "text" => "" );
	}
	
	print_r($cat_slugs);
	
}	

function writeCategoryCSS ($cat_slugs) { // (writeCatSlugArray($catSlugs)
	$count = count($cat_slugs);
	$catCSS = array();
	for ($i = 0; $i < $count; $i++) {
		$catCSS[] = '.tribe-events-calendar .cat_' . $cat_slugs[$i]["slug"] . ' a { color: ' .  $cat_slugs[$i]["text"] . '; }' ;
		$catCSS[] = '.tribe-events-calendar .cat_' . $cat_slugs[$i]["slug"] . ', .cat_' . $cat_slugs[$i]["slug"] . ' > .tribe-events-tooltip .tribe-events-event-title { background: ' . $cat_slugs[$i]["background"] . '; }' ;
	}
	$content = implode( "\n", $catCSS );
	//echo $content;
	return $content;
}

$catArray = writeCatSlugArray($catSlugs);
$css = writeCategoryCSS($cat_slugs);

echo <<<CSS

/* --- start of css --- */

.tribe-events-calendar a { font-weight: bold; }

$css

/* --- end of css --- */

CSS;
?>
