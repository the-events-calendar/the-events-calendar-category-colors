=== The Events Calendar Category Colors ===
Contributors: afragen, jonahcoyote
Tags: events, color, modern tribe, tribe
Requires at least: 3.1
Tested up to: 3.4.1
Stable tag: 1.4.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Add background colors to month event view of The Events Calendar events.

== Description ==

Add background colors to event categories displayed in the month event view of The Events Calendar. This is inspired by [Coloring Your Category Events](http://tri.be/coloring-your-category-events).

Settings for The Events Calendar Category Colors plugin are located in their own tab on The Events Calendar Settings page. 

== Installation ==

1. Upload the entire `/the-events-calendar-category-colors/` folder to the `/wp-content/plugins/` directory.
1. Activate the plugin.
1. Go to the Category Colors tab of The Event Calendar Settings page.

To include a Category Color legend above your calendar you will need to place a copy of `ecp-page-template.php` in your theme's **events** directory, similar to `my-theme/events/ecp-page-template.php`. This file is found in The Events Calendar plugin's **views** directory. Please refer to <a href="http://tri.be/themers-guide-to-the-events-calendar/">Themer's Guide for The Events Calendar</a> for reference.

Within your copy of `ecp-page-template.php` you will need to insert `<?php teccc_legend_hook(); ?>` where you want the legend to appear.

== Frequently Asked Questions ==

= Does the plugin require The Events Calendar plugin? =

Yes. [The Events Calendar plugin](http://wordpress.org/extend/plugins/the-events-calendar/) is written by Modern Tribe, Inc. It requires at least The Events Calendar v2.0.5.

= Where can I report bugs? =

Add a new topic on the [WordPress Support Forum](http://wordpress.org/tags/the-events-calendar-category-colors).

== Screenshots ==
 
1. The Events Calendar Category Colors Settings tab
2. The Events Calendar Category Colors in action

== Changelog ==

= 1.4.2 =
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

This plugin uses <a href="https://github.com/claviska/jquery-miniColors">jQuery MiniColors</a> by Cory LaViska.

Some icons by <a href="http://p.yusukekamiyamane.com/">Yusuke Kamiyamane</a>. All rights reserved.

== Upgrade Notice ==

= 0.5 =
This version integrates more tightly with The Events Calendar plugin putting settings on the same page.

