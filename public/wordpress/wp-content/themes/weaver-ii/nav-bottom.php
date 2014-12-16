<?php
if ( !defined('ABSPATH')) exit; // Exit if accessed directly
/* Weaver II
  bottom menu - responsive + Javascript class rename
*/
	$mobile_name = apply_filters('weaverii_menu_name','mobile_menu','bottom');
	$primary_name = apply_filters('weaverii_menu_name','primary','bottom');
	$secondary_name = apply_filters('weaverii_menu_name','secondary','bottom');

	$nav_menu = (weaverii_use_mobile('mobile') && has_nav_menu($mobile_name)) ? $mobile_name : $primary_name;

	$nav_class = '';

	$show_menu = !weaverii_getopt('wii_hide_menu')
	&& !weaverii_is_checked_page_opt('ttw-hide-menus');

if ($show_menu) {
	if (!weaverii_getopt('wii_move_menu')) { 	/* ttw - move menu */
		echo '<div id="wrap-bottom-menu">' . "\n";
	weaverii_mobile_menu_bar('mobile-bottom-nav','nav-bottom-menu');
?>
		<div class="skip-link"><a class="assistive-text" href="#content" title="<?php esc_attr( __('Skip to primary content','weaver-ii')); ?>"><?php echo __( 'Skip to primary content','weaver-ii'); ?></a></div>
			<div class="skip-link"><a class="assistive-text" href="#sidebar_primary" title="<?php esc_attr( __('Skip to secondary content','weaver-ii')); ?>"><?php echo __( 'Skip to secondary content','weaver-ii'); ?></a></div>
				<div id="nav-bottom-menu"<?php echo $nav_class;?>><nav id="access" class="menu_bar" role="navigation">
<?php           /* add html to menu left */
			$add_html = weaverii_getopt('wii_menu_addhtml-left');
			if (!empty($add_html)) {
				echo('<div class="menu-add-left">');
                echo(do_shortcode($add_html));
                echo('</div>');
			}

			if ( weaverii_use_sf() )
                wp_nav_menu( array( 'theme_location' => $nav_menu,
                    'menu_class' => 'sf-menu', 'fallback_cb' => 'weaverii_page_menu', 'container_class' => 'menu' ) );
			else
                wp_nav_menu( array('theme_location' => $nav_menu, 'container_class' => 'menu' ) );

			/* add html/search to menu */
			$add_div = true;
			$add_enddiv = false;
			$add_html = weaverii_getopt('wii_menu_addhtml');

			if (!empty($add_html)) {
				echo('<div class="menu-add">'); $add_div = false;
                echo(do_shortcode($add_html));
                $add_enddiv = true;
			}

					if (weaverii_pro_getopt('wvp_add_social_to_menu') > 0) {
						if ($add_div) echo('<div class="menu-add">'); $add_div = false;
                        if ($add_enddiv) echo('<br class="mad-br" />');
						$val = weaverii_pro_getopt('wvp_add_social_to_menu');
						$width = $val * 28;
						echo do_shortcode(sprintf('<span style="width:%spx; padding-right:4px;display:inline-block;">[weaver_social number=%d]</span>',
								$width,$val));
                        $add_enddiv = true;
					}

			if (weaverii_getopt('wii_menu_addsearch')) {
                if ($add_div) echo('<div class="menu-add">'); $add_div = false;
                if ($add_enddiv) echo('<br class="mad-br" />');
                if (function_exists('weaverii_plus_search_form')) {
                    echo '<span class="menu-add-search">';
                    echo weaverii_plus_search_form('',120);
                    echo '</span>';
                } else {
                    echo '<span class="menu-add-search">';
                    get_search_form();
                    echo '</span>';
                }
                $add_enddiv = true;
			}
			if (weaverii_getopt('wii_menu_addlogin')) {
                if ($add_div) echo('<div class="menu-add">');
                $add_div = false;
                if ($add_enddiv) echo('<br class="mad-br" />');
                wp_loginout();
                $add_enddiv = true;
			}

			if ($add_enddiv) {
				echo('</div>');
			}
			?>
		</nav></div><!-- #access --></div> <!-- #wrap-bottom-menu -->
<?php

	} else { /* ttw - move menu */
		if ($show_menu && has_nav_menu($secondary_name)
		&& (!weaverii_use_mobile('phone') || (weaverii_use_mobile('phone') && !weaverii_getopt('wii_mobile_hide_secondary_menu')))) {
			echo '<div id="wrap-bottom-menu">' . "\n";
            weaverii_mobile_menu_bar('mobile-bottom-nav','nav-bottom-menu','no-home');
?>
            <div id="nav-bottom-menu"<?php echo $nav_class;?>><nav id="access2" class="menu_bar" role="navigation">
<?php
            if ( weaverii_use_sf() )
                wp_nav_menu( array('theme_location' => $secondary_name, 'fallback_cb' => '',
                           'menu_class' => 'sf-menu', 'container_class' => 'menu' ) );
            else
                wp_nav_menu( array('theme_location' => $secondary_name, 'fallback_cb' => '', 'container_class' => 'menu' ) );
            ?>
            </nav></div><!-- #access2 --></div> <!-- #wrap-bottom-menu -->
    <?php
		}
	}
} /* end wii_hide-menus */
?>
