<?php
if ( !defined('ABSPATH')) exit; // Exit if accessed directly
/* Weaver II - admin Save/Restore
 *
 * This will come after the Options form has been closed, and is used for non-SAPI options
 *
 */

function weaverii_admin_saverestore() {
	?>

<div class="wvr-option-header" style="clear:both;">Save/Restore Theme Settings <?php weaverii_help_link('help.html#SaveRestore','Help on Save/Restore Themes');?></div><br />
<div class="wvr-option-subheader">Save/Restore Current Settings using WordPress Database</div>
<p>This option allows you to save and restore all current theme settings using your host's WordPress
database. Your options will be
preserved across Weaver II theme upgrades, as well when you change to different themes. There is only one
saved backup available. Weaver II Pro allows multiple saves using files.</p>
<p>Note: This save option saves <strong>all</strong> settings, including those marked with a &diams;. Other save options
(available with Weaver II Pro or the <em>Weaver II Theme Extras</em> plugin) will save all settings (backup save), or just
those settings that are theme related (settings <em>not</em> marked with  &diams;).</p>
<form name="wii_save_mysave_form" method="post">
		<span class="submit"><input type="submit" name="save_mytheme" value="Save Settings"/></span>
		<strong>Save all current settings in host WordPress database.</strong>
<?php    weaverii_nonce_field('save_mytheme'); ?>
		<br /><br />
		<span class="submit"><input type="submit" name="restore_mytheme" value="Restore Settings"/></span>
		<strong>Restore from saved settings.</strong>
<?php   weaverii_nonce_field('restore_mytheme'); ?>
	</form>

<?php
	do_action('weaverii_child_saverestore');    // allow additional save/restore in child */

	weaverii_saverestore();

	if (weaverii_init_base()) {
		weaverii_pro_saverestore();
	}

	do_action('weaverii_child_update');

?>
	<div class="wvr-option-subheader">Reset Current Settings to Default</div><br />
		<form name="resetweaverii_form" method="post" onSubmit="return confirm('Are you sure you want to reset all Weaver II settings?');">
			<strong>Click the Clear button to reset all Weaver II settings to the default values.</strong><br >
<?php       if (weaverii_init_base()) {
?>
			This will also include Weaver II Pro settings.<br />
<?php       } ?>
			<em>Warning: You will lose all current settings.</em> You should use the Save/Restore tab to save a copy
			of your current settings before clearing! <br />
			<span class="submit"><input type="submit" name="reset_weaverii" value="Clear All Weaver II Settings"/></span>
			<?php weaverii_nonce_field('reset_weaverii'); ?>
		</form> <!-- wii_resetweaverii_form -->
		<br /><hr />
<?php
	$last = weaverii_getopt('wii_last_option');
	if ($last != 'WeaverII') // check for case of limited PHP $_POST values
	{
?>
<p style="color:red">Possible Non-Standard Web Host Configuration detected. If your options
are not saving correctly, your host may have limited the default number of values that PHP can use for
settings. Try saving your settings again, and if this message persists, please contact your host and ask them to "Increase the PHP <em>max_input_vars</em> value for $_POST to at least 600." If that does not fix the issue,
please contact Weaver II support. (diagnostic info: last_option="<?php echo $last;?>").
</p>
<?php
	} else {
		echo "<p><small>$last</small></p>";
	}
}

function weaverii_process_options_admin_standard() {

	if (weaverii_submitted('reset_weaverii')) {
		if (! current_user_can('edit_theme_options'))
			return;
		// delete everything!
		weaverii_save_msg(weaverii_t_('All Weaver II settings have been reset to the defaults.','weaver-ii'));
		delete_option( apply_filters('weaver_options','weaverii_settings') );
		global $weaverii_opts_cache;
		$weaverii_opts_cache = false;   // clear the cache
		weaveriip_clear_opts();
		weaverii_init_opts('reset_weaverii');
		update_user_meta( get_current_user_id(), 'tgmpa_dismissed_notice', 0 );     // reset the dismiss on the plugin loader
	}

	if (weaverii_submitted('uploadtheme') &&  isset($_POST['uploadit']) && $_POST['uploadit'] == 'yes') {
		weaverii_uploadit();
	}


	if (weaverii_submitted('check_weaver')) {
		// perform weaver check
		require_once('check-theme.php');        // include check code now
		weaverii_perform_check();
	}

	if (weaverii_submitted('weaver_hideopts')) {
		weaverii_save_msg(weaverii_t_('Now showing more/fewer options.','weaver-ii'));
	}


}
?>
