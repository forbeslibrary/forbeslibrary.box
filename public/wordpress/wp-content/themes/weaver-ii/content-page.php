<?php
if ( !defined('ABSPATH')) exit; // Exit if accessed directly
/**
 * The template used for displaying page content in page.php
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

<article id="post-<?php the_ID(); ?>" <?php post_class('content-page'); ?>>
<?php
    weaverii_fi_pre_title('page'); ?>
	<header class="entry-header<?php weaverii_hide_page_title(); ?>">
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header><!-- .entry-header -->

	<div class="entry-content cf">
<?php
    weaverii_the_page_contnt_featured();
	wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:','weaver-ii') . '</span>', 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->
	<footer class="entry-utility-page cf">
<?php 	edit_post_link( __( 'Edit','weaver-ii'), '<span class="edit-link">', '</span>' ); ?>

	</footer><!-- .entry-utility-page -->
</article><!-- #post-<?php the_ID(); ?> -->
