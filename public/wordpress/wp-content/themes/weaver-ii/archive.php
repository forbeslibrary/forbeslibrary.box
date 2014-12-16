<?php
if ( !defined('ABSPATH')) exit; // Exit if accessed directly
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Weaver II
 * @since Weaver II 1.0
 */

weaverii_get_header('archive');
if ( weaverii_getopt('wii_infobar_location') == 'top' ) get_template_part('infobar');
weaverii_inject_area('premain');
echo("\t<div id=\"main\">\n");
weaverii_trace_template(__FILE__);
weaverii_get_sidebar_left('archive');
?>
	<div id="container_wrap"<?php weaverii_get_page_class('archive', 'container-archive'); ?>>
<?php
        if (weaverii_getopt('wii_infobar_location') == 'content') get_template_part('infobar');
            weaverii_inject_area('precontent'); ?>
		<section id="container">
<?php
        weaverii_get_sidebar_top('archive'); ?>
            <div id="content" role="main">

<?php 	if ( have_posts() ) { ?>

			<header class="page-header">
			    <h1 class="page-title archive-title"><span class="archive-title-label">
<?php
                if ( is_day() ) {
                    printf( __( 'Daily Archives: %s','aspen'), '</span><span>' . get_the_date() );
			    } else if ( is_month() ) {
                    printf( __( 'Monthly Archives: %s','aspen'), '</span><span>' . get_the_date( 'F Y' ));
			    } else if ( is_year() ) {
                    printf( __( 'Yearly Archives: %s','aspen'), '</span><span>' . get_the_date( 'Y' ) );
			    } else if ( is_tax() ) {        // these improve presentation of custom tax titles
                    single_term_title();
                } else {
                    post_type_archive_title();
                }
?>
                </span></h1>
<?php
                $term_description = term_description();
                if ( ! empty( $term_description ) )
                    echo apply_filters( 'taxonomy_archive_meta', '<div class="tax-archive-meta">' . $term_description . '</div>' );
?>

			</header>
<?php
            weaverii_content_nav( 'nav-above' );
            weaverii_masonry('begin-posts');
            /* Start the Loop */
            weaverii_post_count_clear();
            while ( have_posts() ) {
                the_post();
                weaverii_masonry('begin-post');
                weaverii_post_count_bump();

                /* Include the Post-Format-specific template for the content.
                 * If you want to overload this in a child theme then include a file
                 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                 */
                get_template_part( 'content', get_post_format() );
                weaverii_masonry('end-post');
            }
            weaverii_masonry('end-posts');
            weaverii_content_nav( 'nav-below' );

		} else {
            weaver_not_found_search(__FILE__);
		} ?>

			</div><!-- #content -->
<?php       weaverii_get_sidebar_bottom('archive'); ?>
		</section><!-- #container -->
	</div><!-- #container_wrap -->

<?php
	weaverii_get_sidebar_right('archive');
	weaverii_get_footer('archive');
?>
