<?php
if ( !defined('ABSPATH')) exit; // Exit if accessed directly
/*
 Check issues

 1. Header Widget - if any widgets are defined for the area, then check to be sure widths are set.
 2. Look for SEO plugins
 3. See if they've saved their options ever.
 4. Custom bullet defined, but not selected, or selected and not defined
 5. No defined widget areas
 6. See if they have defined SEO meta, FavIcon
 7. Warn about fixed width theme

*/
function weaverii_perform_check() {
?>
<div style="background:#FFFF88;border:3px solid green;font-size:larger;padding:0 10px 0 10px; width:80%;margin-top:15px;margin-bottom:10px;">
	<p style="font-weight:normal;"><strong>Checking Weaver II for possible problems.</strong> This will check for some potential problems, but it is
	not a comprehensive check. Most messages are informational warnings, but things that should be fixed are marked ERROR.</p>
	<ul style="list-style-type:disc;list-style-position:inside;">
<?php

	echo '<li>' . weaverii_check_version(true) . "</li>\n";     // version
	global $wp_version;

	// see about file system

	if (function_exists('get_filesystem_method')) {     // this is available to check
		$type = get_filesystem_method(array());         // lets see if we have direct or ftpx
		if ($type == 'ftpext') {                // supposed to be using ftp access
?>
	<li>Please note: your site server is configured so that WordPress requires "FTP File Access" to update themes,
	plugins, and other files. If your site host is a private server, VPS, or other system where your site is secure from other
	users, <em>this is not an issue</em>. If, on the other hand, your site is using shared hosting, then it might
	be vulnerable to attack from other users who share your server. We <strong>strongly</strong> advise that you contact
	your hosting company and see if your site can be configured more securely, and if not, change hosting companies.
	Most modern shared hosting companies can provide "suPHP", "fastCGI", or other tools that allow shared
	serving without compromising file security.
<?php
			if (weaverii_init_base()) {
?>
	<br /><br />
	For Weaver II Pro, the "FTP File Access" requirement may cause issues with creating css and saved-settings files.
	You may want to add FTP credentials to your wp-config.php file.
<?php
			}
?>
	</li>
<?php
		}
	}

   if (!weaverii_init_base() && !function_exists('weaverii_extras_shortcodes_installed')) {
		echo "<li><strong>WARNING:</strong> You do not have the <em>Weaver II Theme Extras</em> plugin
		installed. It provides important and useful shortcodes for Weaver II. Please open the
		<strong>Shortcodes/Plugins</strong> tab for more information.</li>";
   }

	// option combinations

	if (weaverii_getopt('wii_wrap_shadow') && !weaverii_getopt('wii_page_bgcolor')) { // MUST have wrapper page bg set
?>
	<li><span style="color:red;font-weight:bold">ERROR:</span> You have specified "Wrap site with shadow" but
have not provided a backgroud color for "Wrapper Page BG". This combination may not display correctly
on IE7 and IE8. Please provide a Wrapper Page BG color.</li>
<?php
	}

	// plugins

	weaverii_check_cache_plugins('<li>','</li>');               // Cache check
	weaverii_check_mobile_plugins('<li>','</li>');              // Check for mobile plugin themes

	$seo = '';

	if (function_exists('aioseop_get_version'))
		$seo = 'All in One SEO Pack';
	if (function_exists('su_wp_incompat_notice'))
		$seo = 'SEO Ultimate';
	if (class_exists('gregsHighPerformanceSEO'))
		$seo = 'Greg\'s High Performance SEO';
	if (class_exists('EcordiaContentOptimizer'))
		$seo = 'Scribe SEO';

	if ($seo) {
		echo '<li>You are using the SEO plugin <em>' . $seo . '</em>';
		'</em>. Be sure you have filled in the SEO plugin settings</li>';
	}
	if (function_exists('wpseo_get_value')) {
		echo '<li>NOTICE: You are using "WordPress SEO by Yoast". Weaver II automatically supports
this plugin. Be sure you have filled in the plugin settings.</li>';
		$seo = 'Yoast';
	}

	if (!$seo ) {
		echo '<li>None of the most popular SEO plugins have been activated. You might want to consider using "WordPress SEO by Yoast", for example.</li>';
	}

	// widgets

	if (is_active_sidebar('header-widget-area')) {              // have an active horizontal header area
		if (weaverii_getopt('_wii_hdr_widg_1_w_int') == '') {   // just check the first one
?>
	<li><span style="color:red;font-weight:bold">ERROR:</span> You have added widgets for the <em>Header Horizontal Widget Area</em>, but have not
	properly defined widths for the widgets in that area. (Main Options:Header:Header Widget Area Widgets:Widths) </li>
<?php
		}
	}

	if (!is_active_sidebar('primary-widget-area') && !is_active_sidebar('right-widget-area') && !is_active_sidebar('left-widget-area')) {
		echo '<li>You have not added any <em>widgets</em> to the <em>standard</em> sidebar widget areas. This check does not include any alternate
		replacement widget areas. (Dashboard:Widgets)</li>';
	}

	// misc

	$saved = get_option( apply_filters('weaver_options','weaverii_settings_backup') );
	if (empty($saved)) {
		echo '<li>You have not saved your settings using the <em>Save/Restore</em> tab. It is good practice to keep a saved version of your settings.</li>';
	}

	$icon = weaverii_getopt('_wii_favicon_url');
	if (!$icon) {
		echo '<li>You have not specified a <em>FavIcon</em>. It is a good idea to have a FavIcon for your site. (Advanced Options:Site Options)</li>';
	}

	// pro options

	if (weaverii_getopt_checked('_wii_inline_style')) {
		echo '<li>You have <em>Use Inline CSS</em> checked. (Weaver II Pro tab)</li>';
	}
	if (weaverii_getopt_checked('_wii_development_mode')) {
		echo '<li>You have <em>Development Mode</em> checked. It is recommended to disable it for production sites. (Weaver II Pro tab)</li>';
	}

	// MOBILE

	if (weaverii_getopt_checked('_wii_mobile_alt_theme')) {
		$temp = get_option( apply_filters('weaver_options','weaverii_settings_mobile') );
		if ($temp === false) {
			echo '<li><span style="color:red;font-weight:bold">ERROR:</span> You have checked <em>Use Alternate Mobile Theme</em>, but no Mobile Theme Settings have been saved. (Mobile tab) You <em>must</em> use the "Save Settings to Mobile Settings" from the Save/Restore tab first!</li>';
		}
	}
	if (weaverii_getopt_checked('_wii_sim_mobile') && weaverii_getopt_checked('_wii_sim_mobile_always')) {
		echo '<li>You have <em>Simulate Mobile Device</em> enabled for all visitors to your site. That is recommended only for demo sites. (Mobile tab)</li>';
	}
	if ( (strpos( weaverii_getopt('_wii_mode_mobile'), 'nostack' ) !== false) && !is_active_sidebar('mobile-widget-area')) {
		echo '<li>You don\'t have any widgets defined for the <em>Mobile Device Widget Area</em> (Dashboard:Widgets).
		It is highly recommended to define alternate mobile widgets when you are using a "hide sidebars" mobile mode.</li>';
	}
	if (weaverii_getopt_checked('_wii_mobile_disable')) {
		echo '<li>You have <em>Disable Mobile Support</em> checked. That is not recommended unless you have an alternate mobile theme plugin. (Mobile tab)</li>';
	}
	if (weaverii_smart_mode()) {
?>
	<li>You are using a "smart" Mobile Support Mode. You can use the <em>Mobile Device Simulator</em> to check how your site will look on mobile devices. (Mobile tab)</li>
<?php } else { ?>
	<li>You are using a "responsive" Mobile Support Mode. You can shrink the width of your desktop browser to see how your site will look on mobile devices.</li>
<?php } ?>
	</ul>
	<p style="font-weight:normal;">Theme check complete.</p>

</div>
<?php
}

