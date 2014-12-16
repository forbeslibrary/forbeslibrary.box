<?php
if ( !defined('ABSPATH')) exit; // Exit if accessed directly
/**
 * The Footer widget areas.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?>

<?php
	/* The footer widget area is triggered if any of the areas
	 * have widgets. So let's check that first.
	 *
	 * If none of the sidebars have widgets, then let's bail early.
	 */
	if ( ! is_active_sidebar( 'first-footer-widget-area'  )
		&& ! is_active_sidebar( 'second-footer-widget-area' )
		&& ! is_active_sidebar( 'third-footer-widget-area'  )
		&& ! is_active_sidebar( 'fourth-footer-widget-area'  )
	   )
		return;

	// check for stacked modes

	if (weaverii_use_mobile('mobile')
		&& weaverii_getopt('_wii_mode_mobile') != 'weaver-mobile-smart-stacked'
		&& !weaverii_getopt_checked('wii_mobile_show_footerwidgets'))
		return;
	// If we get this far, we have widgets. Let do this.
?>
	<div id="sidebar_wrap_footer" <?php weaverii_footer_sidebar_class(); ?>>
<?php
	weaverii_trace_sidebar(__FILE__);
	if (is_rtl()) {
?>
	<?php if ( is_active_sidebar( 'fourth-footer-widget-area' ) ) : ?>
	<div class='widget-in-footer'><div id="fourth" class="widget-area" role="complementary">
		<?php dynamic_sidebar( 'fourth-footer-widget-area' ); ?>
	</div></div><!-- #fourth .widget-area -->
	<?php endif; ?>

	<?php if ( is_active_sidebar( 'third-footer-widget-area' ) ) : ?>
	<div class='widget-in-footer'><div id="third" class="widget-area" role="complementary">
		<?php dynamic_sidebar( 'third-footer-widget-area' ); ?>
	</div></div><!-- #third .widget-area -->
	<?php endif; ?>

	<?php if ( is_active_sidebar( 'second-footer-widget-area' ) ) : ?>
	<div class='widget-in-footer'><div id="second" class="widget-area" role="complementary">
		<?php dynamic_sidebar( 'second-footer-widget-area' ); ?>
	</div></div><!-- #second .widget-area -->
	<?php endif; ?>

	<?php if ( is_active_sidebar( 'first-footer-widget-area' ) ) : ?>
	<div class='widget-in-footer'><div id="first" class="widget-area" role="complementary">
		<?php dynamic_sidebar( 'first-footer-widget-area' ); ?>
	</div></div><!-- #first .widget-area -->
	<?php endif; ?>
<?php
	} else {
	if ( is_active_sidebar( 'first-footer-widget-area' ) ) : ?>
	<div class='widget-in-footer'><div id="first" class="widget-area" role="complementary">
		<?php dynamic_sidebar( 'first-footer-widget-area' ); ?>
	</div></div><!-- #first .widget-area -->
	<?php endif; ?>

	<?php if ( is_active_sidebar( 'second-footer-widget-area' ) ) : ?>
	<div class='widget-in-footer'><div id="second" class="widget-area" role="complementary">
		<?php dynamic_sidebar( 'second-footer-widget-area' ); ?>
	</div></div><!-- #second .widget-area -->
	<?php endif; ?>

	<?php if ( is_active_sidebar( 'third-footer-widget-area' ) ) : ?>
	<div class='widget-in-footer'><div id="third" class="widget-area" role="complementary">
		<?php dynamic_sidebar( 'third-footer-widget-area' ); ?>
	</div></div><!-- #third .widget-area -->
	<?php endif; ?>
	<?php if ( is_active_sidebar( 'fourth-footer-widget-area' ) ) : ?>
	<div class='widget-in-footer'><div id="fourth" class="widget-area" role="complementary">
		<?php dynamic_sidebar( 'fourth-footer-widget-area' ); ?>
	</div></div><!-- #fourth .widget-area -->
	<?php endif;
	} ?>
	</div><!-- #sidebar_wrap_footer -->
