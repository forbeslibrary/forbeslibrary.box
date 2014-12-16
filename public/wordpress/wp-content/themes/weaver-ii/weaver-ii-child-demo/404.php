<?php
if ( !defined('ABSPATH')) exit; // Exit if accessed directly
/**
 * An alternate template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage Weaver II
 * @since Weaver II 1.0
 */
weaverii_get_header('404');
get_template_part('infobar');	// only option on 404 is at top, so just do it
echo("\t<div id=\"main\">\n");
?>
<div id="container_wrap"<?php weaverii_get_page_class('404', 'container-404'); ?>>
    <div id="container">
	<div id="content" role="main">

	<article id="post-0" class="post error404 not-found">

	    <header class="entry-header">
		<h1 class="entry-title">Sorry - Page Not Found</h1>
	    </header>

	    <div class="entry-content">
		<p>Sorry, the page you requested can't be found.</p>

	    </div><!-- .entry-content -->
	    </article><!-- #post-0 -->
	</div><!-- #content -->
    </div><!-- #container -->
</div><!-- #container_wrap -->

<?php
weaverii_get_footer('404'); ?>
