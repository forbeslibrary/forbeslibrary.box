<?php
if ( !defined('ABSPATH')) exit; // Exit if accessed directly
/* --- MULTI-SITE Control ---
  All non-checkbox options for this theme are filtered based on the 'unfiltered_html' capability,
  so non-admins and non-editors can only add safe html to the various options. It should be
  farily safe to leave all theme options available on your Multi-site installation. If you want
  to eliminate most of the options that let users enter HTML, then set this option to true.

  You can uncomment the define (remove the // in front) in this file, but that change will be
  overwritten when you update the theme. You can also copy the uncommented line to the wp-config.php
  file for your WP installation (anywhere before the "That's all, stop editing! Happy blogging." line),
  and the setting will then survive WP and theme updates.
*/
// Remove the leading // on the next line to restrict some options for users on multisite
// define('WEAVERII_MULTISITE_RESTRICT_OPTIONS', true);

/* Version Information */

define ('WEAVERII_VERSION','2.1.12');
define ('WEAVERII_VERSION_ID',100);
define ('WEAVERII_THEMENAME', 'Weaver II');
define ('WEAVERII_THEMEVERSION',WEAVERII_THEMENAME . ' ' . WEAVERII_VERSION);
define ('WEAVERII_MIN_WPVERSION','3.6');

/* utility definitions - should not be edited */
define ('WEAVERII_SLUG', 'weaver-ii');
define ('WEAVERII_PRO_SLUG','weaver-ii-pro');
define ('WEAVER_MINIFY','.min');	// dev: '', production: '.min'
?>
