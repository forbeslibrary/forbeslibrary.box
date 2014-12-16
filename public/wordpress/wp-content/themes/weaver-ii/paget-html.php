<?php
if ( !defined('ABSPATH')) exit; // Exit if accessed directly
/**
 * Template Name: HTML Source
 *
 *
 * @package WordPress
 * @subpackage Weaver II
 * @since Weaver II 1.0
 */

weaverii_get_header('html_source');
if ( weaverii_getopt('wii_infobar_location') == 'top' ) get_template_part('infobar');
weaverii_inject_area('premain');
echo("\t<div id=\"main\">\n");
weaverii_trace_template(__FILE__);
weaverii_get_sidebar_left('html_source');
?>
		<div id="container_wrap"<?php weaverii_get_page_class('page', 'container-pagehtml'); ?>>
<?php		if (weaverii_getopt('wii_infobar_location') == 'content') get_template_part('infobar');
		weaverii_inject_area('precontent'); ?>
		<div id="container">
<?php		weaverii_get_sidebar_top('html_source'); ?>

			<div id="content" role="main">
<?php
            while ( have_posts() ) {
				weaverii_post_count_clear(); the_post();

				get_template_part( 'content', 'html' );

				comments_template( '', true );
			}
?>
			</div><!-- #content -->
<?php		weaverii_get_sidebar_bottom('html_source'); ?>
		</div><!-- #container -->
		</div><!-- #container_wrap -->

<?php	weaverii_get_sidebar_right('html_source');
	weaverii_get_footer('html_source');
?>
