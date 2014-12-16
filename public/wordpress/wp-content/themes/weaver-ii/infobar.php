<?php
if ( !defined('ABSPATH')) exit; // Exit if accessed directly
/* Weaver II

Inject - injects userdefined HTML

inject-infobar - adds both the infobar and the user pre-main area. Order of these
two can be swapped easily in a child theme simply by reversing the order here

*/
if (!weaverii_getopt_checked('wii_infobar_hide') && !weaverii_is_checked_page_opt('wvr-hide-page-infobar')) { // let's really not include it rather than display:none.
?>
	<div id="infobar">
<?php
	if (($h1 = weaverii_getopt('wii_info_html1'))!='') {
        echo '<span id="infobar_html1">';
        echo do_shortcode($h1);
        echo ("</span>\n");
	}
	if (!weaverii_getopt_checked('wii_info_hide_breadcrumbs')) {
        global $weaverii_crumbs;
        if ( function_exists('yoast_breadcrumb') ) {
            $weaverii_crumbs = yoast_breadcrumb('<span id="breadcrumbs">','</span>',false);
        }
        if ($weaverii_crumbs)
            echo $weaverii_crumbs;
        else
            weaverii_breadcrumb();
	}

	if (($h1 = weaverii_getopt('wii_info_html2'))!='') {
        echo '<span id="infobar_html2">';
        echo do_shortcode($h1);
        echo ("</span>\n");
	}
	?>
	<span class='infobar_right'>
<?php
	if (!weaverii_getopt_checked('wii_info_hide_pagenav')) {
        echo ('<span id="infobar_paginate">');
        if ( ! is_singular() ) {
            if (function_exists ('wp_pagenavi')) {
                wp_pagenavi();
            } else
            if ( function_exists( 'wp_paginate' ) ) {
                wp_paginate( 'title=' );
            } else {
                echo weaverii_get_paginate_archive_page_links( 'plain', 2, 2 );
            }
        }
        echo ("</span>\n");
	}

	if (weaverii_getopt('wii_info_search')) {
        if (function_exists('weaverii_plus_search_form')) {
            echo '<span id="infobar_search" style="padding-right:4px !important;display:inline-block;padding-left:20px;">';
            echo weaverii_plus_search_form('',120);
            echo '</span>';
        } else {
            echo '<span id="infobar_search">';
            get_search_form();
            echo '</span>';
        }
	}

	if (weaverii_getopt_checked('wii_info_addlogin')) {
        echo '<span id="infobar_login">';
        wp_loginout();
        echo '</span>';
	}

	if (($h1 = weaverii_getopt('wii_info_html3'))!='') {
        echo '<span id="infobar_html3">';
        echo do_shortcode($h1);
        echo ("</span>\n");
	}
?>
	</span></div><div class="weaver-clear"></div><!-- #infobar -->
<?php
} // show info bar

?>
