<?php
/**
 * Stops the default legend from being inserted, even if it is activated in the
 * settings.
 *
 * If you are doing it wrong (ie, if the legend has already been displayed) then
 * this will return (bool) false, else it returns true on success.
 *
 * @return bool
 */
function teccc_remove_default_legend() {
	return TribeEventsCategoryColors::instance()->public->remove_default_legend();
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
 * @param $viewFilter
 * @return bool
 */
function teccc_reposition_legend($viewFilter) {
	return TribeEventsCategoryColors::instance()->public->reposition_legend($viewFilter);
}


/**
 * Inserts the legend at the current position. The legend must be enabled in the
 * Events Category Colors settings.
 *
 * This will still work if called at the right moment in the request (ie, from within
 * a view filter) but use of teccc_remove_default_legend() and/or
 * teccc_reposition_legend() is preferred.
 *
 * @deprecated
 */
function teccc_insert_legend() {
	do_action('teccc_legend_hook'); // Doesn't do anything now, retained for legacy purposes
	TribeEventsCategoryColors::instance()->public->show_legend();
}


/**
 * An alias for teccc_insert_legend() - this function is deprecated and it is
 * preferred to call teccc_insert_legend() directly.
 *
 * @deprecated
 */
function teccc_legend_hook() {
	_doing_it_wrong('teccc_legend_hook', __('Use of this function is deprecated'), '1.6.0B');
	teccc_insert_legend();
}