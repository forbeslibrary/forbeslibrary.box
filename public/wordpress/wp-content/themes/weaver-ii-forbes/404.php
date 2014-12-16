<?php
if ( !defined('ABSPATH')) exit; // Exit if accessed directly
/**
 * The template for displaying 404 pages (Not Found).
 */
/* weaverii_get_header('404'); */
?>
<!DOCTYPE html>
<!--[if IE 7]>	<html id="ie7" lang="en-US"> <![endif]-->
<!--[if IE 8]>	<html id="ie8" lang="en-US"> <![endif]-->
<!--[if IE 9]>	<html id="ie9" lang="en-US"> <![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8) ] | !(IE 9) ><!-->	<html lang="en-US"> <!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title>Page not found | Forbes Library</title>
<?php
  /* BEGINING OF HEADER CODE COPIED FROM HEADER TEMPLATE */
	$sheet_dev = get_stylesheet_directory_uri() . '/style.css';	// get style.css
	$sheet = str_replace('.css', WEAVER_MINIFY.'.css',$sheet_dev); // default sheet
	$sheet_file = get_stylesheet_directory() . '/style' . WEAVER_MINIFY . '.css';
	if (! @file_exists($sheet_file))
        $sheet = $sheet_dev;		// no style.min.css available (need this check for child themes)
	$sheet_name = 'weaverii-main-style-sheet';

	if (($custom = weaverii_getopt('_wii_custom_style')) != '') {	// set which style sheet we are using
        $sheet = $custom;
        $sheet_name = 'weaverii-main-style-sheet-custom';
	} else if (weaverii_getopt_checked('wii_minimial_style')) {
        $sheet = get_template_directory_uri() . '/style-minimal'.WEAVER_MINIFY.'.css';
        $sheet_name = 'weaverii-main-style-sheet-min';
	}

	wp_register_style($sheet_name,$sheet,array(),WEAVERII_VERSION,'all');
	wp_enqueue_style($sheet_name);
	// the mobile style sheet

	if (!weaverii_getopt_checked('_wii_mobile_disable')) {
        $sheet = get_template_directory_uri() . '/style-mobile'.WEAVER_MINIFY.'.css';
        $msheet_name = 'weaverii-mobile-style-sheet';
        wp_register_style($msheet_name,$sheet,array(),WEAVERII_VERSION,'all');
        wp_enqueue_style($msheet_name);
	}
?>
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

	if ( !weaverii_use_inline_css(weaverii_get_css_filename()) ) { // don't generate inline CSS
        $vers = weaverii_getopt('wii_style_version');
        if (!$vers) $vers = '1';
        else $vers = sprintf("%d",$vers);
        wp_register_style('weaverii-style-sheet',weaverii_get_css_url(),array($sheet_name),$vers);
        wp_enqueue_style('weaverii-style-sheet');
	}

	weaverii_pro_wp_head();	// anything needed for Pro Version

	wp_head();
	/* END OF HEAD CODE COPIED FROM HEADER TEMPLATE */
?>
</head>
<body class="error404">
<div id="wrapper">
<div id="main"><?php
weaverii_trace_template(__FILE__);
/* weaverii_get_sidebar_left('404');	// mimic search */ 
?>
	<div id="container_wrap container-404">
	<div id="container">
		<div id="content" role="main">

			<article>

				<header class="entry-header">
					<h1 class="entry-title">Oh gosh! We cannot find that page! (error 404)</h1>
				</header>

<?php
	if (!weaverii_getopt('_wii_hide_not_found_search')):
?>
				<div class="entry-content cf">
<?php $ref = $_SERVER['HTTP_REFERER'];
$host = parse_url($ref)['host'];
if ($host == 'forbeslibrary.org'):?>
					<p>This appears to be our fault. We're sorry and will try to fix it soon.</p>
<?php endif; ?>
          <p>You may use the search form below. If you still can't find what you are looking for, please <a href="http://forbeslibrary.org/info/contact/">contact us</a>.</p>
					<?php get_search_form(); ?>

				</div><!-- .entry-content -->
<?php
	endif;
?>
			</article><!-- #post-0 -->
    <a href="http://forbeslibrary.org/"><img id="custom-header-logo" width="348" height="100" alt="Forbes Library homepage" src="http://forbeslibrary.org/wp-content/uploads/2013/11/Forbes_logo_words.png"></a>
		</div><!-- #content -->
	</div><!-- #container -->
	</div><!-- #container_wrap -->

<?php
	/* weaverii_get_sidebar_right('404'); */
	/* weaverii_get_footer('404'); ?> */
?>
</div><!-- #main -->
</div><!-- #wrapper -->
</body>
