#### 7.3.1 / 2024-07-09

* Fix - Resolve problem for PHP 8+, avoid passing pass `null` to string specific functions. (props @afragen) [TECENG-58]

#### 7.3.0 / 2023-04-29
* updates to legend superpowers to maintain selection between time selections
* dim/undim legend superpowers menu items
* general code improvement of legend superpowers
* yeah Barry 🙌

#### 7.2.0 / 2023-03-02
* update `Frontend::show_legend()` to accomodate multiple calendar views on single page

#### 7.1.2 / 2023-01-27
* TEC converted `$view->get_slug()` to `$view::get_view_slug()` in https://github.com/the-events-calendar/the-events-calendar/pull/4091
* add checks for default values being set

#### 7.1.1 / 2022-10-16
* add `$comma` parameter to `echo_css()` to simplify placement of selectors

#### 7.1.0 / 2022-10-12
* rename title to correspond to The Events Calendar standard
* retructure CSS additions to not end with comma, added in `category.css.php`
* fix empty spacer classes to be transparent
* add CSS for TEC/ECP 6.0 feature events

#### 7.0.6 / 2022-05-20
* move all Pro CSS to `CSS\Pro`
* fix CSS for all day multiday week view
* update hook name for Events Calendar settings to load admin resources

#### 7.0.5 / 2022-05-17
* load Superpowers JS on mobile too
* improve Superpowers JS slug selection, use vanilla JS

#### 7.0.4 / 2022-05-16
* update Superpowers JS for jQuery `click` and slug selection

#### 7.0.3 / 2022-05-13
* update past event CSS
* tooltip CSS no longer available

#### 7.0.2 / 2022-05-08
* fix PHP Warning

#### 7.0.1 / 2022-05-04
* hotfix, `Base_CSS` not being written, stupid mistake on my part

#### 7.0.0 / 2022-05-04
* rewrite to use `wp_add_inline_style()` for adding CSS, no more file writing
* WPCS linting
* update requirements, PHP 7.1, WP 5.2

