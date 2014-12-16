<?php
if ( !defined('ABSPATH')) exit; // Exit if accessed directly
/**
 * The template for displaying posts in the Audio Post Format on index and archive pages
 *
 * Learn more: http://codex.wordpress.org/Post_Formats
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
	<article id="post-<?php the_ID(); ?>" <?php post_class('content-audio ' . weaverii_post_count_class()); ?>>
<?php
	if (!weaverii_compact_post()) {
?>
		<header class="entry-header">
<?php
        weaverii_entry_header(__( 'Audio','weaver-ii'));
		weaverii_comments_popup_link(); ?>
		</header><!-- .entry-header -->

<?php
		if (weaverii_show_only_title()) {
			return;
		}
	}
?>
		<div class="entry-content cf">
			<?php echo weaverii_the_contnt_featured(); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:','weaver-ii') . '</span>', 'after' => '</div>' ) ); ?>
		</div><!-- .entry-content -->
<?php
	if (!weaverii_compact_post()
		&& !weaverii_is_checked_post_opt('hide_bottom_post_meta')
		&& !weaverii_is_checked_page_opt('ttw_hide_pp_infobot')) {
?>
		<footer class="entry-utility">
			<div class="entry-utility">
				<?php
					printf( __( '<a href="%1$s" rel="bookmark"><time class="entry-date" datetime="%2$s">%3$s</time></a><span class="by-author"> <span class="sep"> by </span> <span class="author vcard"><a class="url fn n" href="%4$s" title="%5$s" rel="author">%6$s</a></span></span>','weaver-ii'),
						esc_url( get_permalink() ),
						get_the_date( 'c' ),
						get_the_date(),
						esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
						sprintf( esc_attr__( 'View all posts by %s','weaver-ii'), get_the_author() ),
						get_the_author()
					);
				?>
			</div><!-- .entry-utility -->

			<div class="entry-utility">
				<?php
					/* translators: used between list items, there is a space after the comma */
					$categories_list = get_the_category_list( __( ', ','weaver-ii') );
					if ( $categories_list ) {
				?>
				<span class="cat-links">
                    <?php printf( __( '<span class="%1$s">Posted in</span> %2$s','weaver-ii'), 'entry-utility-prep entry-utility-prep-cat-links', $categories_list ); ?>
				</span>
				<?php } // End if categories ?>
				<?php
					/* translators: used between list items, there is a space after the comma */
					$tags_list = get_the_tag_list( '', __( ', ','weaver-ii') );
					if ( $tags_list ) { ?>
				<span class="tag-links">
					<?php printf( __( '<span class="%1$s">Tagged</span> %2$s','weaver-ii'), 'entry-utility-prep entry-utility-prep-tag-links', $tags_list ); ?>
				</span>
				<?php } // End if $tags_list ?>

				<?php if ( comments_open() ) { ?>
				<span class="comments-link"><?php comments_popup_link( '<span class="leave-reply">' . __( 'Reply','weaver-ii') . '</span>', __( '<strong>1</strong> Reply','weaver-ii'), __( '<strong>%</strong> Replies','weaver-ii') ); ?></span>
				<?php } // End if comments_open() ?>
			</div><!-- .entry-utility -->
<?php
			weaverii_compact_link('check');
			edit_post_link( __( 'Edit','weaver-ii'), '<span class="edit-link">', '</span>' );
?>
		</footer><!-- #entry-utility -->

<?php
	} else {
		weaverii_compact_link();
		edit_post_link( __( 'Edit','weaver-ii'), '<span class="edit-link">', '</span>' );
	}
	weaverii_inject_area('postpostcontent');	// inject post comment body ?>
	</article><!-- #post-<?php the_ID(); ?> -->
