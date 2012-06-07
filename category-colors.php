<?php
header("Content-type: text/css");

//define the variables
$light_color = "#d4a017"; //Gold
$dark_color = "#382d2c";  //Gray27
$title1 = $light_color;
$title2 = "#c0c0c0";  //Silver
$menu_dark_hover = "#2d2d2d"; //#373737 original

//write function to grab category slugs to array
function getCategorySlugs() {

}

//write function to return colors from plugin settings page

echo <<<CSS

/* --- start of css --- */


.tribe-events-calendar a { font-weight: bold; }


//write php function to write out the following css per event category

function categoryTextColor () {
	$text_color = sprintf( __( '.tribe-events-calendar .cat_%s a { color: $%s_text_color }', 'tribe-category-colors' ), $category_1, '\n' );
	return $text_color;
}

.tribe-events-calendar .cat_$category_1 a { color: #fff; }
.tribe-events-calendar .cat_$category_2 a { color: #fff; }
.tribe-events-calendar .cat_$category_3 a { color: #333; }


//write php function to write out the following css per event category
function categoryColor () {
	$cat_color = sprintf( __( '.tribe-events-calendar .cat_%s, .cat_%s > .tribe-events-tooltip .tribe-events-event-title { background: $%s_background; }', 'tribe-category-colors' ), $category_1, '\n' );
	return $cat_color;
}

.tribe-events-calendar .cat_$category_1, .cat_$category_1 > .tribe-events-tooltip .tribe-events-event-title { background: #6da351; }
.tribe-events-calendar .cat_$category_3, .cat_$category_3 > .tribe-events-tooltip .tribe-events-event-title { background: #fed64c; }
.tribe-events-calendar .cat_$category_2, .cat_$category_2 > .tribe-events-tooltip .tribe-events-event-title { background: #68a7d3; }

/* --- end of css --- */

CSS;
?>
