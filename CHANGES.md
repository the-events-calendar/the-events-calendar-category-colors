
#### 3.6.4
* can't use class variable to point to constant in PHP < 5.3

#### 3.6.3
* needed to declare $version as public static

#### 3.6.2
* updated for widget CSS changes in v3.7
* programmatically add plugin version number
* fix for legend not displaying in some views after AJAX call

#### 3.6.1
* added template overrides for views, place override in `wp-content/themes/{your_theme}/tribe-events/teccc/`
* legend superpowers now works in week view
* adjusted CSS selector for non-categorized events in week view
* adjust legend superpowers to not load in responsive views

#### 3.5.2
* adjust Legend CSS from `display: inline` to `display: inline-block`. This should fix wrapping issues.
* fix for Legend causing events in responsive view to display above the grid. Thanks @rksystems for pointing it out and special thanks to @barry.hughes for fixing.

#### 3.5.1
* fixes for TEC/ECP 3.6 compatibility

#### 3.5.0
* renamed `Tribe_Events_Category_Colors_Extras::hide_default_week_background` to `Tribe_Events_Category_Colors_Extras::fix_default_week_background`, a bit more descriptive.
* updated CSS for new responsive views

#### 3.4.10
* moved CSS for ECP into `class Tribe_Events_Category_Colors_Extras`
* adjusted CSS for ECP Week view
* moved Category Colors settings tab before Help tab

#### 3.4.9
* decided to remove CSS for Cost button as button not created by this plugin
* update for live preview to admin settings
* a few more spacing/braces updates for WP Coding Guidelines
* fix to show empty categories in settings - props @KoenRijpstra via GitHub

#### 3.4.8
* minor CSS fix for iPhone and Cost button

#### 3.4.7
* more CSS adjustments to Cost button

#### 3.4.6
* adjusted CSS Upcoming view(s)
* added CSS to move Cost button down

#### 3.4.5
* added colors for Venue and Organizer views of ECP
* code more in line with WP Coding Guidelines

#### 3.4.4
* switched off Week view background CSS change until ECP bug is fixed.

#### 3.4.3
* Spanish translation (Andrew Kurtis and [WebHostingHub](http://www.webhostinghub.com)
* fix so unchecking 'Colorize Widgets' really doesn't colorize widgets in all circumstances

#### 3.4.2
* changed method of inserting CSS to allow for default permalinks

#### 3.4.1
* resized screenshots, sorry

#### 3.4.0
* added setting for colorizing widgets

#### 3.3.0
* added CSS for venue widget, though still need category class tags from Modern Tribe
* added coloring for Map view
* changed deprecated `ereg_replace` to `preg_replace`
* removed widget coloring dependency upon template override, switching to new action hooks, `tribe_events_before_list_widget` and `tribe_events_mini_cal_after_the_grid` for TEC 3.4.x
* new screenshots

#### 3.2.1
* testing and works in WP 3.8 and The Events Calendar 3.3
* adjusted widget CSS for TECPro 3.3

#### 3.2.0
* added support for [Agenda View plugin](https://github.com/moderntribe/tribe-events-agenda-view)
* now loading of `class Tribe_Events_Category_Colors_Widgets` and `class Tribe_Events_Category_Colors_Extras` as extenders of `class Tribe_Events_Category_Colors_Public`.
* removed link to tutorial inspiring this plugin as it now 404 :-(
* added support for coloring weekly view

#### 3.1.2
* bugfix for undefined index error

#### 3.1.1
* bugfix for listing of incorrect events in widget.
* needed to change widget css function to static

#### 3.1.0
* switched to native WordPress Iris Color Picker
* fixed internationalization of category links in legend
* fixes for internationalization (i18n)
* many thanks to @fxbenard and the WP-Translations team.

#### 3.0.5
* fixed messed up version number
* added .pot file for localization

#### 3.0.4
* widgets colorized (needs template overrides)
* updated for WordPress Coding Guidelines
* added error warning to Settings when no categorized events exist
* setting up for localization

#### 3.0.3
* added coloring to 'all' view
* added `teccc_add_legend_view()`

#### 3.0.2
* sanity check in category.css.php when !(isset($extra_user_legend_css))

#### 3.0.1
* fix for legend to display only on month view
* minor spacing fixes to class-public.php

#### 3.0
* updated for new TEC 3.0 code, will not work for TEC < 3.0
* new instant preview of Settings
* coloring in Month, List, Day and Photo views
* coloring of tooltips in Week view
* added some actions and filters, refer to wiki for listing
* updated class and file naming to WordPress Coding Guidelines
* new Help section of [Github Wiki](https://github.com/afragen/events-calendar-category-colors/wiki)
