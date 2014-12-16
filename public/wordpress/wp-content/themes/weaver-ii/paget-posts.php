<?php
if ( !defined('ABSPATH')) exit; // Exit if accessed directly
/**
 * Template Name: Page With Posts
 * Description: A Page Template that will show posts - pretty much like index
 *
 * inject-infobar won't work right on the page-navi until we restart the loop, so...
 *
 * We create the breadcrumbs part for the page.
 * We buffer the output from the inject-prmain up to the end of the page content
 * We create the page-navi part of the infobar after we restart the loop
 * Then output the infobar with the page breadcrumbs and the posts page-navi and the page buffer
 * Finally, start the new loop.
 */

weaverii_get_header('pwp');
// build infobar front part - replace get_template_part('infobar'); with local code
// we need to build it in a buffer
global $weaverii_crumbs;
$weaverii_crumbs = false;	// this is ugly, I know, but it lets us keep keep the inject-info in just one code base

if (!weaverii_getopt_checked('wii_infobar_hide') && !weaverii_is_checked_page_opt('wvr-hide-page-infobar')) { // let's really not include it rather than display:none.

	if (!weaverii_getopt_checked('wii_info_hide_breadcrumbs'))
        $weaverii_crumbs = weaverii_breadcrumb(false);
}
ob_start();		// now build the page part of the PwP
weaverii_inject_area('premain');
echo("\t<div id=\"main\">\n");
weaverii_trace_template(__FILE__);
weaverii_get_sidebar_left('pwp');
$paged = weaverii_get_page();
?>
		<div id="container_wrap"<?php weaverii_get_page_class('pwp', 'container-pagewithposts'); ?>>

<?php	    $page_part1 = ob_get_clean(); // need to split to handle infobar location
		ob_start();
		weaverii_inject_area('precontent'); ?>
		<div id="container" class="page-with-posts">
<?php		weaverii_get_sidebar_top('pwp'); ?>

		<div id="content" role="main">
