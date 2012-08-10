=== The Events Calendar Category Colors ===
Contributors: afragen, jonahcoyote
Tags: events, color, modern tribe, tribe
Requires at least: 3.1
Tested up to: 3.4.1
Stable tag: 1.2.2
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


== Frequently Asked Questions ==

= Does the plugin require The Events Calendar plugin? =

Yes. [The Events Calendar plugin](http://wordpress.org/extend/plugins/the-events-calendar/) is written by Modern Tribe, Inc. It requires at least The Events Calendar v2.0.5.

= Where can I report bugs? =

Add a new topic on the [WordPress Support Forum](http://wordpress.org/tags/the-events-calendar-category-colors).

== Screenshots ==
 
 1. The Events Calendar Category Colors Settings tab

== Changelog ==

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

== Upgrade Notice ==

= 0.5 =
This version integrates more tightly with The Events Calendar plugin putting settings on the same page.