#### 6.7.1 / 2021-08-20
* add some error checking, [#132](https://github.com/afragen/the-events-calendar-category-colors/issues/132)

#### 6.7.0 / 2021-08-14
* update JS for jQuery 3.0, thanks @andrasguseo
* add Reset button for legend, thanks @andrasguseo
* add legend for Summary view, thanks @andrasguseo
* update Settings UI to show/hide options
* update for new Summary view in ECP
* only use `esc_attr_e` for translating strings
* add `teccc_legend_terms` filter
* update `legend.php`

#### 6.6.0 / 2021-07-07
* add @10up GitHub Actions for WordPress SVN integration
* **Reset** button added to legend in settings, navigate back to main calendar, thanks @andrasgueso

#### 6.5.0 / 2021-05-16
* updated to fix CSS url if running on non-standard port
* updated legend superpowers to work with shortcode, thanks @gustavo
* add filter `teccc_uploads_dir` to filter the `wp-content/uploads` path.
* added legend views to Settings, thanks @andrasguseo

#### 6.4.12 / 2021-01-07
* fix conflict between widget list and multiday events

#### 6.4.11 / 2020-12-5
* update for widget list [#119](https://github.com/afragen/the-events-calendar-category-colors/issues/119)

#### 6.4.10 / 2020-08-01
* silence `unlink()`

#### 6.4.9 / 2020-02-28
* updated all v2 views hook names for showing legend
* deprecate `teccc_reposition_legend()` with v2
* deprecate `teccc_remove_default_legend`, just uncheck the setting

#### 6.4.8 / 2020-02-17 - Happy Birthday Dad! 🎂
* simplify jQuery `on()` for reloading legend superpowers `setup()` and remove conditionals 🤞

#### 6.4.7 / 2020-02-06
* separate JS conditionals
* fix stylesheet URL for protocol relative link when host missing

#### 6.4.6 / 2020-02-03
* improve JS conditional to prevent JS error on non-calendar pages

#### 6.4.5 / 2020-01-31
* make JS conditional more specific so legend superpowers continue to work after prev/next

#### 6.4.4 / 2020-01-30
* now strip CSS URL scheme to avoid mixed media errors from server

#### 6.4.1 - 6.4.3 / 2020-01-28
* test explicity for `$template instanceof \Tribe\Events\Views\V2\Template`, fixes bug when also using Events Tickets
* fix Superpowers JS error, `ReferenceError: Can't find variable: tribe` and `views`

#### 6.4.0 / 2020-01-27
* explicitly set file permissions to 644 for CSS files
* updated for new v2 views or TEC and ECP
* make legend superpowers work for new v2 views, thanks Gustavo!!

#### 6.3.2 / 2019-10-30
* fixed storage of `cache_key` transient

#### 6.3.1 / 2019-10-24
* fixed incorrect CSS selector for background colors

#### 6.3.0 / 2019-10-04
* structural reorganization of plugin
* update WordPress and PHP requirements to align with The Events Calendar
* remove `GLOB_BRACE` as unneeded and limiting [#108](https://github.com/afragen/the-events-calendar-category-colors/pull/108), thanks @DakuTree

#### 6.2.0
* add filter to set options hash, hopefully this solves an issue with load balancers not having current files
* change `wp_get_upload_dir()` to `wp_upload_dir()` so that if the directory doesn't exist it is created
* the above fixes [Writing to CSS file failing](https://wordpress.org/support/topic/writing-to-css-file-failing/), thanks @dpegasusm

#### 6.1.2 / 2019-06-25
* bust CSS browser cache with `?refresh_css`
* some WPCS fixes

#### 6.1.1 / 2019-03-09
* fix PHP notice [#102](https://github.com/afragen/the-events-calendar-category-colors/pull/102)
* updated `composer.json`
* update message incompatible PHP version for consistency with WP core

#### 6.1.0 / 2018-11-25
* use composer autoloader
* remove `Back_Compat` shims, now in TEC
* SSL readme links

#### 6.0.0 / 2018-10-20
* move `teccc_get_terms` filter after filters `teccc_add_terms` and `teccc_delete_terms`
* add default values when using `teccc_add_terms` filter
* added `class Bootstrap` for plugin loading, now requires PHP 5.4+
* use `sanitize_hex_color()` for validation of color picker data
* fixed coloring for _featured events_

#### 5.3.0 / 2018-08-03
* fixed widget CSS
* move list CSS to `class Extras`
* fixed week CSS
* load stylesheet all the time, more efficient as external file
* updated `class Main` to `use Tribe__Events__Main` can now use `Tribe__Events__Main::TAXONOMY`
* refactor setup of ignored terms and term data
* add `border-right` to featured events
* updated validation code upon saving options
* use `wp_upload_url()` to for stylesheet to accomodate user directory preferences
* set SSL corrected URLs for `wp_upload_url()`, <https://core.trac.wordpress.org/ticket/25449>

#### 5.2.2 / 2018-07-28
* fixed to create CSS when files don't exist

#### 5.2.1 / 2018-07-28
* cleanup old CSS files

#### 5.2.0 / 2018-07-28
* write standard and minified CSS to files
* load minified CSS when WP_DEBUG is false
* improve minify code
* update CSS selectors for list view
* refactor CSS strings for inline format

#### 5.1.0 / 2018-07-21
* update for new tooltip title as `h3`
* added some functions for adding deprecated CSS
* added function `Extras::override_customizer()` for when _Customizer_ settings need to be overridden

#### 5.0.1 / 2018-04-06
* needed a space between CSS parameters, PhpStorm reformat code error

#### 5.0.0 / 2018-03-19
* add `Default` as text color option which removes CSS color tag
* Settings will need to be re-saved due to the new settings options

#### 4.7.0 / 2018-03-10
* updated autoloader
* no longer add CSS for transparency, allows for minimal overlapping styles

#### 4.6.11 / 2017-12-17
* simplify check for shortcodes

#### 4.6.10 / 2017-11-23
* fix regex to [correctly parse nested shortcodes](https://wordpress.org/support/topic/using-the-events-calendar-pro-shortcodes-within-visual-composer/)

#### 4.6.9 / 2017-11-19
* fixed PHP Notices when hide setting selected
* update mobile CSS to override `display:none` in TEC mobile CSS

#### 4.6.8 / 2017-07-28
* fixed PHP Notice with more specific test of WP_POST
* fixed text color for featured events [#79](https://github.com/afragen/the-events-calendar-category-colors/issues/79)

#### 4.6.7 / 2017-07-06
* fixed PHP Notice
* added additional link color CSS selector for `#tribe-events-content`

#### 4.6.6 / 2017-04-30
* added more shortcodes to list for support
* updated some week view CSS

#### 4.6.5 / 2017-04-20
* fixed ECP week view
* added support for ECP week view shortcode
* make Autoloader a drop-in

#### 4.6.4 / 2017-02-19
* move graceful exit to just before plugin initialization

#### 4.6.3 / 2017-02-19
* added support for tribe shortcodes
* graceful failure if The Events Calendar is not active

#### 4.6.2 / 2017-01-20
* added CSS selector to override Customizer month view

#### 4.6.1 / 2017-01-19
* added filters and functions to provide WPML compatibility thanks @jvier for testing

#### 4.6.0 / 2017-01-01
* added our own PHP version check
* added filter `teccc_fix_category_background_color` for those pesky themes that have Events Calendar specific CSS, I'm looking at you Avada

#### 4.5.1 / 2016-08-31
* moved older changes into [CHANGES.md](CHANGES.md)
* modified filter `teccc_fix_category_link_color` for those **really** pesky themes. The modification will require an adjustment to the way the filter is called and returned. Refer to the [wiki](https://github.com/afragen/the-events-calendar-category-colors/wiki/Filters-and-Hooks#teccc_fix_category_link_color) for details.
* above filter modification fixes issue with _Read More_ links.

#### 4.5.0
* added filter `teccc_fix_category_link_color` for those pesky themes that override everything.
* fixed ETag header in CSS
* removed Filter Bar coloring
* further optimized CSS minification

#### 4.4.6
* refactor mobile CSS and add filter `teccc_mobile_css`

#### 4.4.5
* fix superpowers to be more inclusive in find - thanks Lisa

#### 4.4.4
* fix to display title full width, most noticeable in photo view
* sorry about all the quick updates, just trying to fix issues as I'm made aware of them.

#### 4.4.3
* fix for mobile TEC 4.0

#### 4.4.2
* fix week view all day color

#### 4.4.1
* fix week view link color

#### 4.4.0
* update for The Events Calendar 4.0
* fix for WordPress installation in subfolder - thanks @IndigoStarfish
* tested to WordPress 4.4

#### 4.3.5
* escape all things for better security
* tweak declaration/initiation of variables
* tested to 4.3

#### 4.3.4
* change CSS load order to ( PHP_MAX_INT - 100 ) to allow for overriding

#### 4.3.3
* fix for PHP notice on Settings

#### 4.3.2
* fix for v3.10 all day week view.

#### 4.3.1
* update for `Tribe__Events__Filterbar__View` with CSS fix too.

#### 4.3.0
* update for _new_ `Tribe__Events__Main` and `Tribe__Events__Pro__Main` classes
* fix CSS for week view

#### 4.2.0
* add setting to show hidden categories - for @mending

#### 4.1.0
* add setting to hide category on frontend
* fix a number of PHP notices

#### 4.0.3
* fix for fatal error. Need to load namespaced class as variable as PHP < 5.3 chokes.

#### 4.0.2
* quick fix for fatal error, I think due to naming method in WPUpdatePhp

#### 4.0.1
* don't use variable for class name
* switch PHP version check to use WPUpdatePhp

#### 4.0.0
* don't minify CSS when `?debug_css` - this to help in debugging
* requires PHP 5.3 or greater as requires namespacing
* class aliases for backwards compatibility for users of ECP 3.9 or lower
* renamed directory and class names to allow for PSR 4 loading
* fix all text domain slugs and update POs
* add CSS selectors for TEC 3.10

#### 3.9.7
* minify CSS only if `WP_DEBUG` is not true

#### 3.9.6
* add minification to stored CSS

#### 3.9.5
* fix for new widget CSS selectors

#### 3.9.4
* remove Agenda view as not supported by Modern Tribe except as example template
* tested with WP 4.1

#### 3.9.3
* fix mobile to hide tooltips, @barryhughes does it again

#### 3.9.2
* change query inspection and test for post type to main loop - yeah @barryhughes

#### 3.9.1
* change `get_site_url()` to `home_url()` to fix 404 - thanks @marcphilipp

#### 3.9.0
* now using generated CSS stylesheet for events pages - yeah @barry.hughes
* no longer use inline styles, using generated stylesheet. Hopefully with browser caching it's faster.
* correctly use `$echo` in `checked()` and `selected()` for settings.
* don't kid yourselves, there may not be much to the changelog but this is a major update.

#### 3.8.0
* added coloring to Filter Bar in checkbox mode

#### 3.7.0
* added coloring to responsive month view
* code cleanup
* fix to only add CSS once per page load
* fix for `teccc_add_legend_css` action hook

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
* new Help section of [Github Wiki](https://github.com/afragen/the-events-calendar-category-colors/wiki)

#### 1.6.3
* add transition to Transparent/Color Picker option
* use wp_enqueue_script for legend-superpowers.js
* move most externally called javascript to load in footer
* fix for language translation in Legend _category_ link
* removed extraneous `name` attribute from legend.php

#### 1.6.2
* changed to slideUp/slideDown transition when Add Category Legend checked/unchecked
* reorganized plugin specific javascript and CSS to load correctly via admin_enqueue_scripts, even to footer.
* removed extra closing td tag in admin section

#### 1.6.1
* removed function remove_tribe_cat_once from merge
* respaced rendered CSS so it looks better in 'view source'
* added #legend_box.tribe-events-calendar to properly set category name text color
* included function for checking TEC plugin active, missing from merge - OOPS
* fixed PHP error in classes/categorycolors.php - TribeEvents not defined
* merge issue#3
* fix for CSS superpowers and Ajax
* updated for miniColors 2.0

#### 1.6.0B
* still experimental!
* refactoring work: changes under the hood for the benefit of mankind
* the category legend can now have super-powers added to it
* from Barry Hughes

#### 1.5.6
* removed function remove_tribe_cat_once and put it into a gist to use as needed. Please refer to FAQ for details.

#### 1.5.5
* added preference to remove coloring if calendar is styled like first event of the month.

#### 1.5.4
* making remove_tribe_cat_once even more specific

#### 1.5.3
* made fix to remove_tribe_cat_once a little safer

#### 1.5.2
* fix to make function remove_tribe_cat_once selective only for default template (::fingers crossed::)

#### 1.5.1
* code cleanup and switch to current version of jQuery-miniColors.
* added function to remove first instance of category class tag added to article tag - Thanks Barry!
* tested with WP 3.5

#### 1.5
* abstracted main script using new TribeEventsCategoryColors class
* fail message to admin_notices

#### 1.4.5
* load only with class TribeEvents
* Continuity with fail message

#### 1.4.4
* simplify legend CSS some more
* Don't deactivate plugin if TEC deactivated, just show error.

#### 1.4.3
* Removed text-transform:uppercase from legend, I don't want to make too many decisions. Easier to add than to remove.

#### 1.4.1
* Abstracted legend code a bit

#### 1.4
* jQuery color picker now default behaviour
* Added checkbox for _transparent_ value

#### 1.3.6
* more legend CSS tweaks
* more code cleanup

#### 1.3.5
* convert space to nbsp in legend
* legend CSS tweaks
* more code cleanup

#### 1.3.4
* settings display changes
* change to tribe_settings_form_element_tab_{currentTab}, after all I did ask to have it put in. ;-)

#### 1.3.3
* Prep for using jQuery color picker
* minor CSS tweaks
* major code cleanup

#### 1.3.2
* Added brief instructions for legend to settings page.

#### 1.3.1
* fix for legend links

#### 1.3
* Added links to legend

#### 1.2.6
* fixes for readme

#### 1.2.5
* Added Category Color legend

#### 1.2.4
* Fixed another tooltip bug

#### 1.2.3
* Fixed tooltip bug

#### 1.2.2
* Added option for colored left border, default is transparent.

#### 1.2.1
* bump

#### 1.2
* fix typos

#### 1.1
* Cleaner check for TEC

#### 1.0
* Added checks for TEC active
* Fixed Save settings notification
* Added option to bold/unbold text.

#### 0.9
* Adjusted add_CSS function to query both post_type and eventDisplay.
* Converted text color options to an global array for greater ability to add more choices.

#### 0.8
* CSS now only added to month view calendar page.
* Added option for gray text.

#### 0.7
* Bugs fixed. Back to Category Colors settings tab.

#### 0.6.1
* Reverted back to it's own settings page till I get a bug worked out.
* Added option for 'Default' text color

#### 0.5
* Added Category Colors settings tab to The Events Calendar Settings page using TribeSettings API
* code cleanup

#### 0.2
* Bug fixes
* default background color now transparent
* updated sanitizing

#### 0.1
* Initial release.
