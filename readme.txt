# The Events Calendar Category Colors
Contributors: afragen, barry.hughes
Donate link: https://thefragens.com/category-colors-donate
Tags: events, color, modern tribe, tribe
Requires at least: 4.7
Requires PHP: 5.6
Tested up to: 5.2
Stable tag: 6.3.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Add event category background colors to The Events Calendar events.

## Description

Add background colors to event categories displayed in the event views of The Events Calendar. This is inspired by the post _Coloring Your Category Events_.

Settings for The Events Calendar Category Colors plugin are located in their own tab on The Events Calendar Settings page.

To force a refresh of your CSS, add `?refresh_css` to the end of your events URL.

## Frequently Asked Questions

### Does the plugin require The Events Calendar plugin?

Yes. [The Events Calendar plugin](http://wordpress.org/plugins/the-events-calendar/) is written by Modern Tribe, Inc. It requires at least The Events Calendar v3.0.


### What if I use a version of The Events Calendar 2.x?

The last compatible version of this plugin that works with TEC 2.x is [The Events Calendar Category Colors v1.6.3](http://downloads.wordpress.org/plugin/the-events-calendar-category-colors.1.6.3.zip).

### Where can I get more help?

There is more extensive documentation of the plugins features and usage on the [The Events Calendar Category Colors wiki](https://github.com/afragen/the-events-calendar-category-colors/wiki).

### Where can I report bugs?

1. Add a new topic on the [WordPress Support Forum](http://wordpress.org/tags/the-events-calendar-category-colors).
2. Add a new issue on the [github repo](https://github.com/afragen/the-events-calendar-category-colors/issues?state=open).

## Screenshots

1. The Events Calendar Category Colors Settings tab
2. The Events Calendar Category Colors in action
3. The Events Calendar Category Colors with Legend Superpowers in action

## Changelog

#### 6.3.0 / 2019-10-04
* structural reorganization of plugin
* update WordPress and PHP requirements to align with The Events Calendar
* remove `GLOB_BRACE` as unneeded and limiting [#108](https://github.com/afragen/the-events-calendar-category-colors/pull/108), thanks @DakuTree

#### 6.2.0
* add filter to set options hash, hopefully this solves an issue with load balancers not having current files
* change `wp_get_updload_dir()` to `wp_upload_dir()` so that if the directory doesn't exist it is created
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

Translations courtesy of:

 * Francois-Xavier B&eacute;nard and the group at [WP-Translations](http://wp-translations.org)
 * Andrew Kurtis and [WebHostingHub](http://www.webhostinghub.com)

## Upgrade Notice

#### 0.5
This version integrates more tightly with The Events Calendar plugin putting settings on the same page.

#### 1.6.3
This is the last version to work with The Events Calendar 2.x

#### 4.0.0
Requires PHP 5.3 or greater
