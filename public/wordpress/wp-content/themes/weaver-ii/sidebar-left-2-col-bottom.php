<?php
if ( !defined('ABSPATH')) exit; // Exit if accessed directly
/**
 * The Left 2 column sidebar - wide bottom
 *
 * @package WordPress
 * @subpackage Weaver II
 * @since Weaver II 1.0
 */
?>
	<div id="sidebar_wrap_left" class="left-2-col equal_height">
<?php
	weaverii_trace_sidebar(__FILE__);
	weaverii_inject_area('presidebar_left');

	//  Upper/Left -----------------------
	if (!weaverii_is_checked_page_opt('hide_sidebar_left') && !weaverii_replace_left()) {
		// The Upper/Left Widget Area
        if ( is_active_sidebar( 'left-widget-area' ) ) {
?>
	<div id="sidebar_wrap_2_left_left">
	<div id="sidebar_left" class="widget-area" role="complementary">
<?php
            dynamic_sidebar( 'left-widget-area' );
?>

	</div><!-- #sidebar_left .widget-area -->
	</div>
<?php
        }
	}

	// Lower/Right -----------------------
	if (!weaverii_is_checked_page_opt('hide_sidebar_right') && !weaverii_replace_right()) {
		// The Lower/right Widget Area
        if ( is_active_sidebar( 'right-widget-area' ) ) {
?>
	<div id="sidebar_wrap_2_left_right">
	<div id="sidebar_right" class="widget-area" role="complementary">
<?php
            dynamic_sidebar( 'right-widget-area' );
?>
	</div><!-- #sidebar_right .widget-area -->
	</div><!-- #sidebar_wrap_2_left_right -->
<?php
	}
	}

	weaverii_show_primary_sidebar();	// show default primary widget area

?>
	</div><!-- #sidebar_wrap_right -->
<?php
?>
