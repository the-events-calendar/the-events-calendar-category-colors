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

						<?php
						foreach ($options as $option): {
						?>
							<tr><td><?php echo $option; ?></td>
		<td><input type="text" size="7" name="teccc_options[$option->background]" value="<?php echo $option->background; ?>" /></td>
		<td><select name='teccc_options[$option->text]'>
		<option value='#333' <?php selected('black', $option->textcolor); ?>>Black</option>
		<option value='#fff' <?php selected('white', $option->textcolor); ?>>White</option>
		</select></td>
		<td><span style="background: <?php echo $option->background; ?>;color: <?php echo $option->text'; ?>";padding:0.5em;">Category Slug</span></td>
		</tr>

						
						<?php endforeach; ?>

<td>
						Add category slug here
					</td>
										
					<td>
						<input type="text" size="7" name="teccc_options[txt_one]" value="<?php echo $options['txt_one']; ?>" /><span style="color:#666666;margin-left:2px;">Background color in hexadecimal format.</span>
					</td>

				<!-- Select Drop-Down Control -->
					<td>
						<select name='teccc_options[drp_select_box]'>
							<option value='#333' <?php selected('black', $options['drp_select_box']); ?>>Black</option>
							<option value='#fff' <?php selected('white', $options['drp_select_box']); ?>>White</option>
							</select>
						<span style="color:#666666;margin-left:2px;">Text color</span>
					</td>
					<td><span style="background:<?php echo $options[txt_one]; ?>;color:<?php echo $options['drp_select_box']; ?>;padding:0.5em;">Category Slug</span>
					</td>


<tr><td colspan="4"><div style="margin-top:10px;"></div></td></tr>
				<tr valign="top" style="border-top:#dddddd 1px solid;">
					<th scope="row">Database Options</th>
					<td colspan="4">
						<label><input name="teccc_options[chk_default_options_db]" type="checkbox" value="1" <?php if (isset($options['chk_default_options_db'])) { checked('1', $options['chk_default_options_db']); } ?> /> Restore defaults upon plugin deactivation/reactivation</label>
						<br /><span style="color:#666666;margin-left:2px;">Only check this if you want to reset plugin settings upon Plugin reactivation</span>
					</td>
				</tr>