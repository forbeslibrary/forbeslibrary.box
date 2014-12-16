<?php
if ( !defined('ABSPATH')) exit; // Exit if accessed directly
/*
	Weaver II Admin - Uses yetii JavaScript to build tabs.
	Tabs include:
		Weaver Themes           (in wvr-subthemes.php)
		Main Options            (in this file)
		Advanced Options        (in wvr_advancedopts.php)
		Save/Restore Themes     (in wvr-subthemes.php)
		Snippets                (in wvr-help.php)
		CSS Help                ditto
		Help                    ditto
/*
	========================= Weaver Admin Tab - Main Options ==============
*/
function weaverii_do_admin() {
/* theme admin page */
/* < ?php if (weaverii_init_base()) echo " &mdash; <small style='color:red;'>Beta version expires 09/30/2013</small>"; ? > */

/* This generates the startup script calls, etc, for the admin page */
	global $weaverii_opts_cache, $weaverii_main_options, $weaverii_main_opts_list;

	if (!current_user_can('edit_theme_options')) wp_die("No permission to access that page.");

	weaverii_admin_page_process_options();      // Process non-sapi options

	if (weaverii_getopt('wii_subtheme') == 'none')
		weaverii_activate_subtheme('antique-ivory');            // first time run, so we gotta load the theme

	echo('<div class="wrap">');
	screen_icon("themes");      /* add a nice icon to the admin page */
?>
<div style="float:left;"><h2><?php echo(WEAVERII_THEMEVERSION); ?> Options
<?php if (is_child_theme()) echo " &mdash; " . wp_get_theme(); ?>
</h2>
	<a name="top_main" id="top_main"></a></div>
<?php weaverii_donate_button();
	weaverii_check_theme();
	weaverii_clear_messages();
?>

<div style="clear:both;">

<?php
	weaverii_check_for_old_weaver();
	weaverii_check_version();           // check version RSS
?>

<div id="tabwrap">
  <div id="tab-admin" class='yetii'>
	<ul id="tab-admin-nav" class='yetii'>
	  <li><a href="#tab_themes" title="Select from pre-defined subthemes"><?php echo(weaverii_t_('Weaver II Subthemes' /*a*/ )); ?></a></li>
	  <li><a href="#tab_main" title="Main options for most theme elements: site appearance, layout, header, menus, content, footer, fonts, more."><?php echo(weaverii_t_('Main Options' /*a*/ )); ?></a></li>
	  <li><a href="#tab_mobileopts" title="Options for Mobile View display."><?php echo(weaverii_t_('Mobile' /*a*/ )); ?></a></li>
	  <li><a href="#tab_advanced" title="Advanced options: HTML, code, CSS insertion; page templates, background images, SEO, site options."><?php echo(weaverii_t_('Advanced Options' /*a*/ )); ?></a></li>
	  <li><a href="#tab_admin" title="Basic Administrative Options."><?php echo(weaverii_t_('Admin Options' /*a*/ )); ?></a></li>
	  <li><a href="#tab_pro" title="Settings for Weaver II Pro edition: tools, activate plugins and features."><?php echo(weaverii_t_('Weaver II Pro' /*a*/ )); ?></a></li>
	  <li><a href="#tab_shortcodes" title="Weaver and Weaver Pro Shortcodes."><?php echo(weaverii_t_('Shortcodes/Plugins' /*a*/ )); ?></a></li>
	  <li><a href="#tab_saverestore" title="Save and Restore theme settings."><?php echo(weaverii_t_('Save/Restore' /*a*/ )); ?></a></li>
	  <li><a href="#tab_help" title="Table of Content links to Weaver Help files"><?php echo(weaverii_t_('Help' /*a*/ )); ?></a></li>
	</ul>

<?php //  list is order specific - above and below must match ?>

	  <div id="tab_themes" class="tab" >
<?php   weaverii_admin_subthemes(); ?>
	  </div>
<?php
	  // ====================== Begin the big form here =====================
	weaverii_sapi_form_top('weaverii_settings_group','weaverii_options_form');
?>
	  <div id="tab_main" class="tab" >
<?php weaverii_admin_mainopts(); ?>
	  </div>

	  <div id="tab_mobileopts" class="tab" >
<?php weaverii_admin_mobileopts(); ?>
	  </div>

	  <div id="tab_advanced" class="tab" >
<?php weaverii_admin_advancedopts(); ?>
	  </div>

	  <div id="tab_admin" class="tab" >
<?php weaverii_admin_admin(); ?>
	  </div>

	  <div id="tab_pro" class="tab" >
<?php weaverii_admin_pro(); ?>
	  </div>

<?php
	weaverii_sapi_form_bottom();                // end of SAPI opts here. Can't cross <div>s! Non-sapi forms follow
	// ===================== end of big form  =====================
?>
	<div id="tab_shortcodes" class="tab" >
<?php
if (weaverii_init_base()) {
?>
<h2 style="color:blue;">Weaver II Theme Shortcodes</h2>
<br /><p><a href="<?php echo site_url('/wp-admin/themes.php?page=WeaverII_Shortcodes'); ?>">
<span style="color:white;background:#57A;padding:4px;font-weight:bold;">Open Shortcodes Admin</span></a></p>
<br /><p>Settings and information about Weaver II  and Weaver II Pro Shortcodes are found on the
<a href="<?php echo site_url('/wp-admin/themes.php?page=WeaverII_Shortcodes'); ?>"><em>Appearance&rarr;Shortcodes + Pro</em></a>
menu found at the left.
</p>
<?php
} else if (function_exists('weaverii_extras_shortcodes_installed')) {   // WEAVER II THEME EXTRAS

	do_action('weaverii_extras_info');

} else {                                                                // NEED TO INSTALL EXTRAS
?>
<h2 style="color:blue;">Weaver II Theme Extras and Shortcodes</h2>

<h3 style="color:red;">FOR COMPLETE WEAVER II THEME FUNCTIONALITY, PLEASE INSTALL AND ACTIVATE THE <em>WEAVER II THEME EXTRAS</em> PLUGIN.</h3>

<hr />
<p style="font-weight:bold;">The <em>Weaver II Theme Extras</em> plugin provides extra theme functionality, including the capability to upload premium add-on subthemes, and the following shortcodes:</p>
<ul>
	<li><span style="color:red;font-weight:bold;">Show Posts - [weaver_show_posts]</span> - This shortcode allows you to display posts on any page or text
	area, and provides extensive fitering options. A perfect companion for the Page with Posts template.
	This shortcode is an essential part of building sites with Weaver II.</li>
	<li>Breadcrumbs - [weaver_breadcrumbs]</li>
	<li>Header Image - [weaver_header_image]</li>
	<li>HTML - [weaver_html]</li>
	<li>DIV - [div]text[/div]</li>
	<li>SPAN - [span]text[/span]</li>
	<li>iFrame - [weaver_iframe]</li>
	<li>Blog Page Navigation - [weaver_pagenav] </li>
	<li>Show If Mobile - [weaver_show_if_mobile] </li>
	<li>Hide If Mobile - [weaver_hide_if_mobile]</li>
	<li>Show If Logged In - [weaver_show_if_logged_in] </li>
	<li>Hide If Logged In - [weaver_hide_if_logged_in]</li>
	<li>Site Title - [weaver_site_title]</li>
	<li>Site Tagline - [weaver_site_desc]</li>
	<li>Vimeo - [weaver_vimeo] </li>
	<li>YouTube - [weaver_youtube] </li>
</ul>

<hr />
<h2 style="color:blue;">Weaver II Pro Shortcodes</h2>
<strong>The Weaver II Pro Version offers the following shortcodes and features as well:</strong>
<br />
<ul>
	<li>Header Gadgets - Images/Text over Header</li>
	<li>Link Buttons - shortcode & widget</li>
	<li>Social Buttons - shortcode & widget</li>
	<li>Weaver Slider Menu Shortcode</li>
	<li>Extra Menus Shortcode</li>
	<li>Widget Area Shortcode</li>
	<li>Search Form Shortcode</li>
	<li>Show Feed Shortcode</li>
	<li>Popup Link Shortcode</li>
	<li>Show/Hide Shortcode</li>
	<li>Comment Policy</li>
	<li>Shortcoder</li>
	<li>Include PHP Shortcode</li>
	<li>Total CSS</li>

</ul>
<?php
}
?>
<hr/>
<h2 style="color:blue;">Recommended WordPress Plugins</h2>
<p>The following plugins are recommended to use with Weaver II. While most WordPress plugins work with Weaver, these
provide features commonly needed by Weaver users.</p>
</p>
<ul>
	<li><strong>Slide Shows and image Galleries</strong><br />
	We have developed our own Show Sliders and [gallery] slider plugin:<br />
	<ul><li><a href="http://aspenthemeworks.com/atw-show-sliders/" target="_blank">Aspen Themeworks Show Sliders</a>
	- good for header slideshows</li>
	</ul>
	</li>
	<li><strong>SEO Optimization</strong><br />
		<ul>
			<li><a href="http://wordpress.org/extend/plugins/wordpress-seo/" target="_blank">WordPress SEO by Yoast</a> -
			probably the best. Weaver II automatically supports Yoast's breadcrumbs if they are enabled.</li>
		</ul>
	</li>
	<li><strong>Server Side Caching</strong><br />
		Caching can help with site performance for busy sites on shared servers. We strongly recommend <em>Quick Cache</em>
        which is fully compatible with Weaver II. <em>These are the only 2 compatible caching plugins.</em>
		<ul>
			<li><a href="http://wordpress.org/extend/plugins/quick-cache/" target="_blank">Quick Cache</a> - Complete automatic compatibility <em>when Weaver II Theme Extras installed</em>.</li>
			<li><a href="http://wordpress.org/extend/plugins/w3-total-cache/" target="_blank">W3 Total Cache</a> - Requires custom configuration. We recommend Quick Cache over W3TC. See Help file.</li>
		</ul>
	</li><li><strong>Contact Form</strong><br />
		<ul>
			<li><a href="http://wordpress.org/extend/plugins/si-contact-form/" target="_blank">Fast Secure Contact Form</a>
			- does it all, easy to configure and style</li>
		</ul>
	</li><li><strong>Others</strong><br />
		These plugins are known to work well with Weaver II.
		<ul>

			<li><a href="http://wordpress.org/extend/plugins/ultimate-tinymce/" target="_blank">Ultimate TinyMCE</a> - extend the page/post editor</li>
					<li><a href="http://wordpress.org/extend/plugins/dynamic-widgets/" target="_blank">Dynamic Widgets</a> - an additional way to control when widgets are displayed, automatic compatibility</li>

			<li><a href="http://wordpress.org/extend/plugins/wp-pagenavi/" target="_blank">WP-PageNavi</a> - if installed, will be used instead of Weaver II's Page Navigation</li>
			<li><a href="http://wordpress.org/extend/plugins/wp-paginate/" target="_blank">WP-Paginate</a> - if installed, will be used instead of Weaver II's Page Navigation</li>
		</ul>
	</li>
</ul>
	</div>
	<div id="tab_saverestore" class="tab" >
<?php   weaverii_admin_saverestore(); ?>
	</div>
	<div id="tab_help" class="tab" >
<?php weaverii_admin_help(); ?>
	</div>
   </div> <!-- #tab-saverestore -->
</div> <!-- #tabwrap -->

<?php   weaverii_end_of_section('Options'); ?>

<script type="text/javascript">
		var tabberAdmin = new Yetii({
		id: 'tab-admin',
		tabclass: 'tab',
		persist: true
		});
</script>

<?php
}       /* end weaverii_do_admin */

