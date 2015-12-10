=== The Events Calendar Category Colors ===
Contributors: afragen, barry.hughes
Donate link: http://thefragens.com/category-colors-donate
Tags: events, color, modern tribe, tribe
Requires at least: 3.8
Tested up to: 4.4
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Add event category background colors to The Events Calendar events.

== Description ==

Add background colors to event categories displayed in the event views of The Events Calendar. This is inspired by the post <i>Coloring Your Category Events</i>.

Settings for The Events Calendar Category Colors plugin are located in their own tab on The Events Calendar Settings page.

Requires PHP 5.3 or greater.

== Installation ==

1. Upload the entire `/the-events-calendar-category-colors/` folder to the `/wp-content/plugins/` directory.
1. Activate the plugin.
1. Go to the Category Colors tab of The Event Calendar Settings page.

== Frequently Asked Questions ==

= Does the plugin require The Events Calendar plugin? =

Yes. [The Events Calendar plugin](http://wordpress.org/plugins/the-events-calendar/) is written by Modern Tribe, Inc. It requires at least The Events Calendar v3.0.


= What if I use a version of The Events Calendar 2.x? =

The last compatible version of this plugin that works with TEC 2.x is [The Events Calendar Category Colors v1.6.3](http://downloads.wordpress.org/plugin/the-events-calendar-category-colors.1.6.3.zip).

= Where can I get more help? =

There is more extensive documentation of the plugins features and usage on the [The Events Calendar Category Colors wiki](https://github.com/afragen/the-events-calendar-category-colors/wiki).

= Where can I report bugs? =

1. Add a new topic on the [WordPress Support Forum](http://wordpress.org/tags/the-events-calendar-category-colors).
2. Add a new issue on the [github repo](https://github.com/afragen/the-events-calendar-category-colors/issues?state=open).

== Screenshots ==

1. The Events Calendar Category Colors Settings tab
2. The Events Calendar Category Colors in action
3. The Events Calendar Category Colors with Legend Superpowers in action

== Changelog ==

= 4.4.5 =
* fix superpowers to be more inclusive in find - thanks Lisa

= 4.4.4 =
* fix to display title full width, most noticeable in photo view
* sorry about all the quick updates, just trying to fix issues as I'm made aware of them.

= 4.4.3 =
* fix for mobile TEC 4.0

= 4.4.2 =
* fix week view all day color

= 4.4.1 =
* fix week view link color

= 4.4.0 =
* update for The Events Calendar 4.0
* fix for WordPress installation in subfolder - thanks @IndigoStarfish
* tested to WordPress 4.4

= 4.3.5 =
* escape all things for better security
* tweak declaration/initiation of variables
* tested to 4.3

= 4.3.4 =
* change CSS load order to ( PHP_MAX_INT - 100 ) to allow for overriding

= 4.3.3 =
* fix for PHP notice on Settings

= 4.3.2 =
* fix for v3.10 all day week view.

= 4.3.1 =
* update for `Tribe__Events__Filterbar__View` with CSS fix too.

= 4.3.0 =
* update for _new_ `Tribe__Events__Main` and `Tribe__Events__Pro__Main` classes
* fix CSS for week view

= 4.2.0 =
* add setting to show hidden categories - for @mending

= 4.1.0 =
* add setting to hide category on frontend
* fix a number of PHP notices

= 4.0.3 =
* fix for fatal error. Need to load namespaced class as variable as PHP < 5.3 chokes.

= 4.0.2 =
* quick fix for fatal error, I think due to naming method in WPUpdatePhp

= 4.0.1 =
* don't use variable for class name
* switch PHP version check to use WPUpdatePhp

= 4.0.0 =
* don't minify CSS when `?debug_css` - this to help in debugging
* requires PHP 5.3 or greater as requires namespacing 
* class aliases for backwards compatibility for users of ECP 3.9 or lower
* renamed directory and class names to allow for PSR 4 loading
* fix all text domain slugs and update POs
* add CSS selectors for TEC 3.10

= 3.9.7 =
* minify CSS only if `WP_DEBUG` is not true

= 3.9.6 =
* add minification to stored CSS

= 3.9.5 =
* fix for new widget CSS selectors

= 3.9.4 =
* remove Agenda view as not supported by Modern Tribe except as example template
* tested with WP 4.1

= 3.9.3 =
* fix mobile to hide tooltips, @barryhughes does it again

= 3.9.2 =
* change query inspection and test for post type to main loop - yeah @barryhughes

= 3.9.1 =
* change `get_site_url()` to `home_url()` to fix 404 - thanks @marcphilipp

= 3.9.0 =
* now using generated CSS stylesheet for events pages - yeah @barry.hughes
* no longer use inline styles, using generated stylesheet. Hopefully with browser caching it's faster.
* correctly use `$echo` in `checked()` and `selected()` for settings.
* don't kid yourselves, there may not be much to the changelog but this is a major update.

= 3.8.0 =
* add coloring to Filter Bar in checkbox mode

= 3.7.0 =
* added coloring to responsive month view
* code cleanup
* fix to only add CSS once per page load
* fix for `teccc_add_legend_css` action hook


= 3.6.4 =
* can't use class variable to point to constant in PHP < 5.3

= 3.6.3 =
* needed to declare $version as public static

= 3.6.2 =
* updated for widget CSS changes in v3.7
* programmatically add plugin version number
* fix for legend not displaying in some views after AJAX call

= 3.6.1 =
* added template overrides for views, place override in `wp-content/themes/{your_theme}/tribe-events/teccc/`
* legend superpowers now works in week view
* adjusted CSS selector for non-categorized events in week view
* adjust legend superpowers to not load in responsive views

= 3.5.2 =
* adjust Legend CSS from `display: inline` to `display: inline-block`. This should fix wrapping issues.
* fix for Legend causing events in responsive view to display above the grid. Thanks @rksystems for pointing it out and special thanks to @barry.hughes for fixing.

= 3.5.1 =
* fixes for TEC/ECP 3.6 compatibility

= 3.5.0 =
* renamed `Tribe_Events_Category_Colors_Extras::hide_default_week_background` to `Tribe_Events_Category_Colors_Extras::fix_default_week_background`, a bit more descriptive.
* updated CSS for new responsive views

= 3.4.10 =
* moved CSS for ECP into `class Tribe_Events_Category_Colors_Extras`
* adjusted CSS for ECP Week view
* moved Category Colors settings tab before Help tab

= 3.4.9 =
* decided to remove CSS for Cost button as button not created by this plugin
* update for live preview to admin settings
* a few more spacing/braces updates for WP Coding Guidelines
* fix to show empty categories in settings - props @KoenRijpstra via GitHub

= 3.4.8 =
* minor CSS fix for iPhone and Cost button

= 3.4.7 =
* more CSS adjustments to Cost button

= 3.4.6 =
* adjusted CSS Upcoming view(s)
* added CSS to move Cost button down

= 3.4.5 =
* added colors for Venue and Organizer views of ECP
* code more in line with WP Coding Guidelines

= 3.4.4 =
* switched off Week view background CSS change until ECP bug is fixed.

= 3.4.3 =
* Spanish translation (Andrew Kurtis and [WebHostingHub](http://www.webhostinghub.com)
* fix so unchecking 'Colorize Widgets' really doesn't colorize widgets in all circumstances

= 3.4.2 =
* changed method of inserting CSS to allow for default permalinks

= 3.4.1 =
* resized screenshots, sorry

= 3.4.0 =
* added setting for colorizing widgets

= 3.3.0 =
* added CSS for venue widget, though still need category class tags from Modern Tribe
* added coloring for Map view
* changed deprecated `ereg_replace` to `preg_replace`
* removed widget coloring dependency upon template override, switching to new action hooks, `tribe_events_before_list_widget` and `tribe_events_mini_cal_after_the_grid` for TEC 3.4.x
* new screenshots

= 3.2.1 =
* testing and works in WP 3.8 and The Events Calendar 3.3
* adjusted widget CSS for TECPro 3.3

= 3.2.0 =
* added support for [Agenda View plugin](https://github.com/moderntribe/tribe-events-agenda-view)
* now loading of `class Tribe_Events_Category_Colors_Widgets` and `class Tribe_Events_Category_Colors_Extras` as extenders of `class Tribe_Events_Category_Colors_Public`.
* removed link to tutorial inspiring this plugin as it now 404 :-(
* added support for coloring weekly view

= 3.1.2 =
* bugfix for undefined index error

= 3.1.1 =
* bugfix for listing of incorrect events in widget.
* needed to change widget css function to static

= 3.1.0 =
* switched to native WordPress Iris Color Picker
* fixed internationalization of category links in legend
* fixes for internationalization (i18n)
* many thanks to @fxbenard and the WP-Translations team.

= 3.0.5 =
* fixed messed up version number
* added .pot file for localization

= 3.0.4 =
* widgets colorized (needs template overrides)
* updated for WordPress Coding Guidelines
* added error warning to Settings when no categorized events exist
* setting up for localization

= 3.0.3 =
* added coloring to 'all' view
* added `teccc_add_legend_view()`

= 3.0.2 =
* sanity check in category.css.php when !(isset($extra_user_legend_css))

= 3.0.1 =
* fix for legend to display only on month view
* minor spacing fixes to class-public.php

= 3.0 =
* updated for new TEC 3.0 code, will not work for TEC < 3.0
* new instant preview of Settings
* coloring in Month, List, Day and Photo views
* coloring of tooltips in Week view
* added some actions and filters, refer to wiki for listing
* updated class and file naming to WordPress Coding Guidelines
* new Help section of [Github Wiki](https://github.com/afragen/the-events-calendar-category-colors/wiki)

= 1.6.3 =
* add transition to Transparent/Color Picker option
* use wp_enqueue_script for legend-superpowers.js
* move most externally called javascript to load in footer
* fix for language translation in Legend _category_ link
* removed extraneous `name` attribute from legend.php

= 1.6.2 =
* changed to slideUp/slideDown transition when Add Category Legend checked/unchecked
* reorganized plugin specific javascript and CSS to load correctly via admin_enqueue_scripts, even to footer.
* removed extra closing td tag in admin section

= 1.6.1 =
* removed function remove_tribe_cat_once from merge
* respaced rendered CSS so it looks better in 'view source'
* added #legend_box.tribe-events-calendar to properly set category name text color
* included function for checking TEC plugin active, missing from merge - OOPS
* fixed PHP error in classes/categorycolors.php - TribeEvents not defined
* merge issue#3
* fix for CSS superpowers and Ajax
* updated for miniColors 2.0

= 1.6.0B =
* still experimental!
* refactoring work: changes under the hood for the benefit of mankind
* the category legend can now have super-powers added to it
* from Barry Hughes

= 1.5.6 =
* removed function remove_tribe_cat_once and put it into a gist to use as needed. Please refer to FAQ for details.

= 1.5.5 =
* added preference to remove coloring if calendar is styled like first event of the month.

= 1.5.4 =
* making remove_tribe_cat_once even more specific

= 1.5.3 =
* made fix to remove_tribe_cat_once a little safer

= 1.5.2 =
* fix to make function remove_tribe_cat_once selective only for default template (::fingers crossed::)

= 1.5.1 =
* code cleanup and switch to current version of jQuery-miniColors.
* added function to remove first instance of category class tag added to article tag - Thanks Barry!
* tested with WP 3.5

= 1.5 =
* abstracted main script using new TribeEventsCategoryColors class
* fail message to admin_notices

= 1.4.5 =
* load only with class TribeEvents
* Continuity with fail message

= 1.4.4 =
* simplify legend CSS some more
* Don't deactivate plugin if TEC deactivated, just show error.

= 1.4.3 =
* Removed text-transform:uppercase from legend, I don't want to make too many decisions. Easier to add than to remove.

= 1.4.1 =
* Abstracted legend code a bit

= 1.4 =
* jQuery color picker now default behaviour
* Added checkbox for _transparent_ value

= 1.3.6 =
* more legend CSS tweaks
* more code cleanup

= 1.3.5 =
* convert space to nbsp in legend
* legend CSS tweaks
* more code cleanup

= 1.3.4 =
* settings display changes
* change to tribe_settings_form_element_tab_{currentTab}, after all I did ask to have it put in. ;-)

= 1.3.3 =
* Prep for using jQuery color picker
* minor CSS tweaks
* major code cleanup

= 1.3.2 =
* Added brief instructions for legend to settings page.

= 1.3.1 =
* fix for legend links

= 1.3 =
* Added links to legend

= 1.2.6 =
* fixes for readme

= 1.2.5 =
* Added Category Color legend

= 1.2.4 =
* Fixed another tooltip bug

= 1.2.3 =
* Fixed tooltip bug

= 1.2.2 =
* Added option for colored left border, default is transparent.

= 1.2.1 =
* bump

= 1.2 =
* fix typos

= 1.1 =
* Cleaner check for TEC

= 1.0 =
* Added checks for TEC active
* Fixed Save settings notification
* Added option to bold/unbold text.

= 0.9 =
* Adjusted add_CSS function to query both post_type and eventDisplay.
* Converted text color options to an global array for greater ability to add more choices.

= 0.8 =
* CSS now only added to month view calendar page.
* Added option for gray text.

= 0.7 =
* Bugs fixed. Back to Category Colors settings tab.

= 0.6.1 =
* Reverted back to it's own settings page till I get a bug worked out.
* Added option for 'Default' text color

= 0.5 =
* Added Category Colors settings tab to The Events Calendar Settings page using TribeSettings API
* code cleanup

= 0.2 =
* Bug fixes
* default background color now transparent
* updated sanitizing

= 0.1 =
* Initial release.

== Attribution ==

Thanks to jonahcoyote for some early help and direction.

Big thanks to Barry Hughes (WebsiteBakery) for refactoring code and Legend Superpowers.

Translations courtesy of:

 * Francois-Xavier B&eacute;nard and the group at [WP-Translations](http://wp-translations.org)
 * Andrew Kurtis and [WebHostingHub](http://www.webhostinghub.com)

== Upgrade Notice ==

= 0.5 =
This version integrates more tightly with The Events Calendar plugin putting settings on the same page.

= 1.6.3 =
This is the last version to work with The Events Calendar 2.x

= 4.0.0 =
Requires PHP 5.3 or greater
