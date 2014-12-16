<?php
if ( !defined('ABSPATH')) exit; // Exit if accessed directly
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage Weaver II
 * @since Weaver II 1.0
 */
weaverii_get_header('404');
if ( weaverii_getopt('wii_infobar_location') == 'top' )
	get_template_part('infobar');echo("\t<div id=\"main\">\n");
weaverii_trace_template(__FILE__);
weaverii_get_sidebar_left('404');	// mimic search
?>
	<div id="container_wrap"<?php weaverii_get_page_class('404', 'container-404'); ?>>
	<?php  if ( weaverii_getopt('wii_infobar_location') == 'content' )
		get_template_part('infobar'); ?>
	<div id="container">
		<div id="content" role="main">

			<article id="post-0" class="post error404 not-found">

				<header class="entry-header">
					<h1 class="entry-title"><?php echo __( 'Sorry, no such page.','weaver-ii'); ?></h1>
				</header>

<?php
	if (!weaverii_getopt('_wii_hide_not_found_search')) {
?>
				<div class="entry-content cf">
					<p><?php echo __( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching, or one of the links below, can help.','weaver-ii'); ?></p>

					<?php get_search_form();
					if (weaverii_use_mobile('mobile'))
						echo '<div class="wvr-clear-block">&nbsp;</div>';
					?>

					<?php the_widget( 'WP_Widget_Recent_Posts', array( 'number' => 10 ), array( 'widget_id' => '404' ) );
					if (weaverii_use_mobile('mobile'))
						echo '<div class="wvr-clear-block"&nbsp;</div>';
					?>

					<div class="widget">
						<h2 class="widgettitle"><?php echo __( 'Most Used Categories','weaver-ii'); ?></h2>
						<ul>
						<?php wp_list_categories( array( 'orderby' => 'count', 'order' => 'DESC', 'show_count' => 1, 'title_li' => '', 'number' => 10 ) ); ?>
						</ul>
					</div>

					<?php
					if (weaverii_use_mobile('mobile'))
						echo '<div class="wvr-clear-block">&nbsp;</div>';
					/* translators: %1$s: smilie */
					$archive_content = '<p>' . sprintf( __( 'Try looking in the monthly archives. %1$s','weaver-ii'), convert_smilies( ':)' ) ) . '</p>';
					the_widget( 'WP_Widget_Archives', array('count' => 0 , 'dropdown' => 1 ), array( 'after_title' => '</h2>'.$archive_content ) );
					if (weaverii_use_mobile('mobile'))
						echo '<div class="wvr-clear-block">&nbsp;</div>';
					?>

					<?php the_widget( 'WP_Widget_Tag_Cloud' ); ?>

				</div><!-- .entry-content -->
<?php
	}	// don't show not found message
?>
			</article><!-- #post-0 -->
		</div><!-- #content -->
	</div><!-- #container -->
	</div><!-- #container_wrap -->

<?php
	weaverii_get_sidebar_right('404');
	weaverii_get_footer('404'); ?>
