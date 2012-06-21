## Concept

Based on http://tri.be/coloring-your-category-events/

Create plugin for Events Calendar that adds background color to any/all event categories. Limit text colors to black or white.

How do I write functions for my plugin that may require variables from another plugin?

### Settings page

* warning if _The Events Calendar_ not installed
* function to return event category slugs to array
* function to fill array with slugs and colors
  * this is mostly working but I need to figure out how to place a value in the settings array as part of an element of another array

### CSS

* add this dynamic stylesheet to load only in calendar pages
* Done - <strike>function to write out _custom_ css entries per category/color combination</strike>

### plugin

* make sure _The Events Calendar_ is installed or add warning to settings page
* wp\_register\_style
* wp\_enqueue\_style