<?php 		weaverii_post_count_clear(); the_post();
	if ($paged == 1) {	// only show on the first page
        // If we have content for this page, let's display it.
        if (get_the_content() != '' || (get_the_title() != '' && !weaverii_is_checked_page_opt('ttw-hide-page-title')))
            get_template_part( 'content', 'pwp' );
	}

	$page_part2 = ob_get_clean();

	if (weaverii_getopt('wii_pwp_comments')) {
		$pwp_comments = '';
		if ($paged == 1) {	// only show on the first page
            ob_start();
            comments_template( '', true );
            $pwp_comments = ob_get_clean();
		}
	}

	// Now, the posts
	global $wp_query;
	$old_query = $wp_query;

	$args = array(
		'ignore_sticky_posts' => false,
		'orderby' => 'date',
		'order' => 'DESC',
		'paged' => $paged
	);


    $filter = weaverii_get_per_page_value( 'pp_post_filter' );
    if ( function_exists( 'atw_showposts_installed' ) && $filter != '') {
        $params = atw_posts_get_filter_params( $filter );
        if ($params != '') {        // they specified a $filter arg, so use it and wipe out anything else...
           $fargs = shortcode_parse_atts( $params );
        } else {
            $fargs = '';
        }

        // 'show' 'hide_title' 'show_avatar' 'hide_top_info' 'hide_bottom_info' 'hide_featured_image''more_msg'

        $qargs = atw_posts_get_qargs( $fargs, array() );
        $wp_query = new WP_Query(apply_filters('weaver_pwp_wp_query', $qargs));		// reuse $wp_query to make paging work

    } else {
        $args = weaverii_setup_post_args($args);	// setup custom fields for this page
        $wp_query = new WP_Query(apply_filters('weaver_pwp_wp_query',$args));		// reuse $wp_query to make paging work
    }

	// now, put the infobar
	if ( weaverii_getopt('wii_infobar_location') == 'top' )
		get_template_part('infobar');	// This will use the global $weaverii_crumbs instead of "current" version
	$weaverii_crumbs = false;		// IMPORTANT - need to clear the global now for the rest of the world
	echo $page_part1;	// and now the page post
	if ( weaverii_getopt('wii_infobar_location') == 'content' )
		get_template_part('infobar');	// This will use the global $weaverii_crumbs instead of "current" version
	echo $page_part2;	// and now the page post

	if ( have_posts() ) {				// same loop as index.php
		global $weaverii_sticky;

		weaverii_content_nav( 'nav-above' );
		$sticky_posts = false;

		// really ugly kludge. This code is copied from WP's WP_Query code. If you specify filters,
		// then the sticky post code is essentially ignored by WP, so we have to do this ourselves.
		// So - if there are sticky posts, we have to move them to the top of the posts list, and
		// manually add 'sticky' to the post's class. (1/11/12)

		if (!weaverii_is_checked_page_opt('ttw_hide_sticky')
		&& (weaverii_get_per_page_value('ttw_category')
			|| weaverii_get_per_page_value('ttw_tag')
		)) {	// move sticky posts when cat or tag filters?
            // Put sticky posts at the top of the posts array
            $sticky_posts = get_option('sticky_posts');
            global $page;
            if ($page <= 1 && is_array($sticky_posts) && !empty($sticky_posts)) {
                $num_posts = count($wp_query->posts);
                $sticky_offset = 0;
                // Loop over posts and relocate stickies to the front.
                for ( $i = 0; $i < $num_posts; $i++ ) {
                    if ( in_array($wp_query->posts[$i]->ID, $sticky_posts) ) {
                        $sticky_post = $wp_query->posts[$i];
                        // Remove sticky from current position
                        array_splice($wp_query->posts, $i, 1);
                        // Move to front, after other stickies
                        array_splice($wp_query->posts, $sticky_offset, 0, array($sticky_post));
                        // Increment the sticky offset. The next sticky will be placed at this offset.
                        $sticky_offset++;
                    }
                }
            }
		}

		/* Start the Loop */
		$num_cols = weaverii_getopt('wii_blog_cols'); // default
		$pp = weaverii_get_per_page_value('wvr_pwp_cols');
		if ($pp) $num_cols = $pp;
		if (weaverii_use_mobile('mobile')) $num_cols = 1;
		if (!$num_cols || $num_cols > 3) $num_cols = 1;

		$sticky_one = weaverii_getopt_checked( 'wii_blog_sticky_one' ) && $paged <= 1;
		$first_one = weaverii_getopt_checked( 'wii_blog_first_one' ) && $paged <= 1;
		$masonry_wrap = false;	// need this for one-column posts
		$hide_n_posts = weaverii_get_per_page_value('wvr_hide_n_posts');
		if ($hide_n_posts == '' || $hide_n_posts < 1 || $hide_n_posts > 100)
            $hide_n_posts = 0;

		weaverii_post_count_clear();
		$col = 0;
		while ( have_posts() ) {
            the_post();
            weaverii_post_count_bump();

            if ( weaverii_post_count() <= $hide_n_posts ) {
                global $page, $paged;
                if ( !($paged >= 2 || $page >= 2) ) {
                continue;			// skip posting
                }
            }

            $weaverii_sticky = false;

            if (is_array($sticky_posts) && !empty($sticky_posts) && in_array( get_the_ID(), $sticky_posts )) {
                $weaverii_sticky = true;
            }

            if ( (is_sticky() || $weaverii_sticky) && $sticky_one) {
                get_template_part( 'content', get_post_format() );
            } else if ( $first_one ) {
                get_template_part( 'content', get_post_format() );
                $first_one = false;
            } else {
                if (!$masonry_wrap) {
                $masonry_wrap = true;
                if (weaverii_masonry('begin-posts'))
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
                        if ( !($col % 3) ) {
                            echo "<div style=\"clear:left;\"></div>\n";
                        }
                        $sticky_one = false;
                        break;
                    default:
                        get_template_part( 'content', get_post_format() );
                        $sticky_one = false;
                }	// end switch $num_cols
                weaverii_masonry('end-post');
            }
		}	// end while have posts
		weaverii_masonry('end-posts');
		weaverii_content_nav( 'nav-below' );
	} else {
		weaver_not_found_search(__FILE__);
	}

	// every thing done, so allow comments?

	if (weaverii_getopt('wii_pwp_comments')) {
		if ($pwp_comments != '')
            echo $pwp_comments;
	}
?>

		</div><!-- #content -->
<?php
		weaverii_get_sidebar_bottom('pwp');
		$wp_query = $old_query; wp_reset_postdata();	// need these so extra-menus work in rightsidebar and footer
?>
		</div><!-- #container -->
		</div><!-- #container_wrap -->

<?php	weaverii_get_sidebar_right('pwp');
	weaverii_get_footer('pwp');
?>