/*
	================= process settings when enter admin pages ================
*/
function weaverii_admin_page_process_options() {
	/* Process all options - called upon entry to options forms */

	// Most options are handled by the SAPI filter.

	settings_errors('weaverii_settings');                       // display results from SAPI save settings

	global $weaverii_opts_cache;

	weaverii_process_options_themes();  // >>>> Weaver II Themes Tab

	do_action('weaverii_child_process_options');        // let the child theme do something

	weaverii_process_options_admin_standard();  // setting from admin page

	/* this tab has the most individual forms and submit commands */

	weaverii_process_options_admin_pro();

	/* ====================================================== */

	 weaverii_save_opts('Weaver II Admin');                     /* FINALLY - SAVE ALL OPTIONS AND UPDATE CURRENT CSS FILE */
}

function weaverii_admin_admin() {
?>
<h3>Basic Administrative Options <?php weaverii_help_link('help.html#AdminOptions','Help for Admin Options'); ?></h3>
<?php
	weaverii_sapi_submit('', '<br /><br />');
?>
	These options control some administrative options and appearance features.

<br /><br />

	<label><input type="checkbox" name="<?php weaverii_sapi_main_name('_wii_hide_donate'); ?>" id="wii_hide_donate" <?php checked(weaverii_getopt_checked( '_wii_hide_donate' )); ?> />
		I've Donated - </label><small>Thank you for donating to the Weaver II theme.
This will hide the Donate button. Purchasing Weaver II Pro also hides the Donate button.</small> &diams;<br />

<label><input type="checkbox" name="<?php weaverii_sapi_main_name('_wii_hide_subtheme_link'); ?>" id="wii_hide_subtheme_link" <?php checked(weaverii_getopt_checked( '_wii_hide_subtheme_link' )); ?> />
		Hide Subthemes Banner - </label><small>This will hide the Premium Subthemes Banner.</small> &diams;<br />
<br />

<?php
	weaverii_hide_advanced('begin');
?>
	<label><input type="checkbox" name="<?php weaverii_sapi_main_name('_wii_hide_editor_style'); ?>" id="_wii_hide_editor_style" <?php checked(weaverii_getopt_checked( '_wii_hide_editor_style' )); ?> />
		Disable Page/Post Editor Styling - </label><small>Checking this box will disable the Weaver subtheme based styling in the Page/Post editor.
		If you have a theme using transparent backgrounds, this option will likely improve the Post/Page editor visibility.</small> &diams;<br />

		<label><input type="checkbox" name="<?php weaverii_sapi_main_name('_wii_disable_shortcodes'); ?>" id="_wii_disable_shortcodes" <?php checked(weaverii_getopt_checked( '_wii_disable_shortcodes' )); ?> />
		Disable <em>all</em> theme shortcode support</label> - <small>Disables all shortcodes provide by the theme ([weaver_show_posts], etc.).
		Useful to check how your site would look without Weaver II options.</small> &diams;<br />

	<label><input type="checkbox" name="<?php weaverii_sapi_main_name('_wii_hide_updatemsg'); ?>" id="wii_hide_updatemsg" <?php checked(weaverii_getopt_checked( '_wii_hide_updatemsg' )); ?> />
		Hide Update Messages - </label><small>Checking this box will hide the Weaver version update announcements on the Weaver Admin page.</small> &diams;<br />



	<label><input type="checkbox" name="<?php weaverii_sapi_main_name('_wii_hide_auto_css_rules'); ?>" id="wii_hide_auto_css_rules" <?php checked(weaverii_getopt_checked( '_wii_hide_auto_css_rules' )); ?> />
		Don't auto-display CSS rules - </label><small>Checking this box will disable the auto-display of Main Option elements that have CSS settings.</small> &diams;<br />

	<label><input name="<?php weaverii_sapi_main_name('_wii_css_rows'); ?>" id="wii_css_rows" type="text" style="width:30px;height:20px;" class="regular-text" value="<?php weaverii_esc_textarea(weaverii_getopt('_wii_css_rows')); ?>" />
	lines - Set CSS+ text box height - </label><small>You can increase the default height of the CSS+ input area to a value between 1 and 25 lines.</small> &diams;
<br />
<br />
<strong>Compatibility Settings</strong> - settings that may cause compatibility issues with other plugins
<br />
<br /> <small><span style="color:red;"><b>NOTE:</b></span> Weaver II includes support for Rounded Corners and
Shadows for Internet Explorer 7/8 via an add-on script called PIE. The script has been <strong>enabled</strong> by default.
Note while PIE supports most rounded areas, it doesn't support the menu bars.
If you have difficulties or don't like the way your site renders in IE 7/8, you can disable the support.</small>
<br />
<label><input type="checkbox" name="<?php weaverii_sapi_main_name('_wii_hide_PIE'); ?>" id="wii_hide_PIE" <?php checked(weaverii_getopt_checked( '_wii_hide_PIE' )); ?> />
	Disable IE rounded corners support - </label><small>If you are having issues with IE and rounded corners, please disable this option.</small> &diams;<br />
 <br />
 <input type="checkbox" name="<?php weaverii_sapi_main_name('_wii_no_final_div'); ?>" id="wii_no_final_div" <?php checked(weaverii_getopt_checked( '_wii_no_final_div' )); ?> />
		Don't add #weaver-final at end - </label><small>Checking this box will prevent Weaver II from wrapping the
		very end of site pages with the #weaver-final div. This may prevent some conflicts with some plugins.</small> &diams;<br />

 <h3 class="wvr-option-subheader">Per Page and Per Post Option Panels by Roles</h3>
 <p>Single site Administrator and Multi-Site Super Administrator will always have the Per Page and Per Post options panel displayed.
 You may selectively disable these options for other User Roles using the check boxes below. (&#9679;Pro)</p>

 <?php
	if (!weaverii_init_base()) {
		echo '<p>&nbsp;&nbsp;<em>Weaver II Pro Option</em></p>';
	} else {
 ?>

	<label><input type="checkbox" name="<?php weaverii_sapi_main_name('_wii_hide_mu_admin_per'); ?>" id="_wii_hide_mu_admin_per" <?php checked(weaverii_getopt_checked( '_wii_hide_mu_admin_per' )); ?> />
		Hide Per Page/Post Options for MultiSite Admins</label> &diams;<br />
		   <label><input type="checkbox" name="<?php weaverii_sapi_main_name('_wii_hide_editor_per'); ?>" id="_wii_hide_editor_per" <?php checked(weaverii_getopt_checked( '_wii_hide_editor_per' )); ?> />
		Hide Per Page/Post Options for Editors</label> &diams;<br />
		   <label><input type="checkbox" name="<?php weaverii_sapi_main_name('_wii_hide_author_per'); ?>" id="_wii_hide_author_per" <?php checked(weaverii_getopt_checked( '_wii_hide_author_per' )); ?> />
		Hide Per Page/Post Options for Authors and Contributors</label> &diams;<br />

<?php
	}
?>
<br />
 <h3 class="wvr-option-subheader">Subtheme Notes</h3>
 <p>This box may be used to keep notes and instructions about settings made for a custom subtheme. It
 will be saved in the both .w2t and .w2b settings files.</p>
 <textarea name="<?php weaverii_sapi_main_name('wii_subtheme_notes'); ?>" rows=8 style="width: 95%"><?php weaverii_esc_textarea(weaverii_getopt('wii_subtheme_notes')); ?></textarea>
<?php

	weaverii_hide_advanced();
}
/* ^^^^^ end weaverii_admin_page_process_options ^^^^^^ */

// ===================================== include other stuff ==========================

require_once( dirname( __FILE__ ) . '/lib-admin.php' );
require_once( dirname( __FILE__ ) . '/pro/admin-process-pro.php' );
require_once( dirname( __FILE__ ) . '/pro/lib-admin-pro.php' );

require_once( dirname( __FILE__ ) . '/admin-subthemes.php' );
require_once( dirname( __FILE__ ) . '/admin-mainopts.php' );
require_once( dirname( __FILE__ ) . '/admin-advancedopts.php' );
require_once( dirname( __FILE__ ) . '/admin-pro.php' );
require_once( dirname( __FILE__ ) . '/admin-shortcodes.php' );
require_once( dirname( __FILE__ ) . '/admin-saverestore.php' );
require_once( dirname( __FILE__ ) . '/admin-help.php' );
?>
