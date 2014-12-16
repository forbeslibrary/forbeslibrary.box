<?php
if ( !defined('ABSPATH')) exit; // Exit if accessed directly
/*
Rwwvr Pro Fonts

This code is Copyright 2011 by Bruce Wampler, all rights reserved.
This code is licensed under the terms of the accompanying license file: license.html.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.

*/
// ==============================================   BACKGROUND IMAGES ===========================================
function weaverii_adv_bgimages() {
	weaverii_hide_advanced('begin');
?>
	<div class="wvr-option-header">
	Background Images
	<?php weaverii_help_link('help.html#BackgroundImages','Help on Background Images');?></div><br />
	<br />

		<table class="optiontable">
<?php

	weaverii_bgimg_widerow('Full Screen Site BG Image','_wii_bg_fullsite_url','Full screen centered auto-sized BG image.  (&#9679;Pro)','250px');

	weaverii_bgimg_widerow('Wrapper BG Image','_wii_bg_wrapper_url','Background image for outer wrapper (#wrapper) (&#9679;Pro)');

	weaverii_repeat_row('_wii_bg_wrapper_rpt');

	weaverii_bgimg_widerow('Header BG Image','_wii_bg_header_url','Background image for header (#branding) (&#9679;Pro)');
	weaverii_repeat_row('_wii_bg_header_rpt');

	weaverii_bgimg_widerow('Main BG Image','_wii_bg_main_url','Background image for main area - wraps everything after header (#main) (&#9679;Pro)');
	weaverii_repeat_row('_wii_bg_main_rpt');

	weaverii_bgimg_widerow('Container BG Image','_wii_bg_container_url','Background image for Container - (#container_wrap) (&#9679;Pro)');
	weaverii_repeat_row('_wii_bg_container_rpt');

	weaverii_bgimg_widerow('Content BG Image','_wii_bg_content_url','Background image for Content - wraps page/post area (#content) (&#9679;Pro)');
	weaverii_repeat_row('_wii_bg_content_rpt');

	weaverii_bgimg_widerow('Page content BG Image','_wii_bg_page_url','Background image for Page content area (#container .page) (&#9679;Pro)');
	weaverii_repeat_row('_wii_bg_page_rpt');

	weaverii_bgimg_widerow('Post BG Image','_wii_bg_post_url','Background image for Post content area (#container .post) (&#9679;Pro)');
	weaverii_repeat_row('_wii_bg_post_rpt');

	weaverii_bgimg_widerow('Left Sidebar Areas BG Image','_wii_bg_widgets_left_url','Background image for widget areas on left (#sidber_wrap_left) (&#9679;Pro)');
	weaverii_repeat_row('_wii_bg_widgets_left_rpt');

	weaverii_bgimg_widerow('Right Sidebar Areas BG Image','_wii_bg_widgets_right_url','Background image for widget areas on right (#sidber_wrap_right) (&#9679;Pro)');
	weaverii_repeat_row('_wii_bg_widgets_right_rpt');

	weaverii_bgimg_widerow('Footer BG Image','_wii_bg_footer_url','Background image for Footer area (#colophon) (&#9679;Pro)');
	weaverii_repeat_row('_wii_bg_footer_rpt');
?>
	</table>
<?php
	weaverii_hide_advanced('end');
}

// ========================================== manual rows ==========================================
function weaverii_bgimg_widerow($th,$rid,$desc,$width='') {
	$style = '';
	$style_desc = 'style="padding-left: 10px"';
	if (!weaverii_init_base()) {
        $style = ' style="color:#999;"';
        $style_desc = $style;
	} else if ($width != '') {
		$style = ' style="width:' . $width . ';"';
	}

?>
	<tr>
	<th scope="row" align="right"<?php echo $style . '>' . $th; ?>:&nbsp;</th>
	<td>
<?php	if (weaverii_init_base()) { ?>
		<input name="<?php weaverii_sapi_main_name($rid); ?>" type="text" style="width:240px;height:22px;" class="regular-text"
		name="<?php echo $rid; ?>" id="<?php echo $rid; ?>" value="<?php esc_textarea(weaverii_getopt($rid)); ?>" />
<?php 		weaverii_media_lib_button($rid); ?>
<?php	} else { ?>
		<span style="color:#999;">Pro Version&nbsp;&nbsp;&nbsp;</span>
		<input name="<?php weaverii_sapi_main_name($rid); ?>" type="hidden" style="width:240px;height:22px;" class="regular-text"
		name="<?php echo $rid; ?>" id="<?php echo $rid; ?>" value="<?php esc_textarea(weaverii_getopt($rid)); ?>" />

	</td>
<?php	} ?>
	<td <?php echo $style_desc;?>><small><?php echo $desc; ?></small></td>
	</tr>
<?php

}

function weaverii_repeat_row($rid) {
	if (!weaverii_init_base())
		echo '<tr style="display:none;">';
	else
        echo "	<tr>\n";
?>
	<th scope="row" align="right">&nbsp;</th>
	<td colspan="2" style="font-size:80%;">
		<input type="radio" name="<?php weaverii_sapi_main_name($rid); ?>"
				value="repeat" <?php echo(weaverii_getopt($rid) == 'repeat' ? 'checked' : ''); ?> /> repeat &nbsp;
		<input type="radio" name="<?php weaverii_sapi_main_name($rid); ?>"
				value="repeat-x" <?php echo(weaverii_getopt($rid) == 'repeat-x' ? 'checked' : ''); ?> /> repeat-x &nbsp;
		<input type="radio" name="<?php weaverii_sapi_main_name($rid); ?>"
				value="repeat-y" <?php echo(weaverii_getopt($rid) == 'repeat-y' ? 'checked' : ''); ?> /> repeat-y &nbsp;
		<input type="radio" name="<?php weaverii_sapi_main_name($rid); ?>"
				value="no-repeat" <?php echo(weaverii_getopt($rid) == 'no-repeat' ? 'checked' : ''); ?> /> no-repeat
	</td>
	</tr>
<?php
}


?>
