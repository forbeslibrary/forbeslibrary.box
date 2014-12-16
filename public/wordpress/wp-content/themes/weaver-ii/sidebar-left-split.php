<?php
if ( !defined('ABSPATH')) exit; // Exit if accessed directly
/**
 * The Left Split Sidebar
 *
 * @package WordPress
 * @subpackage Weaver II
 * @since Weaver II 1.0
 */
?>
	<div id="sidebar_wrap_left" class="split equal_height">
<?php
	weaverii_trace_sidebar(__FILE__);
	weaverii_inject_area('presidebar_left');
	//  Upper/Left -----------------------
	if (!weaverii_is_checked_page_opt('hide_sidebar_left') && !weaverii_replace_left()) {
		// The Upper/Left Widget Area
        if ( is_active_sidebar( 'left-widget-area' ) ) { ?>
	<div id="sidebar_left" class="widget-area" role="complementary">
<?php
        dynamic_sidebar( 'left-widget-area' ); ?>

	</div><!-- #sidebar_left .widget-area -->
<?php
        }
	}
?>
	</div><!-- #sidebar_wrap_left -->
