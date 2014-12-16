<?php
if ( !defined('ABSPATH')) exit; // Exit if accessed directly
/**
 * Quote
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

	<article id="post-<?php the_ID(); ?>" <?php post_class('content-quote ' . weaverii_post_count_class()); ?>>
<?php
	if (!weaverii_compact_post()) {
?>
		<header class="entry-header">
<?php
        weaverii_entry_header(__( 'Quote','weaver-ii')); ?>

			<div class="entry-meta">
				<?php weaverii_post_top_info(); ?>
			</div><!-- .entry-meta -->

			<?php weaverii_comments_popup_link(); ?>
		</header><!-- .entry-header -->

		<?php
		if (weaverii_show_only_title()) {
			return;
		}
	}
	if ( weaverii_do_excerpt() && !weaverii_compact_post()) { // Only display Excerpts for Search ?>
		<div class="entry-summary">
			<?php weaverii_the_excerpt_featured(); ?>
		</div><!-- .entry-summary -->
<?php
    } else {
?>
		<div class="entry-content cf">
			<?php weaverii_the_contnt_featured(); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:','weaver-ii') . '</span>', 'after' => '</div>' ) ); ?>
		</div><!-- .entry-content -->
<?php
    }

	if (!weaverii_compact_post()) {
?>

		<footer class="entry-utility">
<?php
		weaverii_post_bottom_info();
		weaverii_compact_link('check');
?>
		</footer><!-- #entry-mutilityeta -->
<?php
	} else {
        weaverii_compact_link();
        edit_post_link( __( 'Edit','weaver-ii'), '<span class="edit-link">', '</span>' );
	}
	weaverii_inject_area('postpostcontent');	// inject post comment body ?>
	</article><!-- #post-<?php the_ID(); ?> -->
