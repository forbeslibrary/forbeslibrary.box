<?php
if ( !defined('ABSPATH')) exit; // Exit if accessed directly
/**
 * The template for displaying content in the single.php template
 *
 * @package WordPress
 * @subpackage Weaver II
 * @since Weaver II 1.0
 */
weaverii_trace_template(__FILE__);
global $weaverii_cur_post_id;
$weaverii_cur_post_id = get_the_ID();
weaverii_per_post_style();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('content-single ' . weaverii_post_count_class(true)); ?>>
	<header class="entry-header">
<?php
		weaverii_post_title('<div class="entry-hdr"><h1 class="entry-title">', "</h1></div>\n", 'single');

		if ( 'page' != get_post_type() ) {
?>
		<div class="entry-meta">
			<?php weaverii_post_top_info('single'); ?>
		</div><!-- .entry-meta -->
<?php
        }
?>
	</header><!-- .entry-header -->

	<div class="entry-content cf">
		<?php weaverii_the_contnt_featured_single(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:','weaver-ii') . '</span>', 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->

	<footer class="entry-utility">
<?php
		weaverii_post_bottom_info('single');

		if ( get_the_author_meta( 'description' ) && !weaverii_getopt('wii_hide_author_bio')) { // If a user has filled out their description, show a bio on their entries
?>
		<div id="author-info">
			<div id="author-avatar">
				<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'weaverii_author_bio_avatar_size', 68 ) ); ?>
			</div><!-- #author-avatar -->
			<div id="author-description">
				<h2><?php printf( esc_attr__( 'About %s','weaver-ii'), trim(get_the_author()) ); ?></h2>
				<?php the_author_meta( 'description' ); ?>
				<div id="author-link">
					<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
						<?php printf( __( 'View all posts by %s','weaver-ii'), trim(get_the_author()) ); ?>
					</a>
				</div><!-- #author-link	-->
			</div><!-- #author-description -->
		</div><!-- #author-info -->
<?php
        }
?>

	</footer><!-- .entry-utility -->
<?php		    weaverii_inject_area('postpostcontent');	// inject post comment body ?>
</article><!-- #post-<?php the_ID(); ?> -->
