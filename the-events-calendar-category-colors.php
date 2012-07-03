<?php
/*
Plugin Name: The Events Calendar Category Colors
Plugin URI: http://wordpress.org/extend/plugins/the-events-calendar-category-colors/
Description: This plugin adds background coloring to The Events Calendar plugin.
Version: 0.2
Text Domain: events-calendar-category-colors
Author: Andy Fragen
Author URI: http://thefragens.com/blog/
License: GNU General Public License v2
License URI: http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
*/

/**
* The Events Calendar Category Colors
*
* This plugin adds background coloring to The Events Calendar plugin.
*
* @package      the-events-calendar-pro-alarm
* @link         https://github.com/afragen/events-calendar-category-colors/
* @link         http://wordpress.org/extend/plugins/the-events-calendar-category-colors/
* @author       Andy Fragen <andy@thefragens.com>
* @copyright    Copyright (c) 2012, Andrew Fragen
*
* The Events Calendar Category Colors is free software; you can redistribute it and/or modify it under
* the terms of the GNU General Public License version 2, as published by the
* Free Software Foundation.
*
* You may NOT assume that you can use any other version of the GPL.
*
* This program is distributed in the hope that it will be useful, but WITHOUT
* ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
* FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details
*
* You should have received a copy of the GNU General Public License along with
* this program; if not, write to:
*
*      Free Software Foundation, Inc.
*      51 Franklin St, Fifth Floor
*      Boston, MA  02110-1301  USA
*
* The license for this software can also likely be found here:
* http://www.gnu.org/licenses/gpl-2.0.html*
*/
/* Add your functions below this line */


function getCategorySlugs() {
	$terms = get_terms("tribe_events_cat");
	$slugs = array();
	foreach ($terms as $term) {
		$slugs[] = $term->slug;
	}
	return $slugs;
}
	
function writeCategoryCSS() { 
	$slugs = getCategorySlugs();
	$count = count($slugs);
	$options = get_option('teccc_options');
	$catCSS = array();
	$catCSS[] = "<!-- The Events Calendar Category Colors generated CSS -->";
	$catCSS[] = "<style type=\"text/css\" media=\"screen\">";
	$catCSS[] = ".tribe-events-calendar a { font-weight: bold; }";
	for ($i = 0; $i < $count; $i++) {
		$catCSS[] = '.tribe-events-calendar .cat_' . $slugs[$i] . ' a { color: ' .  $options[$slugs[$i].'-text'] . '; }' ;
		$catCSS[] = '.tribe-events-calendar .cat_' . $slugs[$i] . ', .cat_' . $slugs[$i] . ' > .tribe-events-tooltip .tribe-events-event-title { background-color: ' . $options[$slugs[$i].'-background'] . '; }' ;
	}
	$catCSS[] = "</style>";
	$content = implode( "\n", $catCSS ) . "\n";
	echo $content;
	return $content;
}


// 'teccc_' prefix is derived from [tec]the events calendar [c]ategory [c]olors

// ------------------------------------------------------------------------
// REGISTER HOOKS & CALLBACK FUNCTIONS:
// ------------------------------------------------------------------------
// HOOKS TO SETUP DEFAULT PLUGIN OPTIONS, HANDLE CLEAN-UP OF OPTIONS WHEN
// PLUGIN IS DEACTIVATED AND DELETED, INITIALISE PLUGIN, ADD OPTIONS PAGE.
// ------------------------------------------------------------------------

// Set-up Action and Filter Hooks
register_activation_hook(__FILE__, 'teccc_add_defaults');
register_uninstall_hook(__FILE__, 'teccc_delete_plugin_options');
add_action('admin_init', 'teccc_init' );
add_action('admin_menu', 'teccc_add_options_page');
add_filter( 'plugin_action_links', 'teccc_plugin_action_links', 10, 2 );

// --------------------------------------------------------------------------------------
// CALLBACK FUNCTION FOR: register_uninstall_hook(__FILE__, 'teccc_delete_category_colors')
// --------------------------------------------------------------------------------------
// THIS FUNCTION RUNS WHEN THE USER DEACTIVATES AND DELETES THE PLUGIN. IT SIMPLY DELETES
// THE PLUGIN OPTIONS DB ENTRY (WHICH IS AN ARRAY STORING ALL THE PLUGIN OPTIONS).
// --------------------------------------------------------------------------------------

