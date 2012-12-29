<?php

/**
 * Inserts the legend at the current position. The legend must be enabled in the
 * Events Category Colors settings.
 */
function teccc_insert_legend() {
	do_action('teccc_legend_hook');
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