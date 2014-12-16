<?php
if ( !defined('ABSPATH')) exit; // Exit if accessed directly
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till < div id="main" >
 *
 * @package WordPress
 * @subpackage Weaver II
 * @since Weaver II 1.0
 */
if (function_exists('weaverii_ts_pp_switch'))
	weaverii_ts_pp_switch();
weaverii_setup_mobile();
?><!DOCTYPE html>
<!--[if IE 7]>	<html id="ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>	<html id="ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9]>	<html id="ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8) ] | !(IE 9) ><!-->	<html <?php language_attributes(); ?>> <!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<?php
	$viewport = "<meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=2.0, user-scalable=yes' />\n";
	// Need to see if the visitor has opened Full View on a mobile device - use viewport to get full desktop view
	if ((weaverii_sim_mobile() && !weaverii_in_mobile_view())
	|| weaverii_is_mobile() && weaverii_mobile_gettype() != 'tablet') {
        if (!weaverii_in_mobile_view()) {
            $tw = weaverii_getopt('wii_theme_width_int');
            if (!$tw) $tw = 940;
            $viewport = "<meta name='viewport' content='width=" . $tw . "px, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes' />\n";
        }
	}
	if (weaverii_getopt_checked('wii_theme_width_fixed') || weaverii_getopt_checked('_wii_mobile_disable'))
        $viewport = "<!-- no viewport -->\n";
	echo $viewport;
?>
<title><?php		// ++++++ HEAD TITLE ++++++
	wp_title('');		// this is compatible with SEO plugins
?></title>

<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->

<?php			// ++++ CSS AND CUSTOM SCRIPTS ++++
	$icon = weaverii_getopt('_wii_favicon_url');
	if ($icon != '') {
        $url = apply_filters('weaverii_css',parse_url($icon,PHP_URL_PATH));
        echo "<link rel=\"shortcut icon\"  href=\"$url\" />\n";
	}
	$icon = weaverii_getopt('_wii_apple_touch_icon_url');
	if ($icon != '') {
        $url = apply_filters('weaverii_css',parse_url($icon,PHP_URL_PATH));
        echo "<link rel=\"apple-touch-icon\"  href=\"$url\" />\n";
	}
	weaverii_facebook_meta();
?>
<style type="text/css">
html, body, div, span, iframe, wrap
{
	background: transparent;
	border: 0;
	margin: 0;
	outline: 0;
	padding: 0;
	vertical-align: baseline;
}
</style>

<?php
	global $weaverii_cur_page_ID;

	global $post;
	$weaverii_cur_page_ID = 0;	// need this for 404 page when this is not valid
	if (is_object($post))
        $weaverii_cur_page_ID = get_the_ID();	// we're on a page now, so set the post id for the rest of the session

	$per_page_code = weaverii_get_per_page_value('page-head-code');

	if (!empty($per_page_code)) {
        echo($per_page_code);
	}
?>
</head>

<body class="raw">
<?php weaverii_trace_template(__FILE__);
echo "<div id=\"wrap\" class=\"hfeed\">\n";

?>
