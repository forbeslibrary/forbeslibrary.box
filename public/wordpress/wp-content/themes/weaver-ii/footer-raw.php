<?php
if ( !defined('ABSPATH')) exit; // Exit if accessed directly
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package WordPress
 * @subpackage Weaver II
 * @since Weaver II 1.0
 */
weaverii_trace_template(__FILE__);
?>
<a id="page-bottom"></a>
<?php
	if (weaverii_getopt_checked('wii_hide_final')) {
        echo '<div id="weaver-final" class="weaver-final-raw wvr-hide-bang">';
	} else {
        echo '<div id="weaver-final" class="weaver-final-raw">';
	}
	wp_footer();
?>
</div> <!-- #wii_final -->
</body>
</html>