// Delete options table entries ONLY when plugin deactivated AND deleted
function teccc_delete_plugin_options() {
	delete_option('teccc_options');
}

// ------------------------------------------------------------------------------
// CALLBACK FUNCTION FOR: register_activation_hook(__FILE__, 'teccc_add_defaults')
// ------------------------------------------------------------------------------
// THIS FUNCTION RUNS WHEN THE PLUGIN IS ACTIVATED. IF THERE ARE NO THEME OPTIONS
// CURRENTLY SET, OR THE USER HAS SELECTED THE CHECKBOX TO RESET OPTIONS TO THEIR
// DEFAULTS THEN THE OPTIONS ARE SET/RESET.
//
// OTHERWISE, THE PLUGIN OPTIONS REMAIN UNCHANGED.
// ------------------------------------------------------------------------------

// Define default option settings
function teccc_add_defaults() {
	$slugs = getCategorySlugs();
	$count = count($slugs);
	$tmp = get_option('teccc_options');
    if(($tmp['chk_default_options_db']=='1')||(!is_array($tmp))) {
		delete_option('teccc_options'); // so we don't have to reset all the 'off' checkboxes too! (don't think this is needed but leave for now)
		for ($i = 0; $i < $count; $i++) {
			$arr[$slugs[$i]."-text"] = "#333";
			$arr[$slugs[$i]."-background"] = "transparent";
		}
		update_option('teccc_options', $arr);
	}
}

// ------------------------------------------------------------------------------
// CALLBACK FUNCTION FOR: add_action('admin_init', 'teccc_init' )
// ------------------------------------------------------------------------------
// THIS FUNCTION RUNS WHEN THE 'admin_init' HOOK FIRES, AND REGISTERS YOUR PLUGIN
// SETTING WITH THE WORDPRESS SETTINGS API. YOU WON'T BE ABLE TO USE THE SETTINGS
// API UNTIL YOU DO.
// ------------------------------------------------------------------------------

// Init plugin options to white list our options
function teccc_init(){
	register_setting( 'teccc_category_colors', 'teccc_options', 'teccc_validate_options' );
}

// ------------------------------------------------------------------------------
// CALLBACK FUNCTION FOR: add_action('admin_menu', 'teccc_add_options_page');
// ------------------------------------------------------------------------------
// THIS FUNCTION RUNS WHEN THE 'admin_menu' HOOK FIRES, AND ADDS A NEW OPTIONS
// PAGE FOR YOUR PLUGIN TO THE SETTINGS MENU.
// ------------------------------------------------------------------------------

// Add menu page
function teccc_add_options_page() {
	add_options_page('The Events Calendar Category Colors Options Page', 'TEC Category Colors', 'manage_options', __FILE__, 'teccc_render_form');
}

// ------------------------------------------------------------------------------
// CALLBACK FUNCTION SPECIFIED IN: add_options_page()
// ------------------------------------------------------------------------------
// THIS FUNCTION IS SPECIFIED IN add_options_page() AS THE CALLBACK FUNCTION THAT
// ACTUALLY RENDER THE PLUGIN OPTIONS FORM AS A SUB-MENU UNDER THE EXISTING
// SETTINGS ADMIN MENU.
// ------------------------------------------------------------------------------

