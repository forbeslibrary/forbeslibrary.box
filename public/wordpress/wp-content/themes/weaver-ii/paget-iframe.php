<?php
if ( !defined('ABSPATH')) exit; // Exit if accessed directly
/**
 * Template Name: iframe - full content width
 *
 *
 * @package WordPress
 * @subpackage Weaver II
 * @since Weaver II 1.0
 */

weaverii_get_header('iframe');
if ( weaverii_getopt('wii_infobar_location') == 'top' ) get_template_part('infobar');
weaverii_inject_area('premain');
echo("\t<div id=\"main\">\n");
weaverii_trace_template(__FILE__);
weaverii_get_sidebar_left('iframe');
?>
		<div id="container_wrap"<?php weaverii_get_page_class('page', 'container-pageiframe'); ?>>
<?php
        if (weaverii_getopt('wii_infobar_location') == 'content') get_template_part('infobar');
		weaverii_inject_area('precontent'); ?>
		<div id="container" class="page-iframe">
<?php		weaverii_get_sidebar_top('iframe'); ?>

			<div id="content" role="main">
<?php
            while ( have_posts() ) {
				weaverii_post_count_clear(); the_post();

				get_template_part( 'content', 'page' );

				comments_template( '', true );
			}
?>
			</div><!-- #content -->
<?php		weaverii_get_sidebar_bottom('iframe'); ?>
		</div><!-- #container -->
		</div><!-- #container_wrap -->

<?php	weaverii_get_sidebar_right('iframe');
	weaverii_get_footer('iframe');
?>
