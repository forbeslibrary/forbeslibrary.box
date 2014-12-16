<?php
if ( !defined('ABSPATH')) exit; // Exit if accessed directly
/**
 * Template Name: 2 Col Content (split w/ &lt;!--more--&gt;).
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Weaver II
 * @since Weaver II 1.0
 */

weaverii_get_header('page');
if ( weaverii_getopt('wii_infobar_location') == 'top' ) get_template_part('infobar');
weaverii_inject_area('premain');
echo("\t<div id=\"main\">\n");
weaverii_trace_template(__FILE__);
weaverii_get_sidebar_left('page');
?>
		<div id="container_wrap"<?php weaverii_get_page_class('page', 'container-page2col'); ?>>
<?php
        if (weaverii_getopt('wii_infobar_location') == 'content') get_template_part('infobar');
		weaverii_inject_area('precontent'); ?>
		<div id="container">
<?php		weaverii_get_sidebar_top('page'); ?>

			<div id="content" role="main">
<?php
            while ( have_posts() ) {
				weaverii_post_count_clear(); the_post();
				if (weaverii_use_mobile('mobile'))
					get_template_part( 'content', 'page' );
				else
					get_template_part( 'content', 'page2col' );

				comments_template( '', true );
			}
?>
			</div><!-- #content -->
<?php		weaverii_get_sidebar_bottom('page'); ?>
		</div><!-- #container -->
		</div><!-- #container_wrap -->

<?php	weaverii_get_sidebar_right('page');
	weaverii_get_footer('page');
?>
