<?php
if ( !defined('ABSPATH')) exit; // Exit if accessed directly
/**
 * The Right Split Sidebar.
 *
 * @package WordPress
 * @subpackage Weaver II
 * @since Weaver II 1.0
 */
?>
	<div id="sidebar_wrap_right" class="split equal_height">
<?php
	weaverii_trace_sidebar(__FILE__);
	weaverii_inject_area('presidebar_right');
	weaverii_show_primary_sidebar();	// show default primary widget area

	// Upper/Right -----------------------
	if (!weaverii_is_checked_page_opt('hide_sidebar_right') && !weaverii_replace_right()) {
		// The Upper/right Widget Area
        if ( is_active_sidebar( 'right-widget-area' ) ) { ?>
	<div id="sidebar_right" class="widget-area" role="complementary">
<?php
            dynamic_sidebar( 'right-widget-area' ); ?>

	</div><!-- sidebar_right .widget-area -->
<?php
        }
	}
?>
	</div><!-- #sidebar_wrap_right -->
<?php
?>