function weaverii_check_mobile_plugins($before='<p style="border:1px solid black;padding:2px 2px 2px 6px;background:#faa">',$after='</p>') {

	$bad_plugin = '';

	if (function_exists('jetpack_check_mobile'))
		$bad_plugin = "JetPack's Mobile Theme option";

	if (function_exists('wptouch_init'))
		$bad_plugin = "WPtouch Mobile Theme plugin";

	if (function_exists('wordpress_mobile_pack_init'))
		$bad_plugin = "WordPress Mobile Pack plugin";

	if (function_exists('websitez_check_and_act_mobile'))
		$bad_plugin = "WP Mobile Detector plugin";

	if (function_exists('get_wapl_plugin_base'))
		$bad_plugin = "Wapple Architect Mobile plugin";

	if ($bad_plugin != '') {
		echo $before;
		if (weaverii_disable_mobile()) {
?>
<strong>WARNING:</strong> You are using
<strong><?php echo $bad_plugin; ?></strong>. You have disabled Weaver II's Smart mobile device
support, but you should be aware that you no longer have the many advantages of Weaver II's
mobile support, and that your desktop and mobile site views will look different.
This is not recommended for an optimal user experience.
<?php
		} else {
?>
<strong style="color:red;">ERROR:</strong> You are using
<strong><?php echo $bad_plugin; ?></strong>, but have left
Weaver II's Smart Mobile support enabled.
Weaver II's Smart Mobile support is not compatible with alternative Mobile Theme plugins. Using
two methods for mobile devices will result in display conflicts.
<em>You <strong>must</strong> disable <?php echo $bad_plugin; ?>,
or disable Weaver II's mobile support to avoid display conflicts.
</em>
<?php
		}
		echo $after;
	}
}

?>
