<?php
header("Content-type: text/css");

//define the variables

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
	

function writeCategoryCSS ($cat_slugs) {
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

$content = writeCategoryCSS($cat_slugs);

echo <<<CSS

/* --- start of css --- */

.tribe-events-calendar a { font-weight: bold; }

$content

/* --- end of css --- */

CSS;
?>
