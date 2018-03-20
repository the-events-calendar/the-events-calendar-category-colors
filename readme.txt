# The Events Calendar Category Colors
Contributors: afragen, barry.hughes
Donate link: http://thefragens.com/category-colors-donate
Tags: events, color, modern tribe, tribe
Requires at least: 3.8
Requires PHP: 5.3
Tested up to: 4.9
Stable tag: 5.0.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Add event category background colors to The Events Calendar events.

## Description

Add background colors to event categories displayed in the event views of The Events Calendar. This is inspired by the post <i>Coloring Your Category Events</i>.

Settings for The Events Calendar Category Colors plugin are located in their own tab on The Events Calendar Settings page.

To force a refresh of your CSS, add `?refresh_css` to the end of your events URL.

Requires PHP 5.3 or greater.

## Installation

1. Upload the entire `/the-events-calendar-category-colors/` folder to the `/wp-content/plugins/` directory.
1. Activate the plugin.
1. Go to the Category Colors tab of The Event Calendar Settings page.

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

#### 5.0.0
* add `Default` as text color option which removes CSS color tag
* Settings will need to be re-saved due to the new settings options

#### 4.7.0
* updated autoloader
* no longer add CSS for transparency, allows for minimal overlapping styles

#### 4.6.11
* simplify check for shortcodes

#### 4.6.10
* fix regex to [correctly parse nested shortcodes](https://wordpress.org/support/topic/using-the-events-calendar-pro-shortcodes-within-visual-composer/)

#### 4.6.9
* fixed PHP Notices when hide setting selected
* update mobile CSS to override `display:none` in TEC mobile CSS

#### 4.6.8
* fixed PHP Notice with more specific test of WP_POST
* fixed text color for featured events [#79](https://github.com/afragen/the-events-calendar-category-colors/issues/79)

#### 4.6.7
* fixed PHP Notice
* added additional link color CSS selector for `#tribe-events-content`

#### 4.6.6
* added more shortcodes to list for support
* updated some week view CSS

#### 4.6.5
* fixed ECP week view
* added support for ECP week view shortcode
* make Autoloader a drop-in

#### 4.6.4
* move graceful exit to just before plugin initialization

#### 4.6.3
* added support for tribe shortcodes
* graceful failure if The Events Calendar is not active

#### 4.6.2
* added CSS selector to override Customizer month view

#### 4.6.1
* added filters and functions to provide WPML compatibility thanks @jvier for testing

#### 4.6.0
* added our own PHP version check
* added filter `teccc_fix_category_background_color` for those pesky themes that have Events Calendar specific CSS, I'm looking at you Avada

#### 4.5.1
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