// Render the Plugin options form
function teccc_render_form() {	?>
	<div class="wrap">
		
		<!-- Display Plugin Icon, Header, and Description -->
		<div class="icon32" id="icon-options-general"><br></div>
		<h2>The Events Calendar Category Colors</h2>
		<p>This is inspired by <a href="http://tri.be/coloring-your-category-events/">Coloring Your Category Events</a>.</p>
		
		<?php if (!current_user_can('manage_options')) {  
    		wp_die('You do not have sufficient permissions to access this page.');  
		} ?>
		
		<!-- Beginning of the Plugin Options Form -->
		<form method="post" action="options.php">
			<?php settings_fields('teccc_category_colors'); ?>
			<?php $options = get_option('teccc_options'); ?>

			<!-- Table Structure Containing Form Controls -->
			<!-- Each Plugin Option Defined on a New Table Row -->
			<table class="form-table">

						
				<!-- following function creates options for each category -->
				<?php echo teccc_options_elements($options); ?>
					
				<tr><td colspan="4"><div style="margin-top:10px;"></div></td></tr>
				<tr valign="top" style="border-top:#dddddd 1px solid;">
					<th scope="row">Database Options</th>
					<td colspan="4">
						<label><input name="teccc_options[chk_default_options_db]" type="checkbox" value="1" <?php if (isset($options['chk_default_options_db'])) { checked('1', $options['chk_default_options_db']); } ?> /> Restore defaults upon plugin deactivation/reactivation</label>
						<br /><span style="color:#666666;margin-left:2px;">Only check this if you want to reset plugin settings upon Plugin reactivation</span>
					</td>
				</tr>
		
			</table>
			<p class="submit"><input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" /></p>
		</form>
		
		<pre style="border:1px #333 dotted;white-space:pre-wrap;">
		<?php $css = writeCategoryCSS();
			$css = htmlentities($css);
			print ($css);
		 ?>
		</pre>
	</div>
<?php }


function teccc_options_elements($options) {
	$slugs = getCategorySlugs();
	$count = count($slugs);
	$form = array();
	$form[] = "<tr><th><strong>Category Slug</strong></th><th><strong>Background Color<br />(hex, rgb, color name)</strong></th><th><strong>Text Color</strong></th><th><strong>Current Display</strong></th></tr>";
	for ($i = 0; $i < $count; $i++) {
		$form[] = "<tr>";
		$form[] = "<td>" . $slugs[$i] . "</td>";
		$form[] = "<td><input type=\"text\" size=\"12\" name=\"teccc_options[" . $slugs[$i] . "-background]\" value=\"" . $options[$slugs[$i].'-background'] . "\" /></td>" ;
		$form[] = "<td><select name='teccc_options[" . $slugs[$i] . "-text]'>" ;
		$form[] = "<option value='#333'" . selected('#333', $options[$slugs[$i].'-text'], false) . ">Black</option>";
		$form[] = "<option value='#fff'" . selected('#fff', $options[$slugs[$i].'-text'], false) . ">White</option>" . "</select></td>";
 
		$form[] = "<td><span style=\"border:1px #ddd solid;background:" . $options[$slugs[$i].'-background'] . ";color:" . $options[$slugs[$i].'-text'] . ";padding:0.5em 1em;font-weight:bold;\">Event Title</span></td>";
		$form[] = "</tr>";
	}
	$content = implode ( "\n", $form );
	return $content;
}
					

// Sanitize and validate input. Accepts an array, return a sanitized array.
function teccc_validate_options($input) {
	$text_colors = array("#fff", "#333");
	$slugs = getCategorySlugs();
	$count = count($slugs);
	for ($i = 0; $i < $count; $i++) {
		// Sanitize textbox input (strip html tags, and escape characters)
		$input[$slugs[$i].'-background'] =  wp_filter_nohtml_kses($input[$slugs[$i].'-background']);
		$input[$slugs[$i].'-background'] =  ereg_replace( "[^#A-Za-z0-9]", "", $input[$slugs[$i].'-background'] );
		// Sanitize dropdown input (make sure value is one of options allowed)
		if ( !in_array($input[$slugs[$i].'-text'], $text_colors, true) ) {
			$input[$slugs[$i].'-text'] = "#333";
		} 
	}
	return $input;
}

// Display a Settings link on the main Plugins page
function teccc_plugin_action_links( $links, $file ) {

	if ( $file == plugin_basename( __FILE__ ) ) {
		$teccc_links = '<a href="'.get_admin_url().'options-general.php?page=events-calendar-category-colors/the-events-calendar-category-colors.php">'.__('Settings').'</a>';
		// make the 'Settings' link appear first
		array_unshift( $links, $teccc_links );
	}
	return $links;
}

//Todo - Selectively apply wp_head to month view only
add_action('wp_head', 'writeCategoryCSS');

?>