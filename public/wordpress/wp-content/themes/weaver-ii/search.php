<?php
if ( !defined('ABSPATH')) exit; // Exit if accessed directly
/**
 * The template for displaying Search Results pages.
 *
 * @package WordPress
 * @subpackage Weaver II
 * @since Weaver II 1.0
 *
 * changed 1.0.25 - paged navi doesn't work right on multipage search result, so skip infobar and force prev/next
 */

weaverii_get_header('search');
if ( weaverii_getopt('wii_infobar_location') == 'top' ) get_template_part('infobar');
weaverii_inject_area('premain');
echo("\t<div id=\"main\">\n");
weaverii_trace_template(__FILE__);
weaverii_get_sidebar_left('search');

?>
		<div id="container_wrap"<?php weaverii_get_page_class('search', 'container-search'); ?>>
<?php
        if ( weaverii_getopt('wii_infobar_location') == 'content' ) get_template_part('infobar');
?>
		<section id="container">
<?php		weaverii_get_sidebar_top('search'); ?>
			<div id="content" role="main">

			<?php if ( have_posts() ) : ?>

				<header class="page-header">
					<h1 class="page-title search-results"><span class="search-results-label"><?php printf( __( 'Search Results for: "%s"','weaver-ii'), '</span><span>' . get_search_query() . '</span>' ); ?></h1>
				</header>

				<?php weaverii_content_nav( 'nav-above', true ); ?>
				<?php /* Start the Loop */ ?>
				<?php weaverii_post_count_clear();
				weaverii_masonry('begin-posts');
				while ( have_posts() ) {
                    the_post();
                    weaverii_post_count_bump();
						/* Include the Post-Format-specific template for the content.
						 * If you want to overload this in a child theme then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						weaverii_masonry('begin-post');
						get_template_part( 'content', get_post_format() );
						weaverii_masonry('end-post');
                } // end while have posts

                weaverii_masonry('end-posts');
				weaverii_content_nav( 'nav-below', true ); ?>

			<?php else : ?>

				<article id="post-0" class="post no-results not-found">
					<header class="entry-header">
						<h1 class="entry-title"><?php echo __( 'Nothing Found','weaver-ii'); ?></h1>
					</header><!-- .entry-header -->
<?php
		if (!weaverii_getopt('_wii_hide_not_found_search')) {
?>

					<div class="entry-content">
						<p><?php echo __( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.','weaver-ii'); ?></p>
						<?php get_search_form(); ?>
					</div><!-- .entry-content -->
<?php
	}
?>
				</article><!-- #post-0 -->

			<?php endif; ?>

			</div><!-- #content -->
<?php		weaverii_get_sidebar_bottom('search'); ?>
		</section><!-- #container -->
		</div><!-- #container_wrap -->

<?php 	weaverii_get_sidebar_right('search');
	weaverii_get_footer('search');
?>
