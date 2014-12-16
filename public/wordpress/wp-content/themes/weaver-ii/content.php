<?php
if ( !defined('ABSPATH')) exit; // Exit if accessed directly
/**
 * The default template for displaying content on blog pages
 *
 * This will display unmatched post-type blog posts from main blog page and archive-type pages
 * Note - if you are building a custom content-xxx.php page for a custom post type, you should
 * be sure that Feature Images are processed correctly via weaverii_the_contnt_featured().
 *
 * @package WordPress
 * @subpackage Weaver II
 * @since Weaver II 1.0
 */
weaverii_trace_template(__FILE__);
global $weaverii_cur_post_id;
$weaverii_cur_post_id = get_the_ID();
weaverii_per_post_style();


if (weaverii_is_checked_page_opt('wvr_pwp_compact_posts')
	 && !is_archive()
	 && !is_search()
	 && ($the_image = weaverii_get_first_post_image()) != ''
	) {
?>
	<article id="post-<?php the_ID(); ?>" <?php post_class('content-default content-compact-post ' . weaverii_post_count_class() ); ?>>
		<header class="entry-header">
			<div class="entry-hdr"><h2 class="entry-title">
			<a href="<?php esc_url(the_permalink()); ?>" title="<?php printf( esc_attr(__( 'Permalink to %s','weaver-ii')),
                the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
			</h2></div>
		</header><!-- .entry-header -->
		<div class="entry-compact"> <!-- Compact Post -->
		<a href="<?php esc_url(the_permalink()); ?>" title="<?php printf( esc_attr(__( 'Permalink to %s','weaver-ii')),
                the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
		<?php echo $the_image; ?>
		</a>
		</div><!-- .entry-compact -->

<?php
} else {
?>
	<article id="post-<?php the_ID(); ?>" <?php post_class('content-default ' . weaverii_post_count_class() ); ?>>
		<header class="entry-header">
<?php
        if (is_sticky() ) {
			weaverii_entry_header('');
		} else {
			weaverii_post_title('<div class="entry-hdr"><h2 class="entry-title">', "</h2></div>\n");
		}

		if ( 'page' != get_post_type() ) { ?>
			<div class="entry-meta">
				<?php weaverii_post_top_info(); ?>
			</div><!-- .entry-meta -->
<?php
        }
		weaverii_comments_popup_link(); ?>
		</header><!-- .entry-header -->
<?php
		if ((weaverii_get_per_page_value('wvr_pwp_type') == 'title_featured' && ! weaverii_sc_getopt( 'showposts' ))
            || weaverii_sc_getopt('show') == 'title_featured') {
				// title has been displayed - add the featured image after for these special cases
					echo '<div class="entry-content cf">';
					weaverii_use_fi_in_content();
					echo '</div>';
		}
		if (weaverii_show_only_title()) {
			return;
		}
		if (weaverii_do_excerpt()) {
?>
		<div class="entry-summary"> <!-- EXCERPT -->
<?php 			weaverii_the_excerpt_featured(); ?>
		</div><!-- .entry-summary -->
<?php
        } else {
?>
		<div class="entry-content cf">
<?php
            weaverii_the_contnt_featured();
			wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:','weaver-ii') . '</span>', 'after' => '</div>' ) ); ?>
		</div><!-- .entry-content -->
<?php 		} ?>

		<footer class="entry-utility">
<?php
		weaverii_post_bottom_info();
		weaverii_compact_link('check');
?>
		</footer><!-- #entry-utility -->
<?php
		weaverii_inject_area('postpostcontent');	// inject post comment body
} // regular post
?>
	</article><!-- #post-<?php the_ID(); ?> -->
