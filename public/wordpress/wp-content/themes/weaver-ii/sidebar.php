<?php
if ( !defined('ABSPATH')) exit; // Exit if accessed directly
/**
 * The Sidebar containing the main widget area.
 * Weaver II does not use this itself, but this is provided for reasonable compatibility with some plugins.
 *
 * @package WordPress
 * @subpackage Weaver II
 * @since Weaver II 1.0
 */
?>
<?php
	weaverii_trace_sidebar(__FILE__);

	  if ( is_active_sidebar('per-page-plugin_replacement')) { ?>
	<div id="sidebar_plugin" class="widget-area" role="complementary">
<?php	dynamic_sidebar( 'per-page-plugin_replacement' ); ?>

	</div><!-- #sidebar_plugin.widget-area -->
<?php
	} else {
?>
	<div id="sidebar_plugin" class="widget-area" role="complementary">
	<p>If you see this message, it means you have a plugin trying to add a Sidebar to a page.
	Because of Weaver II's flexible sidebar layouts, Weaver standard sidebar areas are not compatible
	with this plugin, but this special one is. To use this area, open the
	<em>Main Options : Widget Areas : Define Per Page Widget Areas</em>
	and define a per-page area called <em>plugin_replacement</em>. Add widgets to the new
	<em>plugin_replacement</em> area, and they will be displayed here on plugin pages. If you
	do not add any widgets, then nothing will be displayed, and this message will go away.</p>
	</div>
<?php
	}
?>
	<div class="weaver-clear"></div>
<?php
?>
