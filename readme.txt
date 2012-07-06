=== The Events Calendar Category Colors ===
Contributors: afragen, jonahcoyote
Tags: events, color, modern tribe, tribe
Requires at least: 3.1
Tested up to: 3.4.1
Stable tag: 0.6.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Add background colors to month event view of The Events Calendar events.

== Description ==

Add background colors to event categories displayed in the month event view of The Events Calendar. This is inspired by [Coloring Your Category Events](http://tri.be/coloring-your-category-events).

I still need to work on getting the settings for The Events Calendar Category Colors plugin are located in their own tab on The Events Calendar Settings page. 

== Installation ==

1. Upload the entire `/the-events-calendar-category-colors/` folder to the `/wp-content/plugins/` directory.
1. Activate the plugin.
1. Go to TEC Category Colors Settings to adjust settings, `Settings > TEC Category Colors`.


== Frequently Asked Questions ==

= Does the plugin require The Events Calendar plugin? =

Yes. [The Events Calendar plugin](http://wordpress.org/extend/plugins/the-events-calendar/) is written by Modern Tribe, Inc. It requires at least The Events Calendar v2.0.5.

= Where can I report bugs? =

Add a new topic on the [WordPress Support Forum](http://wordpress.org/tags/the-events-calendar-category-colors).

== Screenshots ==
 
 1. The Events Calendar Category Colors Settings

== Changelog ==

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

== Todo ==
* Need to fix for settings tab under The Events Calendar Settings page. I could really use an addition to the Tribe Settings API for a filter hook `tribe_settings_form_element_tab_{$currentTab}`
* Please report any bugs or suggestions.
* I need to fix the code so the CSS only shows up on the correct pages.

== Upgrade Notice ==

= 0.5 =
This version integrates more tightly with The Events Calendar plugin putting settings on the same page.
