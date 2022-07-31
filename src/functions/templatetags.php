<?php
/**
 * The Events Calendar: Category Colors
 *
 * @author   Andy Fragen
 * @license  MIT
 * @link     https://github.com/afragen/the-events-calendar-category-colors
 * @package  the-events-calendar-category-colors
 */

/**
 * Stops the default legend from being inserted, even if it is activated in the
 * settings.
 *
 * If you are doing it wrong (ie, if the legend has already been displayed) then
 * this will return (bool) false, else it returns true on success.
 *
 * @deprecated 6.8.4.3
 */
function teccc_remove_default_legend() {
	_doing_it_wrong( 'teccc_remove_default_legend', esc_html__( 'Use of this function is deprecated .', 'the-events-calendar-category-colors' ), '6.4.8.3' );
}


/**
 * You can reposition the legend by specifying a different view filter (see The Events
 * Calendar documentation for details). TECCC will then use that to display the legend.
 *
 * If you are doing it wrong (ie, the legend has already been displayed) then this will
 * return (bool) false, else it returns true on success. Note however that this does
 * not guarantee the legend will be displayed (if for instance you have specified the
 * wrong hook or a hook that has already run.
 *
 * @deprecated 6.4.8.3
 */
function teccc_reposition_legend() {
	_doing_it_wrong( 'teccc_reposition_legend', esc_html__( 'Use of this function is deprecated.', 'the-events-calendar-category-colors' ), '6.4.8.3' );
}


/**
 * Inserts the legend at the current position. The legend must be enabled in the
 * Events Category Colors settings.
 */
function teccc_insert_legend() {
	Fragen\Category_Colors\Main::instance()->public->show_legend();
}


/**
 * An alias for teccc_insert_legend() - this function is deprecated and it is
 * preferred to call teccc_insert_legend() directly.
 *
 * @deprecated 1.6.0B
 */
function teccc_legend_hook() {
	_doing_it_wrong( 'teccc_legend_hook', esc_html__( 'Use of this function is deprecated, use `teccc_insert_legend()`', 'the-events-calendar-category-colors' ), '1.6.0B' );
}


/**
 * Registers an additional text color.
 *
 * The color value should be a valid CSS color value. For example, the following are all valid values for red:
 *
 *  #f00
 *  #ff0000
 *  Red
 *
 * @param string $name  Color name.
 * @param string $value Color value.
 */
function teccc_add_text_color( $name, $value ) {
	Fragen\Category_Colors\Main::instance()->text_colors[ $name ] = $value;
}


/**
 * Sets categories (identified by their slugs) which should be ignored by the The Events Calendar: Category Colors.
 *
 * @params array $slug Array of slugs.
 */
function teccc_ignore_slug() {
	$slugs = func_get_args();
	foreach ( $slugs as $slug ) {
		Fragen\Category_Colors\Main::instance()->ignore_list[] = $slug;
	}
}

/**
 * Shows the legend in an additional view.
 *
 * @param string $view ('list', 'day', 'week', or 'photo').
 */
function teccc_add_legend_view( $view ) {
	Fragen\Category_Colors\Main::instance()->public->add_legend_view( $view );
}
