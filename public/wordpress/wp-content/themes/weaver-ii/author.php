<?php
if ( !defined('ABSPATH')) exit; // Exit if accessed directly
/**
 * The template for displaying Author Archive pages.
 *
 * @package WordPress
 * @subpackage Weaver II
 * @since Weaver II 1.0
 */

weaverii_get_header('author');
if ( weaverii_getopt('wii_infobar_location') == 'top' )
    get_template_part('infobar');
weaverii_inject_area('premain');
echo("\t<div id=\"main\">\n");
weaverii_trace_template(__FILE__);
weaverii_get_sidebar_left('author');
?>
		<div id="container_wrap"<?php weaverii_get_page_class('author', 'container-author'); ?>>
<?php
        if (weaverii_getopt('wii_infobar_location') == 'content')
            get_template_part('infobar');
		weaverii_inject_area('precontent'); ?>
		<section id="container">
<?php
        weaverii_get_sidebar_top('author'); ?>
			<div id="content" role="main">

			<?php if ( have_posts() ) : ?>

				<?php
					/* Queue the first post, that way we know
					 * what author we're dealing with (if that is the case).
					 *
					 * We reset this later so we can run the loop
					 * properly with a call to rewind_posts().
					 */
					the_post();
				?>

				<header class="page-header archive-title">
					<h1 class="page-title author author-title"><span class="author-title-label"><?php printf( __( 'Author Archives: %s','weaver-ii'), '</span><span class="vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' ); ?></h1>
				</header>

				<?php
					/* Since we called the_post() above, we need to
					 * rewind the loop back to the beginning that way
					 * we can run the loop properly, in full.
					 */
					rewind_posts();
				?>

				<?php weaverii_content_nav( 'nav-above' ); ?>

				<?php
				// If a user has filled out their description, show a bio on their entries.
				if ( get_the_author_meta( 'description' ) ) { ?>
				<br />
				<div id="author-info">
					<div id="author-avatar">
						<?php echo get_avatar( get_the_author_meta( 'user_email' ),
						apply_filters( 'weaverii_author_bio_avatar_size', 60 ) ); ?>
					</div><!-- #author-avatar -->
					<div id="author-description">
						<h2><?php printf( __( 'About %s','weaver-ii'), trim(get_the_author()) ); ?></h2>
						<?php the_author_meta( 'description' ); ?>
					</div><!-- #author-description	-->
				</div><!-- #author-info -->
				<?php }

				/* Start the Loop */

				weaverii_post_count_clear();
				weaverii_masonry('begin-posts');
				while ( have_posts() ) {
					the_post();
					weaverii_post_count_bump();
					weaverii_masonry('begin-post');
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
<?php		weaverii_get_sidebar_bottom('author'); ?>
		</section><!-- #container -->
		</div><!-- #container_wrap -->

<?php
    weaverii_get_sidebar_right('author');
	weaverii_get_footer('author');
?>
