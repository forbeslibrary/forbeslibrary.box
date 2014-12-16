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
	<header class="entry-header<?php weaverii_hide_page_title(); ?>">
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header><!-- .entry-header -->

	<div class="entry-content cf">
<?php
    weaverii_the_page_contnt_featured();

	// sitemap specific code
	echo("<div id=\"wvr-sitemap\">\n");
	echo("<h3>" . __('Pages','weaver-ii') . "</h3><ul class='xoxo sitemap-pages'>\n");
	wp_list_pages(array('title_li' => false));
	echo("</ul>\n");

	echo("<h3>" .__('Posts','weaver-ii') . "</h3><ul class='xoxo sitemap-pages-month'>\n");
	wp_get_archives(array('type' => 'monthly', 'show_post_count' => true));
	echo("</ul>\n");

	if (!weaverii_getopt('wii_post_hide_cats')) {
		echo("<h3>" . __('Categories','weaver-ii') . "</h3><ul class='xoxo sitemap-categories'>\n");
		wp_list_categories(array('show_count' => true, 'use_desc_for_title' => true, 'title_li' => false));
		echo("</ul>\n");

		// If you want to show authors, simply uncomment the next 3 lines
		// echo("<h3>" . __('Authors','weaver-ii') ."</h3><ul class='xoxo sitemap-authors'>\n");
		// wp_list_authors(array('exclude_admin' => false, 'optioncount' => true, 'title_li' => false));
		// echo("</ul>\n");

		echo("<h3>" . __('Tag Cloud','weaver-ii') . "</h3><ul class='xoxo sitemap-tag'>\n");
		wp_tag_cloud(array('number' => 0));
		echo("</ul>\n");
	}
	echo("</div><!-- wvr-sitemap -->\n");

	wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:','weaver-ii') . '</span>', 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->
	<footer class="entry-utility-page">
<?php 	edit_post_link( __( 'Edit','weaver-ii'), '<span class="edit-link">', '</span>' ); ?>

	</footer><!-- .entry-utility-page -->
</article><!-- #post-<?php the_ID(); ?> -->
