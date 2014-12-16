<?php
if ( !defined('ABSPATH')) exit; // Exit if accessed directly
/* Weaver II - admin Subtheme
 *
 * This is the intro form. It won't have any options because it will be outside the main form
 */

function weaverii_admin_subthemes() {

?>

<h3>Predefined Weaver II Subthemes
<?php weaverii_help_link('help.html#PredefinedThemes','Help for Weaver II Predefined Themes');?>
<small style="font-weight:normal;font-size:10px;">&nbsp;&larr; You can click the ?'s found throughout Weaver II admin pages for context specific help.</small></h3>
<b>Welcome to Weaver II</b>

<p>Weaver II gives you extreme control of your WordPress blog appearance using the
different admin tabs here. This tab lets you get a quick start by picking one of the many
predefined subthemes. Once you've picked a starter theme, use the <em>Main Options</em> and <em>Advanced Options</em>
tabs to tweak the theme to be whatever you like. After you have a theme you're happy with,
you can save it from the Save/Restore tab. The <em>Help</em> tab has much more <b>useful</b> information.</p>

<p>We realize Weaver II has a <strong>lot</strong> of options. To help make it easier to get started,
you can click the "Hide Advanced Options" button found on the right side of the screen wherever a
"Save Options" button is found, and a simplified set of options will be displayed. Just click the "Show All Options" button
to once again show all options.</p>


<h3 class="wvr-option-subheader" style="color:red;font-style:italic">Visit our
<?php weaverii_site('/subthemes/'); ?>website</a> for even more great looking subthemes!</h3>
<table><tr><td><img src="<?php echo weaverii_relative_url('/images/'); ?>addon_themes.png" alt="addons" /></td>
<td><p style="margin-left:10px;">All the subthemes included here provide a great starting point, but we're trying hard to make even more great looking subthemes available for you to try. Click to check out our
<?php weaverii_site('/subthemes/'); ?><strong>Subthemes</strong></a> page now on the main Weaver II website.
</p></td></tr></table>

<?php
	if (!has_action('weaverii_child_show_extrathemes')) {
		echo ('<p>We suggest that you download the Weaver II Theme Extras Plugin for easy access to new subthemes.</p>');
	}
	do_action('weaverii_child_show_extrathemes');
?>

<h3 class="wvr-option-subheader">Get started by trying one of the predefined subthemes!</h3>
<?php
	$theme_dir = trailingslashit(WP_CONTENT_DIR) . 'themes/' . get_template() . '/subthemes/';
	$theme_list = array();
	if($media_dir = opendir($theme_dir)){           // build the list of themes from directory
		while ($m_file = readdir($media_dir)) {
			$len = strlen($m_file);
			$base = substr($m_file,0,$len-4);
			$ext = $len > 4 ? substr($m_file,$len-4,4) : '';
			if($ext == '.w2t' ) {
				$theme_list[] = $base;
			}
		}
	}

	if (!empty($theme_list)) {
		weaverii_st_pick_theme($theme_list);    // show the theme picker
	} else {
		echo "<h3>WARNING: Your version of Weaver II is likely installed incorrectly. Unable to find subtheme defiitions.</h3>\n";
	}
}

function weaverii_st_pick_theme($list_in) {
	// output the form to select a file list from weaverii-subthemes directory
	$list = $list_in;
	natcasesort($list);
	$cur_theme = weaverii_getopt('wii_theme_filename');
	if (!$cur_theme) $cur_theme = 'antique-ivory';      // the default theme
?>
<form enctype="multipart/form-data" name='pick_theme' method='post'>
	&nbsp;&nbsp;<strong>Click a Radio Button below to select a subtheme: &nbsp;</strong>
	<span style="padding-left:100px;">Current theme: <strong>
<?php
	$cur_addon = weaverii_getopt('wii_addon_name');
	if ($cur_addon == '') {
		echo ucwords(str_replace('-',' ',$cur_theme));
	} else {
		echo 'Add-on Subheme: ' . ucwords(str_replace('-',' ',$cur_addon));
		$cur_theme = '';
	}
?>
	</strong></span>

	<br /><br /><span class='submit'><input name="set_subtheme" type="submit" value="Set to Selected Subtheme" /></span>&nbsp;
	<small style="color:#b00;"><strong>Note:</strong> Selecting a new subtheme will change only theme related settings. Most Advanced Options will be retained.
	You can use the Save/Restore tab to save a copy of all your current settings first.</small><br /><br />
<?php
		weaverii_nonce_field('set_subtheme');

	$thumbs = weaverii_relative_url('/subthemes/');

	foreach ($list as $addon) {
		$name = ucwords(str_replace('-',' ',$addon));
?>
		<div style="float:left; width:200px;">
			<label><input type="radio" name="wii_theme_picked"
<?php       echo 'value="' . $addon . '" ' . ($cur_theme == $addon ? 'checked' : '') .
				'/> <strong>' . $name . '</strong><br />';
			if (!weaverii_getopt('_wii_hide_theme_thumbs')) {
				echo '<img style="border: 1px solid gray; margin: 5px 0px 10px 0px;" src="' . $thumbs . $addon . '.jpg" width="150px" height="113px" alt="thumb" /></label></div>' . "\n";
			} else {
				echo "</label></div>\n";
			}
	}

	if (! weaverii_getopt_checked('_wii_hide_theme_thumbs')) {
?>
	<div style="clear:both;"></div>
	<span class='submit' style='padding-top:6px;'><input name="set_subtheme" type="submit" value="Set to Selected Subtheme" /></span>
<?php
	}
?>

	</form>
	<div style="clear:both;padding-top:6px;"></div>

	<form enctype="multipart/form-data" name='hide_thumbs_form' method='post'>
<?php
	$hide_msg =  (weaverii_getopt('_wii_hide_theme_thumbs')) ? 'Show Subtheme Thumbnails' : 'Hide Subtheme Thumbnails';
?>
	<input name="hide_thumbs" type="submit" value="<?php echo $hide_msg; ?>" />
<?php   weaverii_nonce_field('hide_thumbs'); ?>
	</form>
	<div style="clear:both;"></div>
<?php
}

