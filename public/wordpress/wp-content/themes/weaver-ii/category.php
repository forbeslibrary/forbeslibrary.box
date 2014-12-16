<?php
if ( !defined('ABSPATH')) exit; // Exit if accessed directly
/**
 * The template for displaying Category Archive pages.
 *
 * @package WordPress
 * @subpackage Weaver II
 * @since Weaver II 1.0
 */

weaverii_get_header('category');
if ( weaverii_getopt('wii_infobar_location') == 'top' ) get_template_part('infobar');
weaverii_inject_area('premain');
echo("\t<div id=\"main\">\n");
weaverii_trace_template(__FILE__);
weaverii_get_sidebar_left('category');
?>
		<div id="container_wrap"<?php weaverii_get_page_class('category', 'container-category'); ?>>
<?php
        if (weaverii_getopt('wii_infobar_location') == 'content')
            get_template_part('infobar');
		weaverii_inject_area('precontent');
?>
		<section id="container">
<?php		weaverii_get_sidebar_top('category'); ?>
			<div id="content" role="main">

			<?php if ( have_posts() ) : ?>

				<header class="page-header">
					<h1 class="page-title category-title"><span class="category-title-label"><?php
						printf( __( 'Category Archives: %s','weaver-ii'), '</span><span>' . single_cat_title( '', false ) . '</span>' );
					?></h1>

					<?php
						$category_description = category_description();
						if ( ! empty( $category_description ) )
							echo apply_filters( 'category_archive_meta', '<div class="category-archive-meta">' . $category_description . '</div>' );
					?>
				</header>

				<?php weaverii_content_nav( 'nav-above' ); ?>

				<?php /* Start the Loop */ ?>
				<?php
				weaverii_masonry('begin-posts');
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

				weaverii_content_nav( 'nav-below' ); ?>

			<?php else :
				weaver_not_found_search(__FILE__);
			endif; ?>

			</div><!-- #content -->
<?php
        weaverii_get_sidebar_bottom('category'); ?>
		</section><!-- #container -->
		</div><!-- #container_wrap -->

<?php
    weaverii_get_sidebar_right('category');
	weaverii_get_footer('category');
?>
