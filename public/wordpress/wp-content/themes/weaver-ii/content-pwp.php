<?php
if ( !defined('ABSPATH')) exit; // Exit if accessed directly
/**
 * The template used for displaying page content in pwp template
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

<article id="post-<?php the_ID(); ?>" <?php post_class('content-pwp'); ?>>
<?php   weaverii_fi_pre_title('page'); ?>
	<header class="entry-header<?php weaverii_hide_page_title(); ?>">
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header><!-- .entry-header -->
<?php edit_post_link( __( 'Edit','weaver-ii'), '<div class="edit-link">', '</div>' ); ?>
	<div class="entry-content cf">
		<?php weaverii_the_contnt_featured(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:','weaver-ii') . '</span>', 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->
