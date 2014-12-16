<?php
if ( !defined('ABSPATH')) exit; // Exit if accessed directly
/**
 * The template for displaying the footer.
 *
 * Contains all content after the closing of the id=main div
 *
 * @package WordPress
 * @subpackage Weaver II
 * @since Weaver II 1.0
 */
weaverii_trace_template(__FILE__);
?>
<?php
	if (weaverii_getopt_checked('wii_footer_last'))	// move footer outside of page, allows wide footer
        echo("</div><!-- #wrapper -->\n");

	if ((weaverii_use_mobile('mobile') && weaverii_getopt('_wii_mode_mobile') != 'weaver-mobile-smart-stacked')
	|| weaverii_getopt('_wii_mode_mobile') == 'weaver-mobile-resp-nostack') {
        weaverii_put_widgetarea('mobile-widget-area', 'mobile_widget_area');
    }

	weaverii_inject_area('prefooter');		// put the prefooter optional area
	if (!weaverii_getopt('wii_hide_footer') && !weaverii_is_checked_page_opt('ttw-hide-footer')) {
?>
	<footer id="colophon" role="contentinfo">
	  <div>
<?php
        if (weaverii_getopt_checked( 'wii_footer_inject_move' )) {
            weaverii_inject_area('footer');	// here is where the footer options get inserted
            get_sidebar( 'footer' );		// get the sidebar-footer temeplate
        } else {
            get_sidebar( 'footer' );
            weaverii_inject_area('footer');
        }

        $date = getdate();
        $year = $date['year'];
?>
		<div id="site-ig-wrap">
		<span id="site-info">
<?php
		$cp = weaverii_getopt('_wii_copyright');
		if (strlen($cp) > 0) {
		if ($cp != '&nbsp;')	// really leave nothing if specify blank
			echo(do_shortcode($cp));
		} else {
?>
		&copy; <?php echo($year); ?> - <a href="<?php echo home_url( '/' ) ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
<?php
		}
?>
		</span> <!-- #site-info -->
<?php
        if (! weaverii_getopt('_wii_hide_poweredby')) { ?>
		<span id="site-generator">
		<a href="<?php echo esc_url( __( 'http://wordpress.org/','weaver-ii') ); ?>" title="wordpress.org" rel="generator" target="_blank"><?php printf( __( 'Proudly powered by %s','weaver-ii'), 'WordPress' ); ?></a>&nbsp;
<?php
            echo(WEAVERII_THEMENAME); ?> by <?php weaverii_site(); ?>WP Weaver</a>
		</span> <!-- #site-generator -->
<?php
        }
		weaverii_mobile_toggle('footer');	// display toggle button
?>
		</div><!-- #site-ig-wrap -->
		<div class="weaver-clear"></div>
	  </div>
	</footer><!-- #colophon -->
<?php
	} // end if !hide_footer

	if (!weaverii_getopt_checked('wii_footer_last'))	// normally, #colophon inside #page
        echo("</div><!-- #wrapper -->\n");
	weaverii_inject_area('postfooter');		// and this is the end options insertion
	echo "<a href=\"#page-top\" id=\"page-bottom\">&uarr;</a>\n";

	if ( !weaverii_getopt_checked('_wii_no_final_div') ) {
        if (weaverii_getopt_checked('wii_hide_final')) {
            echo '<div id="weaver-final" class="weaver-final-normal wvr-hide-bang">';
        } else {
            echo '<div id="weaver-final" class="weaver-final-normal">';
        }
	}
	wp_footer();

	weaverii_masonry('invoke-code');

	if ( !weaverii_getopt_checked('_wii_no_final_div') )
        echo '</div> <!-- #weaver-final -->' . "\n";

	if (weaverii_dev_mode() && weaverii_getopt_checked('_weaverii_diag_timer')) {
        global $weaverii_timer;
        $end_time = microtime(true);
        echo '<span class="wvr-timer-msg">Page generated in: '. round($end_time-$weaverii_timer, 3) . ' seconds.</span>' . "\n";
	}
?>
</body>
</html>
