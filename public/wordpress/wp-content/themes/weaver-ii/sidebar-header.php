<?php
if ( !defined('ABSPATH')) exit; // Exit if accessed directly
/**
 * The Header widget area.
 *
 */
	global $weaverii_cur_page_ID;

	$extra = trim(get_post_meta($weaverii_cur_page_ID,'replace_horiz_header',true)); // per page replacement area?
	$xarea = '';

	if (strlen($extra) > 0) {		// want to display some areas
	$xarea = 'per-page-' . $extra;  // retrieve meta value
	if (!is_active_sidebar($xarea)) {
?>
		<h3>*** Note: Per Page widget area: <?php echo $extra; ?> not found. You've likely mistyped the name or haven't defined the area yet. Using default area. ***</h3>
<?php
		$xarea = '';
	}
	}

	$harea = ($xarea) ? $xarea : 'header-widget-area';

if (is_active_sidebar($harea)
	&& !(!is_front_page() && !is_home() && weaverii_getopt_checked('_wii_hdr_widg_frontpage'))
	&& !weaverii_is_checked_page_opt('ttw-hide-header-widget')) { // weaver header widget area
	// header-widget-1
	// wii_hdr_widg_1 -- _bgcolor _w_int _w_mobile_int
	// wii_hdr_widg_bgcolor wii_hdr_widg_h_int wii_hdr_widg_w_int wii_hdr_widg_hide_mobile
	?>
		<div id="sidebar_header" class="sidebar-header">
<?php
	weaverii_trace_sidebar(__FILE__);
?>
<?php
	// here, we duplicate the functionality of dynamic_sidebar so we can add our own styling
	for (;;) {		// so we can break instead of return
		global $wp_registered_sidebars, $wp_registered_widgets;
	$index = sanitize_title($harea);
	foreach ( (array) $wp_registered_sidebars as $key => $value ) {
		if ( sanitize_title($value['name']) == $index ) {
		$index = $key;
		break;
		}
	}
	// ok, got our index

	$sidebars_widgets = wp_get_sidebars_widgets();
	if ( empty( $sidebars_widgets ) )
		break;		// break the for (;;)

	if ( empty($wp_registered_sidebars[$index]) || !array_key_exists($index, $sidebars_widgets)
		|| !is_array($sidebars_widgets[$index]) || empty($sidebars_widgets[$index]) )
		break;

	$sidebar = $wp_registered_sidebars[$index];

	$did_one = false;
	$widget_num = 0;
	foreach ( (array) $sidebars_widgets[$index] as $id ) {

		if ( !isset($wp_registered_widgets[$id]) ) continue;

		if ($widget_num > 0 && ($widget_num % 4) == 0) {	// new row every 4 widgets
			echo '<br style="clear:both;"/>';
		}

		$params = array_merge(
			array( array_merge( $sidebar, array('widget_id' => $id, 'widget_name' => $wp_registered_widgets[$id]['name']) ) ),
			(array) $wp_registered_widgets[$id]['params']
		);

		// Substitute HTML id and class attributes into before_widget
		$classname_ = '';
		foreach ( (array) $wp_registered_widgets[$id]['classname'] as $cn ) {
			if ( is_string($cn) )
				$classname_ .= '_' . $cn;
			elseif ( is_object($cn) )
				$classname_ .= '_' . get_class($cn);
		}
		$classname_ = ltrim($classname_, '_');

		$classname_ .= ' header-widget-' . (($widget_num % 4) + 1);	// also add unique class to apply styling
				$classname_ .= ' header-widget-num-' . ($widget_num  + 1);	        // also add unique class for each one

		$params[0]['before_widget'] = sprintf($params[0]['before_widget'], $id, $classname_ );

		//$params = apply_filters( 'dynamic_sidebar_params', $params );

		$callback = $wp_registered_widgets[$id]['callback'];
		do_action( 'dynamic_sidebar', $wp_registered_widgets[$id] );

		if ( is_callable($callback) ) {
			call_user_func_array($callback, $params);
			$did_one = true;
		}
				echo '<span style="clear:both;"></span>';
		$widget_num++;
	} // do each widget
	break;	// get out of the for (;;)
	}

?>
	</div><div style="clear:both;"></div><!-- #sidebar_header -->
<?php
}
?>
