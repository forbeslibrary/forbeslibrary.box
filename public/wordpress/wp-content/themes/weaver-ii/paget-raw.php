<?php
if ( !defined('ABSPATH')) exit; // Exit if accessed directly
/**
 * Template Name: Raw
 *
 * A custom page template for raw HTML - no sidebars, no header, no footer, no styling, no title, no comments -
 * just the raw content - no texturize, etc., but it does do shortcodes
 * It gets all styling using the per page head insert code
 *
 * The "Template Name:" bit above allows this to be selectable
 * from a dropdown menu on the edit page screen.
 */

weaverii_get_header('raw');
weaverii_trace_template(__FILE__);
?>
<!-- This page formatted using Weaver II Raw Page Template -->
<?php
while (have_posts()) {
	weaverii_post_count_clear();
	the_post();
	echo do_shortcode(get_the_content());
}
weaverii_get_footer('raw');
?>
