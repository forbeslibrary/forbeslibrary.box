<?php
if ( !defined('ABSPATH')) exit; // Exit if accessed directly
/**
 * The template for displaying posts in the Status Post Format on index and archive pages
 *
 * Learn more: http://codex.wordpress.org/Post_Formats
 *
 * @package WordPress
 * @subpackage Weaver II
 */
weaverii_trace_template(__FILE__);
global $weaverii_cur_post_id;
$weaverii_cur_post_id = get_the_ID();
weaverii_per_post_style();
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class('content-status post-format ' . weaverii_post_count_class()); ?>>
<?php
	if (!weaverii_compact_post()) {
?>
		<header class="entry-header">
<?php 		weaverii_entry_header(__( 'Status','weaver-ii'));
		if ( comments_open() && ! post_password_required() ) {
?>
			<div class="comments-link">
<?php 			weaverii_comments_popup_link(); ?>
			</div>
<?php
        }
?>
		</header><!-- .entry-header -->

		<?php
		if (weaverii_show_only_title()) {
			return;
		}
	}
	if ( weaverii_do_excerpt() && !weaverii_compact_post()) { // Only display Excerpts for Search
?>
		<div class="entry-summary">
			<?php weaverii_the_excerpt_featured(); ?>
		</div><!-- .entry-summary -->
<?php
    } else {
?>
		<div class="entry-content cf">
			<span class="post-avatar">
<?php 			echo(get_avatar( get_the_author_meta('user_email') ,32,null,'avatar')); ?>
			</span><span class="wvr-ml-50">
<?php 			weaverii_the_contnt_featured();
			echo '</span>';
			wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:','weaver-ii')
				. '</span>', 'after' => '</div>' ) );
?>
		</div><!-- .entry-content -->
<?php
    }
	if (!weaverii_compact_post()) {
		weaverii_format_posted_on_footer('status');
		weaverii_compact_link('check');
	} else {
		weaverii_compact_link();
		edit_post_link( __( 'Edit','weaver-ii'), '<span class="edit-link">', '</span>' );
	}

    weaverii_inject_area('postpostcontent');	// inject post comment body ?>
	</article><!-- #post-<?php the_ID(); ?> -->
