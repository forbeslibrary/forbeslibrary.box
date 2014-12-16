<?php
if ( !defined('ABSPATH')) exit; // Exit if accessed directly
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Weaver II
 */

weaverii_get_header('index');
if ( weaverii_getopt('wii_infobar_location') == 'top' ) get_template_part('infobar');
weaverii_inject_area('premain');
echo("\t<div id=\"main\">\n");
weaverii_trace_template(__FILE__);
weaverii_get_sidebar_left('index');
?>
		<div id="container_wrap"<?php weaverii_get_page_class('index', 'container-index'); ?>>
<?php
        if ( weaverii_getopt('wii_infobar_location') == 'content' ) get_template_part('infobar');
		weaverii_inject_area('precontent'); ?>
		<div id="container" class="cf index-posts">
<?php		weaverii_get_sidebar_top('index'); ?>
			<div id="content" class = "cf" role="main">

<?php
            if ( have_posts() ) {

				$paged = weaverii_get_page();

				weaverii_content_nav( 'nav-above' );
				$col = 0;
				$num_cols = weaverii_use_mobile('mobile') ? 1 : weaverii_getopt('wii_blog_cols');
				if (!$num_cols || $num_cols > 3) $num_cols = 1;

				$sticky_one = weaverii_getopt_checked( 'wii_blog_sticky_one' ) && $paged <= 1;
				$first_one = weaverii_getopt_checked( 'wii_blog_first_one' ) && $paged <= 1;
				$masonry_wrap = false;	// need this for one-column posts

				/* Start the Loop */

				weaverii_post_count_clear();

                while ( have_posts() ) {
                    the_post();
                    weaverii_post_count_bump();

                    if ( is_sticky() && $sticky_one) {
                        get_template_part( 'content', get_post_format() );
                    } else if ( $first_one ) {
                        get_template_part( 'content', get_post_format() );
                        $first_one = false;
                    } else {
                        if (!$masonry_wrap) {
                            $masonry_wrap = true;
                            if (weaverii_masonry('begin-posts'))	// wrap all posts
                                $num_cols = 1;		// force to 1 cols
                        }
                        weaverii_masonry('begin-post');	// wrap each post
                        switch ($num_cols) {
                            case 1:
                                get_template_part( 'content', get_post_format() );
                                $sticky_one = false;
                                break;
                            case 2:
                                echo ('<div class="content-2-col cf">' . "\n");
                                get_template_part( 'content', get_post_format() );
                                echo ("</div> <!-- content-2-col -->\n");
                                $col++;
                                if ( !($col % 2) ) {	// force stuff to be even
                                    echo "<div style=\"clear:left;\"></div>\n";
                                }
                                $sticky_one = false;
                                break;
                            case 3:
                                echo ('<div class="content-3-col cf">' . "\n");
                                get_template_part( 'content', get_post_format() );
                                echo ("</div> <!-- content-3-col -->\n");
                                $col++;
                                if ( !($col % 3) ) {	// force stuff to be even
                                    echo "<div style=\"clear:left;\"></div>\n";
                                }
                                $sticky_one = false;
                                break;
                            default:
                                get_template_part( 'content', get_post_format() );
                                $sticky_one = false;
                        }   // end switch num cols
                        weaverii_masonry('end-post');
                    } /* end first one col */

				}	// end while have posts
				weaverii_masonry('end-posts');

				weaverii_content_nav( 'nav-below' );
			} else {
				weaver_not_found_search(__FILE__);
			} ?>

			</div><!-- #content -->
<?php		weaverii_get_sidebar_bottom('index'); ?>
		</div><!-- #container -->
		</div><!-- #container_wrap -->

<?php
    weaverii_get_sidebar_right('index');
	weaverii_get_footer('index');
?>
