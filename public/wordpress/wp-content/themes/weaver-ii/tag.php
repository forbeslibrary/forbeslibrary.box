<?php
if ( !defined('ABSPATH')) exit; // Exit if accessed directly
/**
 * The template used to display Tag Archive pages
 *
 * @package WordPress
 * @subpackage Weaver II
 * @since Weaver II 1.0
 */

weaverii_get_header('tag');
if ( weaverii_getopt('wii_infobar_location') == 'top' ) get_template_part('infobar');
weaverii_inject_area('premain');
echo("\t<div id=\"main\">\n");
weaverii_trace_template(__FILE__);
weaverii_get_sidebar_left('tag');
?>
		<div id="container_wrap"<?php weaverii_get_page_class('tag', 'container-tag'); ?>>
<?php
        if (weaverii_getopt('wii_infobar_location') == 'content') get_template_part('infobar');
		weaverii_inject_area('precontent'); ?>
		<section id="container">
<?php		weaverii_get_sidebar_top('tag'); ?>
			<div id="content" role="main">

			<?php if ( have_posts() ) : ?>

				<header class="page-header">
					<h1 class="page-title tag-title"><span class="tag-title-label"><?php
						printf( __( 'Tag Archives: %s','weaver-ii'), '</span><span>' . single_tag_title( '', false ) . '</span>' );
					?></h1>

					<?php
						$tag_description = tag_description();
						if ( ! empty( $tag_description ) )
							echo apply_filters( 'tag_archive_meta', '<div class="tag-archive-meta">' . $tag_description . '</div>' );
					?>
				</header>

				<?php weaverii_content_nav( 'nav-above' ); ?>

				<?php /* Start the Loop */ ?>
				<?php weaverii_post_count_clear();
				weaverii_masonry('begin-posts');
				while ( have_posts() ) : the_post(); weaverii_post_count_bump(); ?>
					<?php
						/* Include the Post-Format-specific template for the content.
						 * If you want to overload this in a child theme then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						weaverii_masonry('begin-post');
						get_template_part( 'content', get_post_format() );
						weaverii_masonry('end-post');
					?>

				<?php endwhile; ?>

				<?php weaverii_masonry('end-posts');
				weaverii_content_nav( 'nav-below' ); ?>

			<?php else : 
				weaver_not_found_search(__FILE__);
			endif; ?>

			</div><!-- #content -->
<?php		weaverii_get_sidebar_bottom('tag'); ?>
		</section><!-- #container -->
		</div><!-- #container_wrap -->

<?php 	weaverii_get_sidebar_right('tag');
	weaverii_get_footer('tag'); ?>
