<?php
/**
 * Plugin Name: Fobres Templates
 * Description: Convenient shortcodes for consistent styling.
 * Version: 0.1
 * Author: Benjamin Kalish
 */

require_once( dirname( __FILE__ ) . '/forbes_front_page_box.php' );
require_once( dirname( __FILE__ ) . '/forbes_panorama.php' );
require_once( dirname( __FILE__ ) . '/forbes_pdf.php' );
require_once( dirname( __FILE__ ) . '/forbes_search.php' );

// action hooks
add_action('wp_head', 'forbes_templates_public_css');
//add_action( 'wp_enqueue_scripts', 'forbes_templates_enqueue_style' );

// shortcode hooks
add_shortcode( 'forbes_front_page_box', 'forbes_front_page_box_shortcode_handler' );
add_shortcode( 'forbes_panorama', 'forbes_panorama_shortcode_handler' );
add_shortcode( 'forbes_pdf', 'forbes_pdf_shortcode_handler' );
add_shortcode( 'forbes_search', 'forbes_search_shortcode_handler' );

/**
 * Enqueue style. This requires an http request.
 */
function forbes_templates_enqueue_style() {
	wp_enqueue_style( 'forbes-templates-css', plugins_url( 'forbes-templates.css' , __FILE__ ) );
}


/**
 * Add style to the head instead of enqueueing it. This will save an http request.
 */
function forbes_templates_public_css() {
  echo '<style  type="text/css">';
  readfile(dirname(__FILE__) . '/forbes-templates.css');
  echo '</style>';
}
 