function weaverii_process_options_themes() {

	if (weaverii_submitted('set_subtheme')) {   // invoked from Weaver II Subhemes tab (this file)
		if (isset($_POST['wii_theme_picked'])) {
			$theme = weaverii_filter_textarea($_POST['wii_theme_picked']);

			if (weaverii_activate_subtheme($theme))
				weaverii_save_msg(weaverii_t_("Subtheme Selected: " /*a*/ ) . $theme );
			else
				weaverii_save_msg(weaverii_t_("Invalid Subtheme file detected. Your installation of Weaver II may be broken." /*a*/ ));
		} else {
			weaverii_save_msg(weaverii_t_("Please select a subtheme." /*a*/ ));
		}
	}

	if (weaverii_submitted('save_mytheme')) {   // invoked from Save/Restore tab
		weaverii_save_msg(weaverii_t_("Current settings saved in WordPress database." /*a*/ ));
        weaverii_settings_db_backup();
        return;
	}

	if (weaverii_submitted('restore_mytheme')) {        // invoked from Save/Restore tab
		weaverii_settings_db_restore();
        weaverii_save_msg(weaverii_t_("Current settings restored from WordPress database." /*a*/ ));
        return;
	}

	if (weaverii_submitted('hide_thumbs')) {
		$hide = weaverii_getopt('_wii_hide_theme_thumbs');
		weaverii_setopt('_wii_hide_theme_thumbs', !$hide);
	}

    if (weaverii_submitted('save_options')) {
        echo '@@@@@@ SAVE OPTIONS @@@@@';
    }

}

function weaverii_settings_db_backup($auto = '') {
    weaverii_setopt('wii_theme_filename','custom');
    global $weaverii_opts_cache;
    weaverii_setopt( 'wii_saved_settings_time', time());
    weaverii_setopt( 'wii_saved_settings', weaverii_getopt('wii_style_version'));

    if (!$weaverii_opts_cache)
        $weaverii_opts_cache = get_option( apply_filters('weaver_options','weaverii_settings') ,array());

    if (current_user_can( 'edit_theme_options' ))
        update_option(apply_filters('weaver_options','weaverii_settings_backup' . $auto),$weaverii_opts_cache);
    else
        return;
    weaveriip_save_opts_backup($auto);
}

function weaverii_settings_db_restore( $auto = '' ) {
    if ( ! current_user_can( 'edit_theme_options' ) )
        return;
    global $weaverii_opts_cache;
    $saved = get_option( apply_filters('weaver_options','weaverii_settings_backup' . $auto) ,array());
    if (!empty($saved)) {
        $weaverii_opts_cache = $saved;
        weaverii_wpupdate_option('weaverii_settings',$weaverii_opts_cache, 'restore_mytheme');
    }
    weaveriip_restore_opts_backup( $auto );
}

function weaverii_activate_subtheme($theme) {
	/* load settings for specified theme */
	global $weaverii_opts_cache;

	/* build the filename - theme files stored in /wp-content/themes/weaverii/subthemes/

	Important: the following code assumes that any of the pre-defined theme files won't have
	and end-of-line character in them, which should be true. A user could muck about with the
	files, and possibly break this assumption. This assumption is necessary because the WP
	theme rules allow file(), but not file_get_contents(). Other than that, the following code
	is really the same as the 'theme' section of weaverii_upload_theme() in the pro library
	*/

	$filename = get_template_directory() . '/subthemes/' . $theme . '.w2t';

	$contents = weaverii_f_get_contents($filename);     // use either real (pro) or file (standard) version of function

	if (empty($contents)) return false;

	if (substr($contents,0,10) != 'W2T-V01.00')
		return false;

	$restore = array();
	$restore = unserialize(substr($contents,10));

	if (!$restore) return false;
	$version = weaverii_getopt('wii_version_id');       // get something to force load

	// need to clear some settings
	// first, pickup the per-site settings that aren't theme related...
	$new_cache = array();
	foreach ($weaverii_opts_cache as $key => $val) {
		if ($key[0] == '_') {   // these are non-theme specific settings
			$new_cache[$key] = $weaverii_opts_cache[$key];      // clear
		}
	}
	$opts = $restore['weaverii_base'];  // fetch base opts
	weaverii_delete_all_options();

	foreach ($new_cache as $key => $val) {      // set the values we need to keep
		weaverii_setopt($key,$new_cache[$key],false);
	}
	foreach ($opts as $key => $val) {
		if ($key[0] == '_') continue;   // should be here
		weaverii_setopt($key, $val, false);     // overwrite with saved theme values
	}

    weaverii_setopt('wii_version_id', WEAVERII_VERSION, false);
	weaverii_setopt('wii_theme_filename',$theme, false );
    weaverii_setopt('wii_style_version',1, false);
	weaverii_setopt('wii_last_option','WeaverII');      // assume always ok if from file

	weaverii_save_opts('set subtheme'); // OK, now we've saved the options, update them in the DB
	return true;
}
?>
