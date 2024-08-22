# The Events Calendar: Category Colors
Contributors: theeventscalendar, afragen, barry.hughes
Donate link: https://theeventscalendar.com
Tags: events, color, calendar, category
Requires at least: 5.2
Requires PHP: 7.1
Tested up to: 6.6
Stable tag: 7.3.2
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Add event category background colors to The Events Calendar events.

## Description

Add background colors to event categories displayed in the event views of The Events Calendar. This is inspired by the post _Coloring Your Category Events_.

Settings for The Events Calendar: Category Colors plugin are located in their own tab on The Events Calendar Settings page.

To force a refresh of your CSS, add `?refresh_css` to the end of your events URL, or re-save the Settings.

## Frequently Asked Questions

### Does the plugin require The Events Calendar plugin?

Yes. [The Events Calendar plugin](http://wordpress.org/plugins/the-events-calendar/) is written by StellarWP. It requires at least The Events Calendar v5.0.


### What if I use a version of The Events Calendar 2.x?

The last compatible version of this plugin that works with TEC 2.x is [The Events Calendar: Category Colors v1.6.3](http://downloads.wordpress.org/plugin/the-events-calendar-category-colors.1.6.3.zip).

### Where can I get more help?

There is more extensive documentation of the plugins features and usage on the [The Events Calendar: Category Colors wiki](https://github.com/the-events-calendar/the-events-calendar-category-colors/wiki).

### Found a security vulnerability?

Make sure you are reporting in a safe and responsible way. We take security very seriously. If you discover a security issue, please bring it to our attention right away! Below you will find all the methods to report security vulnerabilities:

* [Report security bugs through the Patchstack Vulnerability Disclosure Program](https://patchstack.com/database/vdp/the-events-calendar-category-colors)
* Check our [Bug Bounty Program](https://www.liquidweb.com/policies/bug-bounty-program/)
* Reach out directly to us on `security [at] stellarwp.com`.

### Where can I report bugs?

1. Add a new topic on the [WordPress Support Forum](http://wordpress.org/tags/the-events-calendar-category-colors).
2. Add a new issue on the [github repo](https://github.com/the-events-calendar/the-events-calendar-category-colors/issues?state=open).

## Screenshots

1. The Events Calendar: Category Colors Settings tab
2. The Events Calendar: Category Colors in action
3. The Events Calendar: Category Colors with Legend Superpowers in action

## Changelog

#### 7.3.2 / 2024-08-20

* Fix - Resolve problems when Hide option not hiding categories on the frontend. (props @afragen) [TEC-5139]

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

#### 6.1.1 / 2019-03-09
* fix PHP notice [#102](https://github.com/afragen/the-events-calendar-category-colors/pull/102)
* updated `composer.json`
* update message incompatible PHP version for consistency with WP core

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
* fix to create CSS when files don't exist

#### 5.2.1 / 2018-7-28
* cleanup old CSS files

#### 5.2.0 / 2018-07-28
* write standard and minified CSS to files
* load minified CSS when WP_DEBUG is false
* improve minify code
* update CSS selectors for list view
* refactor CSS strings for inline format

#### 5.1.0
* update for new tooltip title as `h3`
* added some functions for adding deprecated CSS
* added function `Extras::override_customizer()` for when _Customizer_ settings need to be overridden

#### 5.0.1
* needed a space between CSS parameters, PhpStorm reformat code error

#### 5.0.0
* add `Default` as text color option which removes CSS color tag
* Settings will need to be re-saved due to the new settings options

See [CHANGES.md](CHANGES.md) for complete list of changes.

## Attribution

Thanks to jonahcoyote for some early help and direction.

Big thanks to Barry Hughes (WebsiteBakery) for refactoring code and Legend Superpowers.
