<?php
if ( !defined('ABSPATH')) exit; // Exit if accessed directly
/**
 * The template for displaying posts in the Chat Post Format on index and archive pages
 *
 * This should find the previous n chat posts and echo them. For now, just one at a time...
 *
 * @package WordPress
 * @subpackage Weaver II
 */
weaverii_trace_template(__FILE__);
global $weaverii_cur_post_id;
$weaverii_cur_post_id = get_the_ID();
weaverii_per_post_style();
?>
	<article id="post-<?php the_ID(); ?>" <?php post_class('content-chat ' . weaverii_post_count_class()); ?>>
		<header class="entry-header">
<?php
        weaverii_entry_header(__( 'Chat','weaver-ii'));
		if ( comments_open() && ! post_password_required() ) { ?>
			<div class="comments-link">
<?php 			weaverii_comments_popup_link(); ?>
			</div>
<?php 		} ?>
		</header><!-- .entry-header -->

		<?php
		if (weaverii_show_only_title()) {
			weaverii_chat_title();
			return;
		}
		if ( weaverii_do_excerpt() ) { // Only display Excerpts for Search ?>
		<div class="entry-summary">
			<?php
			weaverii_chat_title();
			weaverii_the_excerpt_featured(); ?>
			</div><!-- .entry-summary -->
<?php
        } else {
?>
		<div class="entry-content wvr-mt-10">
			<dl><dt>
<?php			weaverii_chat_title(); ?>
			</dt><dd>
<?php
			weaverii_the_contnt_featured();
?>			</dd></dl>
<?php
			wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:','weaver-ii')
				. '</span>', 'after' => '</div>' ) );
?>
		</div><!-- .entry-content -->
<?php 		} ?>
		<footer class="entry-utility">
<?php
		if ( comments_open() ) {
			echo '<span ' . weaverii_meta_icons_class() . '><span class="comments-link">';
			comments_popup_link( '<span class="leave-reply">' . '&nbsp;&nbsp;' .  __( 'Leave a reply','weaver-ii') . '</span>', __( '<b>1</b> Reply','weaver-ii'), __( '<b>%</b> Replies','weaver-ii') ); ?></span></span>

			<?php } ?>
			<?php edit_post_link( __( 'Edit','weaver-ii'), '<span class="edit-link">', '</span>' ); ?>
		</footer><!-- #entry-utility -->
<?php		    weaverii_inject_area('postpostcontent');	// inject post comment body ?>
	</article><!-- #post-<?php the_ID(); ?> -->
