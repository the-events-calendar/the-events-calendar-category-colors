## Concept

Create plugin for Events Calendar that adds background color to any/all event categories. Limit text colors to black or white.

How do I write functions for my plugin that may require variables from another plugin?

### Settings page

* function for color picker for category background
* function for color of category text (black or white)
* warning if _The Events Calendar_ not installed

### CSS

* add this dynamic stylesheet to load only in calendar pages
* function to return event category names to array
* function to write out _custom_ css entries per category/color combination

### plugin

* make sure _The Events Calendar_ is installed or add warning to settings page
* wp\_register\_style
* wp\_enqueue\_style