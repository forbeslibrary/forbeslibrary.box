<?php
if ( !defined('ABSPATH')) exit; // Exit if accessed directly
/**
 * The template for displaying search forms in Weaver II
 *
 * @package WordPress
 * @subpackage Weaver II
 * @since Weaver II 1.0
 */
weaverii_trace_template(__FILE__);

	$placeholder = weaverii_getopt('wii_search_msg');
	if ($placeholder == '')
		$placeholder = __('Search Site','weaver-ii');

	$use_img = 'images/search_button.gif';
	if (weaverii_getopt('wii_go_button'))
		$use_img = 'images/go_button.gif';

	$imgurl = weaverii_relative_url($use_img);

	$use_img = weaverii_getopt('_wii_search_button_url');
	if (strlen($use_img) > 0) {
		$imgurl = $use_img;
	}
	$f =  '<form role="search" style="background:transparent;" method="get" class="searchform" action="' . home_url( '/' ) . '" >
	<label class="screen-reader-text" for="s">' . __('Search for:','weaver-ii') . '</label>
	<input type="search" value="' . get_search_query() . '" name="s" id="s" placeholder="'. $placeholder .'" />
	<input class="searchformimg" type="image" src="' . apply_filters('weaverii_css',$imgurl) . '" alt="Search" />
	</form>';

	$ff = apply_filters('get_search_form',$f);
	if ($echo ) {
        echo $ff;
        return $ff;
	}
	else {
        return $ff;
	}
	return $ff;
?>
